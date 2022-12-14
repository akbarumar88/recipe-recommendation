<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUser', 'user');
        $this->load->model('MBarang', 'barang');
        $this->load->model('MKategori', 'kategori');
        // Pengecekan Hak Akses, jika bukan admin
        if ($this->session->role != 1) {
            flash('access', "Maaf! Anda tidak memiliki akses untuk mengakses halaman tersebut. Nikmati Film-film menarik hanya di MOOVEE.", "danger");
            redirect('site/index');
        }
    }

    private function loadView($mainView, $data=[])
    {
        $genres = [];
        // dd($genres);
        $this->load->view('site/header', [
            'genres' => $genres
        ]);
        $this->load->view($mainView, $data);
        $this->load->view('site/footer');
    }

    public function index()
    {
        $q = $this->input->get('q');
        $page = $this->input->get('p');
        if (empty($page)) $page = 1; // Set ke halaman 1, jika kosong
        $limit = 50;
        $offset = ($page-1) * $limit;

        if (!empty($q)) {
            // Pencarian film
            $movies = $this->barang->search($q, $limit, $offset);
            $moviesCount = $this->barang->searchCount($q);
        } else {
            // Index
            $kategori = $this->kategori->all();
            // $movies = $this->barang->recently_added($limit, $offset);
            // $moviesCount = $this->barang->movies_count();
        }

        // dd($kategori);
        $totalPage = ceil(count($kategori) / $limit);
        $this->loadView('admin/index', [
            'kategori' => $kategori,
            'totalPage' => $totalPage
        ]);
    }

    /**
     * Halaman Detail Film
     */
    public function movie($id)
    {
        # code...
        $res = $this->barang->find($id);
        // Melakukan pengecekan apakah user sudah login? untuk membatasi kualitas videonya.
        if (!$this->session->has_userdata('id')) {
            $res['kualitas'] = array_filter($res['kualitas'], function ($item) {
                return $item['kualitas'] == '480p';
            });
        }
        // dd($res);
        $related_movies = $this->barang->related($id);
        // dd($res);
        $this->loadView('admin/movie', [
            'movie'	=> $res,
        ]);
    }

    public function addmovie()
    {
        if (!$this->input->post()) {
            $genres = $this->barang->genres();
            return $this->loadView('admin/addmovie', [
                'genres' => $genres
            ]);
        }
        // Tambah Film
        // dd($_POST);
        $idfilm = $this->barang->add([
            'judul' => $this->input->post('judul'),
            'sinopsis' => $this->input->post('sinopsis'),
            'tglrilis' => $this->input->post('tglrilis'),
            'durasi' => $this->input->post('durasi'),
            'rating' => $this->input->post('rating'),
            'genre' => $this->input->post('genre'),
            'link_sd' => $this->input->post('link_sd'),
            'link_hd' => $this->input->post('link_hd'),
        ]);

        // Upload gambar
        $tmp_name = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp_name, "img/thumbnails/$idfilm.jpg"); // Nama file diganti dengan id filmnya

        flash('succadd', "Berhasil menambahkan film ".$this->input->post('judul'), 'success');
        redirect('admin/index');
    }

    public function editmovie($id) {
        if (!$this->input->post()) {
            $genres = $this->barang->genres();
            $movie = $this->barang->find($id);
            // dd($movie);
            $filterSD = array_filter($movie['kualitas'], function($item) { return $item['kualitas'] == '480p'; });
            $filterHD = array_filter($movie['kualitas'], function($item) { return $item['kualitas'] == '720p'; });
            $link_sd = !empty($filterSD) ? end($filterSD)['url'] : '';
            $link_hd = !empty($filterHD) ? end($filterHD)['url'] : '';
            // dd([$filterSD, $filterHD]);
            $movie['link_sd'] = $link_sd;
            $movie['link_hd'] = $link_hd;
            return $this->loadView('admin/editmovie', [
                'movie' => $movie,
                'genres' => $genres
            ]);
        }
        // Update Film
        // dd($_POST);
        $idfilm = $this->barang->update([
            'id' => $this->input->post('id'),
            'judul' => $this->input->post('judul'),
            'sinopsis' => $this->input->post('sinopsis'),
            'tglrilis' => $this->input->post('tglrilis'),
            'durasi' => $this->input->post('durasi'),
            'rating' => $this->input->post('rating'),
            'genre' => $this->input->post('genre'),
            'link_sd' => $this->input->post('link_sd'),
            'link_hd' => $this->input->post('link_hd'),
        ]);

        // dd($_FILES);die;
        if (!empty($_FILES['gambar']['tmp_name'])) {
            // Hapus gambar lama terlebih dahulu.
            $resUnlink = unlink("img/thumbnails/$idfilm.jpg");
            // dd($resUnlink);die;
            // Upload gambar, jika diinput
            $tmp_name = $_FILES['gambar']['tmp_name'];
            move_uploaded_file($tmp_name, "img/thumbnails/$idfilm.jpg"); // Nama file diganti dengan id filmnya
        }

        flash('succadd', "Berhasil mengubah film ".$this->input->post('judul'), 'success');
        redirect('admin/index');
    }

    public function deletemovie($id)
    {
        $this->barang->delete($id);
        flash('succadd', "Film berhasil dihapus.", 'success');
        redirect('admin/index');
    }
}