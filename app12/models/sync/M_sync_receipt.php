<?php

if (!defined('BASEPATH'))
    exit('Anda tidak masuk dengan benar');

class M_sync_receipt extends MY_Model {
    protected $table = 'sync_receipt';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        return $this->db->get($this->table)->result();
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get($this->table)->result()[0];
    }

    public function deleteAll()
    {
        return $this->db->empty_table($this->table);
    }

}
   

?>
