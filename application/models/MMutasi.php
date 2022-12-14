<?php

class MMutasi extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get($filter)
    {
        $iduser = $filter['iduser'];
        $tglawal = $filter['tglawal'];
        $tglakhir = $filter['tglakhir'];
        $page = $filter['page'];
        $cari = $filter['cari'];

        $limit = 15;
        $offset = ($page - 1) * $limit;
        $query = "SELECT *
            FROM mutasi
            WHERE iduser = $iduser
                AND keterangan LIKE '%$cari%'
                AND tgl BETWEEN '$tglawal 00:00:00' AND '$tglakhir 23:59:59'
            LIMIT $limit OFFSET $offset";
        // dd($query);

        $qCount = "SELECT COUNT(id) as count
            FROM mutasi
            WHERE iduser = $iduser
                AND keterangan LIKE '%$cari%'
                AND tgl BETWEEN '$tglawal 00:00:00' AND '$tglakhir 23:59:59'";
        $res = $this->db->query($query)->result_array();
        $resCount = $this->db->query($qCount)->row_array();
        // dd($resCount);

        // for ($i = 0; $i < 0; $i++) {
        //     $randomFloat = rand(0, 10) / 10;
        //     $cuan = $randomFloat * 20000;
        //     $data = [
        //         'iduser' => 9,
        //         'idadmin' => 1,
        //         'kredit' => $cuan,
        //         'debit' => 0,
        //         'keterangan' => "Penyerahan Sampah Masker seberat {$randomFloat}kg"
        //     ];
        //     $this->db->insert('mutasi', $data);
        // }

        return ['data' => $res, 'count' => $resCount['count']];
    }
}
