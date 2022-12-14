<?php 

class MKategori extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $kategori = $this->db->get("kategori k")->result_array();
        return $kategori;
    }

    public function find($id)
    {
        $res = $this
            ->db
            ->get_where('kategori', [
                'id' => $id
            ])
            ->row_array();
        return $res;
    }
}
