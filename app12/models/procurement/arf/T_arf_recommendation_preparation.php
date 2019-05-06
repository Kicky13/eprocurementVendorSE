<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class T_arf_recommendation_preparation extends CI_Model {
	public function __construct() {
      parent::__construct();
      $this->db = $this->load->database('default', true);
      $this->table = 't_arf_recommendation_preparation';
  }
  public function view($id='')
  {
  	$r = $this->db->where(['arf_response_id'=>$id])->get($this->table)->row();
  	$data['new_date_1'] = $r ? dateToIndo($r->new_date_1) : '';
  	$data['new_date_2'] = $r ? dateToIndo($r->new_date_2) : '';
    $data['recom'] = $r;
  	return $data;
  }
}