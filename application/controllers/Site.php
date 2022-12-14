<?php

class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MBarang', 'barang');
        $this->load->model('MKategori', 'kategori');
        $this->load->model('MUser', 'user');
        $this->load->model('MPesanan', 'pesanan');

        if (!$this->session->has_userdata('id')) {
            return redirect('auth/login');
        }
    }

    private function loadView($mainView, $data = [])
    {
        // $genres = $this->barang->genres();
        // $kategori = $this->barang->kategori();
        // dd($genres);

        $this->load->view('site/header', []);
        $this->load->view($mainView, $data);
        $this->load->view('site/footer');
    }

    public function index()
    {
        // throw new Exception('Error gan');
        // $latest_aired = $this->barang->latest_aired(); // Mengambil data film urut berdasarkan tgl rilis.
        // $recently_added = $this->barang->recently_added(); // Mengambil data film yang baru ditambahkan.
        // dd($recently_added);
        // Menampilkan view index dengan mempassing 2 data film tadi.
        $iduser = $this->session->id;
        // dd($this->session);
        $saldo = $this->user->getSaldo($iduser);
        $this->loadView('site/index', [
            'saldo' => $saldo
        ]);
    }

    public function search()
    {
        $q = $this->input->get('q'); // Keyword yang diinputkan user
        // Mengambil halaman saat ini. halaman ke berapa sekarang.
        $currentPage = !empty($this->input->get('p')) ? $this->input->get('p') : 1;
        // dd($q);
        $itemPerPage = 15; // Jumlah item per halaman
        $offset = ($currentPage - 1) * $itemPerPage;
        $res = $this->barang->search($q, $itemPerPage, $offset); // Mendapatkan data film berdasarkan cari keyword
        $resCount = $this->barang->searchCount($q); // Mendapatkan count data untuk paging
        $totalPage = ceil($resCount / $itemPerPage); // Menghitung total halaman

        // Menampilkan view search dan memapssing data-data yg diperlukan.
        $this->loadView('site/search', [
            'q'    => $q,
            'res' => $res,
            'totalPage' => $totalPage,
        ]);
    }

    /**
     * Halaman Detail Film
     */
    public function movie($id)
    {
        # code...
        $res = $this->barang->find($id);
        // dd($res);
        $related_barang = $this->barang->related($id);
        // dd($res);
        // if ($this->session->has_userdata('id')) {
        //     // Tambah histori film user
        //     $this->user->addhistory(['iduser' => $this->session->id, 'idfilm' => $id]);
        // }
        $this->loadView('site/movie', [
            'barang'    => $res,
            'related_barang' => $related_barang,
        ]);
    }

    public function search_genre($idkategori)
    {
        $kategori = $this->kategori->find($idkategori);
        // Mengambil halaman saat ini. halaman ke berapa sekarang.
        $currentPage = !empty($this->input->get('p')) ? $this->input->get('p') : 1;
        // dd($genre);
        $itemPerPage = 15; // Jumlah item per halaman
        $offset = ($currentPage - 1) * $itemPerPage;
        $res = $this->barang->findByKategori([$idkategori], $itemPerPage, $offset); // Mendapatkan data film berdasarkan genre
        $resCount = $this->barang->findByKategoriCount([$idkategori], $itemPerPage, $offset); // Mendapatkan count data untuk paging
        $totalPage = ceil($resCount / $itemPerPage); // Mendapatkan total page

        // dd([
        //     // 'res'	=> $res,
        //     // 'resCount'	=> $resCount,
        //     'kategori'	=> $kategori,
        // ]);
        // Menampilkan view search dan memapssing data-data yg diperlukan.
        $this->loadView('site/search_genre', [
            'kategori' => $kategori['nama'],
            'res' => $res,
            'totalPage' => $totalPage,
        ]);
    }

    public function history()
    {
        $history = $this->user->history($this->session->id);
        $this->loadView('site/history', [
            'history' => $history
        ]);
    }

    public function searchAjax($q)
    {
        $res = $this->barang->search($q, 6, 0); // Mendapatkan data film berdasarkan cari keyword
        echo json_encode($res);
    }

    public function indodax()
    {
        $this->loadView('site/indodax', []);
    }

    public function previewDiagram()
    {
        $dataSample = $this->diagram->getSample();
        $this->loadView('site/sample-diagram', [
            'dataSample' => $dataSample
        ]);
        // dd($dataSample);
    }

    /**
     * Menampilkan Logo UPN beserta kata-kata
     */
    public function about()
    {
        $this->loadView('site/about');
    }

    /**
     * Fungsi untuk menambahkan ke Keranjang
     */
    public function addcart()
    {
        if (!$this->session->has_userdata('id')) {
            return redirect('auth/login');
        }

        $id = $this->input->post('id');
        $jml = $this->input->post('jml');
        $harga = $this->input->post('harga');
        $iduser = $this->session->id;

        $params = [
            'idbarang' => $id,
            'iduser' => $iduser,
            'jml' => $jml,
            'harga' => $harga,
        ];
        // dd($params); return;
        $this->pesanan->addtocart($params);
        flash('addcart', "Berhasil menambahkan barang ke dalam keranjang", 'success');
        redirect('site/movie/' . $id);
    }

    public function keranjang()
    {
        $iduser = $this->session->id;
        $keranjang = $this->pesanan->getKeranjang($iduser);
        // dd($keranjang);

        $this->loadView('site/keranjang', [
            'keranjang' => $keranjang,
        ]);
    }

    public function removecart()
    {
        $idpesanandetail = $this->input->post('idpesanandetail');
        $this->pesanan->removecart($idpesanandetail);
        flash('removecart', "Berhasil menghapus barang dari keranjang", 'success');
        redirect('site/keranjang');
    }

    public function editcart($idpesanandetail)
    {
        $detail = $this->pesanan->getDetail($idpesanandetail);
        // dd($detail);

        $this->loadView('site/editcart', [
            'detail' => $detail
        ]);
    }

    public function updatecart()
    {
        $idpesanandetail = $this->input->post('id');
        $jml = $this->input->post('jml');

        $params = [
            'id' => $idpesanandetail,
            'jml' => $jml
        ];
        // dd($params); return;
        $this->pesanan->updatecart($params);
        flash('editcart', "Berhasil mengubah keranjang", 'success');
        redirect('site/keranjang');
    }
}
