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
    public function last_amd_doc_no($doc_no='')
    {
        $amd = $this->db->where('doc_no <=', $doc_no)->get('t_arf_recommendation_preparation')->result();
        $data['amd'] = $amd;

        $response = [];
            $response_detail = [];
            $nego_details_array = [];
        foreach ($amd as $key => $value) {
            $res = $this->db->where(['id'=>$value->arf_response_id])->get('t_arf_response')->result();
            $response[] = $res;
            foreach ($res as $r) {
                $res_detail = $this->db->where(['doc_no'=>$r->doc_no])->get('t_arf_response_detail')->result();
                $response_detail[] = $res_detail;
            }

            $nego = $this->db->where(['status'=>2, 'arf_response_id'=>$value->arf_response_id])->order_by('id','desc')->get('t_arf_nego');
            if($nego->num_rows() > 0)
            {
                $nego = $nego->row();
                $nego_details = $this->db->where(['is_nego'=>1, 'arf_nego_id'=>$nego->id])->order_by('id','asc')->get('t_arf_nego_detail');
                if($nego_details->num_rows() > 0)
                {
                    $nego_details_array[] = $nego_details->result();
                }
            }
        }

        $latest_price = [];
        foreach ($response_detail as $response_details) {
            $new_data_array = [];
            foreach ($response_details as $val) {
                // echo $val->detail_id;
                $new_data['unit_price'] = $val->unit_price;
                foreach ($nego_details_array as $nego_detail) {
                    foreach ($nego_detail as $nego_val) {
                        if($nego_val->arf_sop_id == $val->detail_id)
                        {
                            $new_data['unit_price'] = $nego_val->unit_price;
                        }
                    }    
                }
                $new_data_array[] = $new_data;
            }
            
            $latest_price[] = $new_data_array;
            # code...
        }
        $data['response'] = $response;
        $data['response_detail'] = $response_detail;
        $data['nego_details_array'] = $nego_details_array;
        $data['latest_price'] = $latest_price;

        echo "<pre>";
        print_r($data);
    }
    public function last_amd_when_create_amd($amd_no='')
    {
      /*get from arf response all include this amd*/
      $po_no = substr($amd_no, 0,17);
      /*echo $po_no;
      $arf->amount_po
      exit();*/
      $arf_response =$this->db->select('t_arf_response.*,t_arf.amount_po')->where(['t_arf_response.doc_no <'=>$amd_no, 't_arf.po_no'=>$po_no])->join('t_arf','t_arf.doc_no = t_arf_response.doc_no','left')->get('t_arf_response');
      $table = "<table width='100%' border='1' rules='all' cellpadding='2' cellspacing='2'>";
      $all_total = 0;
      foreach ($arf_response->result() as $key => $value) {
        $total = 0;
        $table .= "<tr bgcolor='#cccaaa'><td colspan='7'>$value->doc_no</td></tr>";
        $table .= "<tr bgcolor='#ccceee'><td>QTY1</td><td>QTY2</td><td>QTY</td><td>UNIT PRICE</td><td>NEGO PRICE</td><td>SUB TOTAL</td><td>AFTER NEGO</td></tr>";
        $arf_response_detail = $this->db->where('doc_no',$value->doc_no)->get('t_arf_response_detail');
        foreach ($arf_response_detail->result() as $detail) {
          $qty = $detail->qty2 > 0 ? $detail->qty1*$detail->qty2 : $detail->qty1;
          $sub_total  = $qty * $detail->unit_price;
          $sub_total_str = numIndo($sub_total);
          $qty_str = numIndo($qty,0);
          $unit_price_str = numIndo($detail->unit_price,0);

          // echo $this->db->last_query();
          $arf_nego = $this->db->where(['arf_response_id'=>$value->id, 'is_nego'=>1, 'arf_sop_id'=>$detail->detail_id])->order_by('id','desc')->get('t_arf_nego_detail')->row();
          if($arf_nego)
          {
            $nego_price = $arf_nego->unit_price;
            $nego_price_str = numIndo($nego_price);
            $sub_total_any_nego = $nego_price * $qty;
            $sub_total_any_nego_str = numIndo($sub_total_any_nego);
          }
          else
          {
            $nego_price = 0;
            $nego_price_str = numIndo($nego_price);
            $sub_total_any_nego = $sub_total;  
            $sub_total_any_nego_str = numIndo($sub_total_any_nego);
          }
          $total += $sub_total_any_nego;
          $table .= "<tr><td>$detail->qty1</td><td>$detail->qty2</td><td align='center'>$qty_str</td><td align='right'>$unit_price_str</td><td align='right'>$nego_price_str</td><td align='right'>$sub_total_str</td><td align='right'>$sub_total_any_nego_str</td></tr>";
          # code...
        }
        $all_total += $total;
        $total_str = numIndo($total);
        $table .= "<tr bgcolor='#333'><td colspan='6'>&nbsp;</td><td align='right' bgcolor='#eee'>$total_str</td></tr>";

      }
      $all_total_str = numIndo($all_total);
      $table .= "<tr bgcolor='#ccc333'><td colspan='6'>TOTAL ALL </td><td align='right'>$all_total_str</td></tr>";
      $table .= "</table>";
      if($this->input->get('debug'))
      {
        echo $table;
      }
      else
      {
        if($arf_response->row())
        {
          $amount_po = $arf_response->row()->amount_po;
        }
        else
        {
          $amount_po = $this->db->where('doc_no',$amd_no)->get('t_arf')->row()->amount_po;
        }
        echo $amount_po+$all_total;
      }
    }
    public function additional_value($amd_no='')
    {
      /*get from arf response all include this amd*/
      $po_no = substr($amd_no, 0,17);
      /*echo $po_no;
      $arf->amount_po
      exit();*/
      $arf_response =$this->db->select('t_arf_response.*,t_arf.amount_po')->where(['t_arf_response.doc_no '=>$amd_no, 't_arf.po_no'=>$po_no])->join('t_arf','t_arf.doc_no = t_arf_response.doc_no','left')->get('t_arf_response');
      $table = "<table width='100%' border='1' rules='all' cellpadding='2' cellspacing='2'>";
      $all_total = 0;
      foreach ($arf_response->result() as $key => $value) {
        $total = 0;
        $table .= "<tr bgcolor='#cccaaa'><td colspan='7'>$value->doc_no</td></tr>";
        $table .= "<tr bgcolor='#ccceee'><td>QTY1</td><td>QTY2</td><td>QTY</td><td>UNIT PRICE</td><td>NEGO PRICE</td><td>SUB TOTAL</td><td>AFTER NEGO</td></tr>";
        $arf_response_detail = $this->db->where('doc_no',$value->doc_no)->get('t_arf_response_detail');
        foreach ($arf_response_detail->result() as $detail) {
          $qty = $detail->qty2 > 0 ? $detail->qty1*$detail->qty2 : $detail->qty1;
          $sub_total  = $qty * $detail->unit_price;
          $sub_total_str = numIndo($sub_total);
          $qty_str = numIndo($qty,0);
          $unit_price_str = numIndo($detail->unit_price,0);

          // echo $this->db->last_query();
          $arf_nego = $this->db->where(['arf_response_id'=>$value->id, 'is_nego'=>1, 'arf_sop_id'=>$detail->detail_id])->order_by('id','desc')->get('t_arf_nego_detail')->row();
          if($arf_nego)
          {
            $nego_price = $arf_nego->unit_price;
            $nego_price_str = numIndo($nego_price);
            $sub_total_any_nego = $nego_price * $qty;
            $sub_total_any_nego_str = numIndo($sub_total_any_nego);
          }
          else
          {
            $nego_price = 0;
            $nego_price_str = numIndo($nego_price);
            $sub_total_any_nego = $sub_total;  
            $sub_total_any_nego_str = numIndo($sub_total_any_nego);
          }
          $total += $sub_total_any_nego;
          $table .= "<tr><td>$detail->qty1</td><td>$detail->qty2</td><td align='center'>$qty_str</td><td align='right'>$unit_price_str</td><td align='right'>$nego_price_str</td><td align='right'>$sub_total_str</td><td align='right'>$sub_total_any_nego_str</td></tr>";
          # code...
        }
        $all_total += $total;
        $total_str = numIndo($total);
        $table .= "<tr bgcolor='#333'><td colspan='6'>&nbsp;</td><td align='right' bgcolor='#eee'>$total_str</td></tr>";

      }
      $all_total_str = numIndo($all_total);
      $table .= "<tr bgcolor='#ccc333'><td colspan='6'>TOTAL ALL </td><td align='right'>$all_total_str</td></tr>";
      $table .= "</table>";
      if($this->input->get('debug'))
      {
        echo $table;
      }
      else
      {
        echo $all_total;
      }
    }
}