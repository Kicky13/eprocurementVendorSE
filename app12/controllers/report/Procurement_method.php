<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Procurement_method extends CI_Controller {
    protected $menu;

    public function __construct() {
        parent::__construct();
        $this->load->model('vendor/M_vendor');
        $this->load->model('vendor/M_all_intern', 'mai');
        $this->load->model('report/m_report');        

        $this->mai->cek_session();
        $get_menu = $this->M_vendor->menu();
        $this->menu = array();
        foreach ($get_menu as $k => $v) {
            $this->menu[$v->PARENT][$v->ID_MENU]['ICON'] = $v->ICON;
            $this->menu[$v->PARENT][$v->ID_MENU]['URL'] = $v->URL;
            $this->menu[$v->PARENT][$v->ID_MENU]['DESKRIPSI_IND'] = $v->DESKRIPSI_IND;
            $this->menu[$v->PARENT][$v->ID_MENU]['DESKRIPSI_ENG'] = $v->DESKRIPSI_ENG;
        }
    }        

    public function goods() {   
        if ($this->input->is_ajax_request()) {     
            return $this->get('GOODS');
        }
        $data['menu'] = $this->menu;        
        $data['title'] = 'Report Procurement Method (GOODS)';
        $this->template->display('report/V_procurement_method', $data);
    }

    public function service() {        
        if ($this->input->is_ajax_request()) {     
            return $this->get('SERVICE');
        }
        $data['menu'] = $this->menu;
        $data['rs_company'] = $this->m_report->get_company();     
        $data['title'] = 'Report Procurement Method (Service)';   
        $this->template->display('report/V_procurement_method', $data);
    }

    protected function get($type) {
        $this->load->library('datatable');
        $filter = $this->input->get('filter');        
        $condition = array();
        if (isset($filter['company'])) {            
            $condition[] = 't_msr.id_company IN (\''.implode('\',\'', $filter['company']).'\')';
        }
        if ($filter['begin_date']) {            
            $condition[] = 't_purchase_order.po_date >= \''.date('Y-m-d', strtotime($filter['begin_date'])).'\'';
        }
        if ($filter['end_date']) {            
            $condition[] = 't_purchase_order.po_date <= \''.date('Y-m-d', strtotime($filter['end_date'])).'\'';
        }
        if (count($condition) <> 0) {
            $condition_query = 'AND '.implode(' AND ', $condition);
        } else {
            $condition_query = '';
        }  
        $total_agreement = $this->db->select('SUM(COALESCE(agreement.value, 0)) AS total_agreement')
        ->join('(
            SELECT 
                t_msr.id_pmethod AS id_pmethod, 
                count(1) AS number, 
                SUM(total_price_base) AS value,
                SUM(
                    CASE
                        WHEN t_msr.id_importation = \'L\' THEN t_purchase_order_detail.total_price_base
                        ELSE 0
                    END
                ) as local_value
            FROM t_purchase_order_detail
            JOIN t_purchase_order ON t_purchase_order.id = t_purchase_order_detail.po_id
            JOIN t_msr ON t_msr.msr_no = t_purchase_order.msr_no            
            WHERE t_purchase_order_detail.id_itemtype = \''.$type.'\'
            '.$condition_query.'
            GROUP BY t_msr.id_pmethod
        ) agreement', 'agreement.id_pmethod = m_pmethod.ID_PMETHOD', 'left')
        ->get('m_pmethod')
        ->row();

        return $this->datatable->resource('m_pmethod', '
            m_pmethod.PMETHOD_DESC AS method, 
            COALESCE(agreement.number, 0) AS number,
            COALESCE(agreement.value, 0) AS value,
            COALESCE(local_value, 0) AS local_value
        ')        
        ->join('(
            SELECT 
                t_msr.id_pmethod AS id_pmethod, 
                count(1) AS number, 
                SUM(total_price_base) AS value,
                SUM(
                    CASE
                        WHEN t_msr.id_importation = \'L\' THEN t_purchase_order_detail.total_price_base
                        ELSE 0
                    END
                ) as local_value
            FROM t_purchase_order_detail
            JOIN t_purchase_order ON t_purchase_order.id = t_purchase_order_detail.po_id
            JOIN t_msr ON t_msr.msr_no = t_purchase_order.msr_no            
            WHERE t_purchase_order_detail.id_itemtype = \''.$type.'\'
            '.$condition_query.'
            GROUP BY t_msr.id_pmethod
        ) agreement', 'agreement.id_pmethod = m_pmethod.ID_PMETHOD', 'left')        
        ->add_column('total_agreement', $total_agreement->total_agreement)        
        ->generate();        
    }
}