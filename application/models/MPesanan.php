<?php

class MPesanan extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function addtocart($params)
    {
        // Cek apakah sudah ada data keranjang
        $keranjang = $this
            ->db
            ->get_where('pesanan', [
                'iduser' => $params['iduser'],
                'status' => 0
            ])
            ->row_array();

        // dd($keranjang);
        if (!empty($keranjang)) {
            $idpesanan = $keranjang['id'];
            // Cek apakah barang sudah ada di keranjang?
            $diKeranjang = $this
                ->db
                ->get_where('pesanan_detail', [
                    'idbarang' => $params['idbarang'],
                    'idpesanan' => $idpesanan
                ])
                ->row_array();
            if (!empty($diKeranjang)) {
                // Tambah jumlahnya
                $this
                    ->db
                    ->where('id', $diKeranjang['id'])
                    ->update('pesanan_detail', [
                        'jml' => $diKeranjang['jml'] + 1
                    ]);
            } else {
                // Insert detail di Keranjang
                $this
                    ->db
                    ->insert('pesanan_detail', [
                        'idpesanan' => $idpesanan,
                        'idbarang' => $params['idbarang'],
                        'jml' => $params['jml'],
                        'harga' => $params['harga'],
                    ]);
            }
        } else {
            // Create keranjang baru
            $this->db->insert('pesanan', [
                'iduser' => $this->session->id,
                'status' => 0
            ]);
            $idpesanan = $this->db->insert_id();
            $this
                ->db
                ->insert('pesanan_detail', [
                    'idpesanan' => $idpesanan,
                    'idbarang' => $params['idbarang'],
                    'jml' => $params['jml'],
                    'harga' => $params['harga'],
                ]);
        }
    }

    public function getKeranjang($iduser)
    {
        $data = $this
            ->db
            ->select('pd.*, b.nama')
            ->from('pesanan_detail pd')
            ->join('pesanan p', 'p.id=pd.idpesanan')
            ->join('barang b', 'b.id=pd.idbarang')
            ->where('p.status', 0)
            ->where('iduser', $iduser)
            ->get()
            ->result_array();
        return $data;
    }

    public function removecart($idpesanandetail)
    {
        $this->db->delete('pesanan_detail', array('id' => $idpesanandetail));
    }

    public function getDetail($idpesanandetail)
    {
        $detail = $this
            ->db
            ->query("SELECT b.*, k.nama as kategori, pd.id FROM
            pesanan_detail pd 
            INNER JOIN barang b on b.id = pd.idbarang
             INNER JOIN kategori k ON k.id = b.idkategori 
             WHERE pd.id = $idpesanandetail")
            ->row_array();
        return $detail;
    }

    public function updatecart($params)
    {
        $this
            ->db
            ->where('id', $params['id'])
            ->update('pesanan_detail', [
                'jml' => $params['jml']
            ]);
    }
}
