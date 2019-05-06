<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Amendment_recommendation extends CI_Controller {

    protected $menu;
    protected $document_path = 'upload/ARF';
    protected $document_allowed_types = 'jpg|jpeg|pdf|doc|docx';
    protected $document_max_size = '2048';

    public function __construct() {
        parent::__construct();
        $this->load->library('url_generator');
        $this->load->library('redirect');

        $this->load->model('vendor/M_vendor');
        $this->load->model('vendor/M_all_intern', 'mai');

        $this->load->model('m_base');
        $this->load->model('procurement/m_procurement');
        $this->load->model('procurement/arf/m_arf_sop');
        $this->load->model('procurement/arf/m_arf_response');
        $this->load->model('procurement/arf/m_arf_response_attachment');
        $this->load->model('procurement/arf/m_arf_po');
        $this->load->model('procurement/arf/m_arf_po_detail');
        $this->load->model('procurement/arf/m_arf_detail');
        $this->load->model('procurement/arf/m_arf_detail_revision');
        $this->load->model('procurement/arf/T_approval_arf_recom');
        $this->load->model('procurement/arf/T_arf_recommendation_preparation');


        $this->load->library('form');
        $this->load->helper('data_builder_helper');
        $this->load->helper('exchange_rate_helper');

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

    public function arf_response() {
        if ($this->input->is_ajax_request()) {
            $this->load->library('m_datatable');
            // $this->db->where('`t_arf_response`.`id` not in',"(select arf_response_id from t_arf_recommendation_preparation)", false);
            return $this->m_datatable->resource($this->m_arf_response)
            ->view('arf_response')->scope(array('recommendation_preparation', 'procurement_specialist'))
            ->add_column('status', function($model) {
                if (strtotime($model->close_date) > strtotime(date('Y-m-d'))) {
                    return 'Open';
                } else {
                    return 'Closed';
                }
            })
            ->generate();
        }
        $data['menu'] = $this->menu;
        $data['lists'] = $this->m_arf_response->view('arf_response')->scope(array('recommendation_preparation', 'procurement_specialist'))->get();
        $this->template->display('procurement/V_amendment_recommendation_arf_response', $data);
    }

    public function create($id) {
        $arf = $this->m_arf_response->view('arf_response')->find_or_fail($id);
        $t_arf_notification = $this->db->where(['doc_no'=>$arf->doc_no])->get('t_arf_notification')->row();
        // $arf->item = $this->m_arf_detail->view('response_item')->where('doc_id', $arf->doc_id)->get();
        $arf->item = $this->m_arf_sop->view('response')->select('t_arf_nego_detail.unit_price new_price')
        ->join('t_arf_nego_detail', 't_arf_sop.id = t_arf_nego_detail.arf_sop_id', 'left')
        ->join('(select * from t_arf_nego where status = 2 order by id desc limit 1) t_arf_nego','t_arf_nego.id = t_arf_nego_detail.arf_nego_id', 'left')->where('t_arf_sop.doc_id', $t_arf_notification->id)->get();
        foreach ($this->m_arf_detail_revision->where('doc_id', $arf->doc_id)->get() as $revision) {
            $arf->revision[$revision->type] = $revision;
        }
        $arf->response_attachment = $this->m_arf_response_attachment->where('t_arf_response_attachment.doc_id', $arf->doc_id)
        ->get();
        $po = $this->m_arf_po->where('t_purchase_order.po_no', $arf->po_no)
        ->first();
        $po->po_type = $this->m_arf_po->enum('type', $po->po_type);
        $po->item = $this->m_arf_po_detail->view('po_detail')
        ->where('t_purchase_order_detail.po_id', $po->id)
        ->get();
        $data = $this->T_arf_recommendation_preparation->view($id);
        $data['arf'] = $arf;
        $data['po'] = $po;
        $data['document_path'] = $this->document_path;
        $data['menu'] = $this->menu;
        $data['doc'] = $this->db->where(['module_kode'=>'arf-recom-prep','data_id'=>$arf->doc_no])->get('t_upload')->result();
        $data['view'] = false;
        $data['approval_view'] = false;
        $data['newAgreementPeriodTo'] = $this->newAgreementPeriodTo($arf);
        if($this->input->get('debug'))
        {
            echo $this->db->last_query();
        }
        $data['addTime'] = $this->addTime($arf,$po);
        if($this->input->get('debug'))
        {
            exit();
        }
        $data['approval_list'] = $this->approval_list($id);
        $this->template->display('procurement/V_amendment_recommendation_create', $data);
    }
    public function attachment_upload($value='')
    {
        $config['upload_path']  = './upload/ARFRECOMPREP/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'],0755,TRUE);
        }
        $config['allowed_types']= '*';
        
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file_path'))
        {
            echo $this->upload->display_errors('', '');exit;
        }else
        {
            $user = user();
            $data = $this->upload->data();
            $field = $this->input->post();
            $field['file_path'] = $data['file_name'];
            $field['created_by'] = $user->ID_USER;
            $this->db->insert('t_upload',$field);
        }
        $this->dt_attachment($this->input->post('module_kode'));
    }
    public function hapus_attachment($value='')
    {
        $this->db->where('id',$value);
        $upload = $this->db->get('t_upload')->row();
        $data_id = $upload->data_id;
        $module_kode = $upload->module_kode;
        @unlink('upload/ARFRECOMPREP/'.$upload->file_path);

        $this->db->where('id',$value);
        $this->db->delete('t_upload');
        $this->dt_attachment($module_kode);
    }
    public function dt_attachment($module_kode='arf-recom-prep')
    {
        $doc = $this->db->where(['module_kode'=>$module_kode,'data_id'=>$this->input->post('data_id')])->get('t_upload')->result();

        foreach ($doc as $key => $value) {
            if($module_kode == 'arf-issued')
            {
                $type =  "Amendment Signed";
            }
            else
            {
                $type = arfRecomPrepType($value->tipe, true);
            }
            echo "<tr>
              <td>".$type."</td>
              <td>".$value->file_path."</td>
              <td>".$value->created_at."</td>
              <td>".user($value->created_by)->NAME."</td>
              <td>
                <a href='".base_url('upload/ARFRECOMPREP/'.$value->file_path)."' target='_blank' class='btn btn-sm btn-primary'>Download</a>
                <a href='#' class='btn btn-sm btn-danger' onclick='hapusFile($value->id)'>Hapus</a>
              </td>
            </tr>";
        }
    }
    public function store($value='')
    {
        $this->db->trans_begin();
        $user = user();
        $data = $this->input->post();
        $t_arf_recommendation_preparation = $this->db->where(['arf_response_id'=>$data['arf_response_id']])->get('t_arf_recommendation_preparation')->row();
        $field = [
            'arf_response_id'   => $data['arf_response_id'],
            'doc_no'            => $data['doc_no'],
            'po_no'             => $data['po_no'],
            'analysis'          => $data['analysis'],
            'nego'              => $data['nego'],
            'nego_str'          => $data['nego_str'],
            'budget_analysis'   => $data['budget_analysis'],
            'bod_approval'      => $data['bod_approval'],
            'aa'                => $data['aa'],
            'extend1'           => @$data['extend1'] ? $data['extend1'] : 0,
            'extend2'           => @$data['extend2'] ? $data['extend2'] : 0,
            'new_date_1'        => @$data['new_date_1'] ? $data['new_date_1'] : null,
            'new_date_2'        => @$data['new_date_2'] ? $data['new_date_2'] : null,
            'remarks_1'         => @$data['remarks_1'] ? $data['remarks_1'] : null,
            'remarks_2'         => @$data['remarks_2'] ? $data['remarks_2'] : null,
            'status'            => 0,
            'created_at'        => date("Y-m-d H:i:s"),
            'created_by'        => $user->ID_USER,
        ];
        if($t_arf_recommendation_preparation)
        {
            $this->db->where(['id'=>$t_arf_recommendation_preparation->id]);
            $this->db->update('t_arf_recommendation_preparation', $field);
            $this->approval_update($data['doc_no'], $data['arf_response_id']);
        }
        else
        {
            $this->db->insert('t_arf_recommendation_preparation', $field);
            /*generate approval*/
            $this->approval($data['doc_no'], $data['arf_response_id']);
        }

        if($this->db->trans_status() === true)
        {
            $this->db->trans_commit();
            echo json_encode(['status'=>true,'msg'=>'Amendment Submitted']);
        }
        else
        {
            $this->db->trans_rollback();
            echo json_encode(['status'=>false,'msg'=>'Fail, Try Again']);
        }
    }
    public function approval($doc_no='', $arf_response_id='')
    {
        $rs = $this->db->where(['module'=>16,'status'=>1])->order_by('sequence', 'asc')->get('m_approval_rule')->result();
        $data = array();
        $arf = $this->db->where(['doc_no'=>$doc_no])->get('t_arf')->row();
        foreach ($rs as $r) {
            // $this->db->like('ROLES','')
            if($r->user_roles == 28)
            {
                $ps = $this->db->select('t_arf_assignment.*')
                ->join('t_arf','t_arf.po_no = t_arf_assignment.po_no')
                ->where(['doc_id'=>$arf->id])->get('t_arf_assignment')->row();
                $user = $ps->user_id;
            }
            if($r->user_roles == 23)
            {
                $m_user = $this->db->like('ROLES',$r->user_roles)->get('m_user')->row();
                $user = $m_user->ID_USER;
            }
            if($r->user_roles == 41)
            {
                $arf = $this->db->where(['doc_no'=>$doc_no])->get('t_arf')->row();
                $user = $arf->created_by;
            }
            if($r->user_roles == 18)
            {
                /*t_jabatan*/
                $t_jabatan = $this->db->where(['user_id'=>$arf->created_by])->get('t_jabatan')->row();
                $s = $this->db->where(['id'=>$t_jabatan->parent_id])->get('t_jabatan')->row();
                /*cek di m_user*/
                $msr_company = trim($s->company_id);
                $q = $this->db->like('COMPANY',$msr_company)->where('ID_USER',$s->user_id)->get('m_user');
                if($q->num_rows() > 0)
                {

                }
                else
                {
                   $s = $this->db->where(['first'=>1])->get('t_jabatan')->row();
                }
                $user = $s->user_id;
            }
            if($r->user_roles == 27)
            {
                /*PROCUREMENT COMMITEE*/ /*PROCUREMENT COMMITEE - CHAIRMAN*/
                $user = array();
                $myUser = $this->db->like('ROLES','27')->or_like('ROLES','100004')->where(['STATUS'=>1])->get('m_user')->result();
                foreach ($myUser as $u) {
                    $user[] = $u->ID_USER;
                }
            }
            if(is_array($user))
            {   
                foreach ($user as $u => $ser) {
                    $data[] = [
                        'id_ref' => $arf_response_id,
                        'id_user_role' => $r->user_roles,
                        'id_user' => $ser,
                        'sequence' => $r->sequence,
                        'description' => $r->description,
                        'note' => null,
                        'reject_step' => $r->reject_step,
                        'email_approve' => $r->email_approve,
                        'email_reject' => $r->email_reject,
                        'edit_content' => $r->edit_content,
                        'status' => 0,
                        'approved_by' => 0,
                        'approved_at' => null
                    ];
                }
            }
            else
            {
                $data[] = [
                    'id_ref' => $arf_response_id,
                    'id_user_role' => $r->user_roles,
                    'id_user' => $user,
                    'sequence' => $r->sequence,
                    'description' => $r->description,
                    'note' => null,
                    'reject_step' => $r->reject_step,
                    'email_approve' => $r->email_approve,
                    'email_reject' => $r->email_reject,
                    'edit_content' => $r->edit_content,
                    'status' => $r->sequence == 1 ? 1 : 0,
                    'approved_by' => 0,
                    'approved_at' => null
                ];
            }
        }
        $this->db->insert_batch('t_approval_arf_recom', $data);
    }
    public function approval_view($value='')
    {
        if ($this->input->is_ajax_request()) {
            $this->load->library('m_datatable');
            return $this->m_datatable->resource($this->m_arf)
            ->view('approval')
            ->scope('approval')
            ->edit_column('po_type', function($model) {
                return $this->m_arf_po->enum('type', $model->po_type);
            })
            ->edit_column('status', function($model) {
                return $this->m_arf->enum('status', $model->status);
            })
            ->generate();
        }
        $data['menu'] = $this->menu;
        $data['lists'] = $this->T_approval_arf_recom->time_approval();
        
        $this->template->display('procurement/V_arf_recom_approval', $data);
    }
    public function view($id='')
    {
        $arf = $this->m_arf_response->view('arf_response')->find_or_fail($id);
        $t_arf_notification = $this->db->where(['doc_no'=>$arf->doc_no])->get('t_arf_notification')->row();
        $arf->item = $this->m_arf_sop->view('response')->select('t_arf_nego_detail.unit_price new_price')
        ->join('t_arf_nego_detail', 't_arf_sop.id = t_arf_nego_detail.arf_sop_id', 'left')
        ->join('(select * from t_arf_nego where status = 2 order by id desc limit 1) t_arf_nego','t_arf_nego.id = t_arf_nego_detail.arf_nego_id', 'left')->where('t_arf_sop.doc_id', $t_arf_notification->id)->get();
        /*echo "<pre>";
        echo $this->db->last_query();
        echo "<br>";
        print_r($arf->item);
        exit();*/
        foreach ($this->m_arf_detail_revision->where('doc_id', $arf->doc_id)->get() as $revision) {
            $arf->revision[$revision->type] = $revision;
        }
        $arf->response_attachment = $this->m_arf_response_attachment->where('t_arf_response_attachment.doc_id', $arf->doc_id)
        ->get();
        $po = $this->m_arf_po->where('t_purchase_order.po_no', $arf->po_no)
        ->first();
        $po->po_type = $this->m_arf_po->enum('type', $po->po_type);
        $po->item = $this->m_arf_po_detail->view('po_detail')
        ->where('t_purchase_order_detail.po_id', $po->id)
        ->get();
        $data = $this->T_arf_recommendation_preparation->view($id);
        $data['arf'] = $arf;
        $data['po'] = $po;
        $data['document_path'] = $this->document_path;
        $data['menu'] = $this->menu;
        $data['doc'] = $this->db->where(['module_kode'=>'arf-recom-prep','data_id'=>$arf->doc_no])->get('t_upload')->result();
        $data['view'] = true;
        $data['approval_list'] = $this->approval_list($id);
        $data['newAgreementPeriodTo'] = $this->newAgreementPeriodTo($arf);
        $data['addTime'] = $this->addTime($arf,$po);
        $data['approval_view'] = true;

        $time_issued = $this->T_approval_arf_recom->time_issued($id)->num_rows();
        if($time_issued > 0)
        {
            $data['issued'] = $time_issued;
            $data['title'] = 'Amendment Issuance';
            $data['doc'] = $this->db->where(['module_kode'=>'arf-issued','data_id'=>$arf->doc_no])->get('t_upload')->result();
        }
        $data['is_reject'] = $this->T_approval_arf_recom->is_reject($id);
        
        $this->template->display('procurement/V_amendment_recommendation_create', $data);
    }
    public function approve($value='')
    {
        $this->T_approval_arf_recom->approve();
    }
    public function issued($value='')
    {
        $this->T_approval_arf_recom->issued();
        echo json_encode(['status'=>true, 'msg'=>"Issued"]);
    }
    public function newAgreementPeriodTo($arf='')
    {
        $doc_date = $this->db->where(['po_no'=>$arf->po_no])->order_by('doc_date','desc')->get('t_arf')->row();
        $doc_date = $doc_date->doc_date;

        $detail_revision = $this->m_arf_detail_revision->detail_revision($arf);
        if($this->input->get('debug'))
        {
            echo $this->db->last_query();
        }
        $myDate = $doc_date;

        if($detail_revision->num_rows() > 0)
        {
          $detail_revision = $detail_revision->row();
          $dariArf = date('Y-m-d', strtotime($doc_date));
          $dariDetail = date('Y-m-d', strtotime($detail_revision->value));
          $myDate = $dariArf > $dariDetail ? $doc_date :$detail_revision->value;
        }
        return $myDate;
    }
    public function addTime($arf='',$po='')
    {
        $ref = $this->db->where(['doc_id'=>$arf->doc_id])->order_by('id','desc')->get('t_arf_detail_revision');
        if($ref->num_rows() > 0)
        {
          $ref = $ref->row();
          $addTime = $ref->value;
        }
        else
        {
          $addTime = $po->amended_date;
        }
        return $addTime;
    }
    public function approval_list($id='')
    {
      return $this->db->select('t_approval_arf_recom.*,m_user_roles.DESCRIPTION role_name,m_user.NAME user_name')
        ->join('m_user_roles','m_user_roles.ID_USER_ROLES = t_approval_arf_recom.id_user_role','left')
        ->join('m_user','m_user.ID_USER = t_approval_arf_recom.id_user','left')
        ->where(['id_ref'=>$id, 'sequence < '=> 7])->order_by('sequence','asc')->get('t_approval_arf_recom');
    }
    public function arf_recom_issued($value='')
    {
        $data['title'] = 'Amendment Issuance';
        $data['menu'] = $this->menu;
        $data['lists'] = $this->T_approval_arf_recom->time_issued();
        $this->template->display('procurement/V_arf_recom_approval', $data);
    }
    public function reject_list()
    {
        $data['menu'] = $this->menu;
        $reject_list = $this->T_approval_arf_recom->reject_list();

        /*if($reject_list)
        {
            if($reject_list->num_rows() > 0)
            {
                $data['lists'] = $reject_list;
            }
        }*/
        $data['title'] = 'Arf Recommendation Reject List';
        $data['lists'] = $reject_list;
        $data['create'] = true;
        $this->template->display('procurement/V_arf_recom_approval', $data);
    }
    public function approval_update($doc_no='', $arf_response_id='')
    {
        $t_approval_arf_recom = $this->db->where(['id_ref'=>$arf_response_id])->get('t_approval_arf_recom');
        if($t_approval_arf_recom->num_rows() > 0)
        {
            $this->db->where(['id_ref'=>$arf_response_id]);
            $this->db->where_not_in('sequence',[1]);
            $this->db->update('t_approval_arf_recom',['status'=>0]);
        }
    }
}