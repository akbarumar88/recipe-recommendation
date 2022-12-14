<?php

class MBarang extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param
     */
    public function search($q = '', $limit=15, $offset=0)
    {
        $barang = $this
            ->db
            ->query("SELECT * FROM barang WHERE judul LIKE '%$q%' ORDER BY judul ASC LIMIT $limit OFFSET $offset")
            ->result_array();
        // dd($barang);
        return $barang;
    }

    public function movies_count()
    {
        $barang = $this
            ->db
            ->query("SELECT COUNT(*) as count FROM barang")
            ->row_array();
        // dd($barang);
        return $barang['count'];
    }

    public function searchCount($q = '')
    {
        $barang = $this
            ->db
            ->query("SELECT COUNT(*) as count FROM barang WHERE judul LIKE '%$q%'")
            ->row_array();
        // dd($barang);
        return $barang['count'];
    }

    /**
     * @param
     */
    public function latest_aired($limit=15, $offset=0)
    {
        $barang = $this
            ->db
            ->query("SELECT * FROM barang ORDER BY tgl_dibuat DESC LIMIT $limit OFFSET $offset")
            ->result_array();
        // dd($barang);
        return $barang;
    }

    public function recently_added($limit=15, $offset=0)
    {
        $barang = $this
            ->db
            ->query("SELECT * FROM barang ORDER BY id DESC LIMIT $limit OFFSET $offset")
            ->result_array();
        // dd($barang);
        return $barang;
    }

    public function find($id)
    {
        $barang = $this
            ->db
            ->query("SELECT b.*, k.nama as kategori FROM barang b
             INNER JOIN kategori k ON k.id = b.idkategori WHERE b.id = $id")
            ->row_array();
        // $kualitas = $this
        //     ->db
        //     ->query("SELECT * FROM barang_kualitas where idfilm = $id")
        //     ->result_array();
        // $genre = $this
        //     ->db
        //     ->query("SELECT idgenre, g.genre from barang_genre fg 
        //         inner join genre g on fg.idgenre = g.id 
        //         where idfilm = $id")
        //     ->result_array();
        // $barang['genre'] = $genre;
        // dd($barang);
        return $barang;
    }

    public function related($id)
    {
        // Mengambil data film terkait berdasarkan genrenya.
        $kategori = $this
            ->db
            ->query("SELECT idkategori FROM barang where id = $id")
            ->row_array();
        $idkategori = [$kategori['idkategori']];
        // dd($idgenres);
        $barangByKategori = $this
            ->db
            ->select('b.*')
            ->from('barang b')
            ->join('kategori k', 'k.id = b.idkategori')
            ->where_in('idkategori', $idkategori) //Mencari dengan genre terkait
            ->where_not_in('b.id', [$id]) //Barang saat ini tidak ikut ter-select
            ->limit(10)
            ->get()
            ->result_array();
        // dd($barangByGenre);
        return ($barangByKategori);
    }

    public function findByKategori($idkategoris, $limit=15,$offset=0)
    {
        // Mengambil data film berdasarkan genrenya.
        $barangByGenre = $this
            ->db
            ->select('b.*')
            ->from('barang b')
            ->join('kategori k', 'k.id=b.idkategori')
            ->where_in('idkategori', $idkategoris)
            ->order_by('nama', 'ASC')
            ->limit($limit)
            ->offset($offset)
            ->get()
            ->result_array();
        // dd($barangByGenre);
        return ($barangByGenre);
    }

    public function findByKategoriCount($idkategoris)
    {
        // Mengambil data film berdasarkan genrenya.
        $barangByGenre = $this
            ->db
            ->select('b.*')
            ->from('barang b')
            ->join('kategori k', 'k.id=b.idkategori')
            ->where_in('idkategori', $idkategoris)
            ->get()
            ->result_array();
        // dd($barangByGenre);
        return count($barangByGenre);
    }

    public function kategori()
    {
        $kategori = $this
            ->db
            ->get('kategori')
            ->result_array();
        return $kategori;
    }

    public function add($data)
    {
        // Insert data film
        $this
            ->db
            ->insert('film', [
                'judul' => $data['judul'],
                'sinopsis' => $data['sinopsis'],
                'tglrilis' => $data['tglrilis'],
                'durasi' => $data['durasi'],
                'rating' => $data['rating'],
            ]);
        $idfilm = $this->db->insert_id();
        
        // Insert data genre
        $data_genre = [];
        foreach ($data['genre'] as $i => $idgenre) {
            $data_genre[] = ['idfilm' => $idfilm, 'idgenre' => $idgenre];
        }
        $this
            ->db
            ->insert_batch("film_genre", $data_genre);
        // Insert data kualitas
        $this
            ->db
            ->insert_batch("film_kualitas", [
                ['idfilm' => $idfilm, 'kualitas' => '480p', 'url' => $data['link_sd']],
                ['idfilm' => $idfilm, 'kualitas' => '720p', 'url' => $data['link_hd']],
            ]);
        
        return $idfilm;
    }

    public function update($data)
    {
        // Insert data film
        $this
            ->db
            ->where('id', $data['id'])
            ->update('film', [
                'judul' => $data['judul'],
                'sinopsis' => $data['sinopsis'],
                'tglrilis' => $data['tglrilis'],
                'durasi' => $data['durasi'],
                'rating' => $data['rating'],
            ]);
        $idfilm = $data['id'];
        
        // Delete semua genre dari film saat ini
        $this->db->delete('film_genre', ['idfilm' => $idfilm]);
        // Insert data genre
        $data_genre = [];
        foreach ($data['genre'] as $i => $idgenre) {
            $data_genre[] = ['idfilm' => $idfilm, 'idgenre' => $idgenre];
        }
        $this
            ->db
            ->insert_batch("film_genre", $data_genre);
        
        // Hapus semua link film
        $this->db->delete('film_kualitas', ['idfilm' => $idfilm]);
        // Insert data kualitas
        $this
            ->db
            ->insert_batch("film_kualitas", [
                ['idfilm' => $idfilm, 'kualitas' => '480p', 'url' => $data['link_sd']],
                ['idfilm' => $idfilm, 'kualitas' => '720p', 'url' => $data['link_hd']],
            ]);

        
        return $idfilm;
    }

    public function delete($id)
    {
        // Hapus genrenya dulu
        $this->db->delete('film_genre', ['idfilm' => $id]);
        // Hapus kualitasnya
        $this->db->delete('film_kualitas', ['idfilm' => $id]);
        // Hapus data histori film
        $this->db->delete('user_histori', ['idfilm' => $id]);

        // Hapus filmnya
        $this->db->delete('film', ['id' => $id]);
    }
}
