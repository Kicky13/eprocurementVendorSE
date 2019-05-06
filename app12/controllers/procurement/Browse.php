<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Browse extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_base');
    }

    public function po() {
        $this->load->model('procurement/arf/m_arf_po');
        if ($this->input->get('datatable') == 1) {
            $this->load->library('m_datatable');
            return $this->m_datatable->resource($this->m_arf_po)
            ->view('po')
            ->filter(function($model) {
                if ($issued = $this->input->get('issued')) {
                    $model->where('t_purchase_order.issued', $issued);
                }
                if ($creator = $this->input->get('creator')) {
                    $model->where('t_msr.create_by', $creator);
                }
            })
            ->edit_column('po_type', function($model) {
                return $this->m_arf_po->enum('type', $model->po_type);
            })
            ->generate();
        }
        $this->load->view('procurement/browse/po');
    }
}