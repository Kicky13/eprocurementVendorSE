<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_arf_approval extends M_base_approval {

    protected $table = 't_approval_arf';
    protected $table_detail = 't_approval_arf_detail';
    protected $module_kode = '13';

    public $vp_bsd_id = 21;
    public $bsd_staf_id = 20;
    public $bod_staf_id = array(45,46,47);
    public $scm_performance_support_id = 29;

    public function approval_rule($id, $rule) {
        switch ($rule->extra_case) {
            case 'bod_review':
                return false;
                break;
            case 'inventory_control':
                $this->load->model('m_arf_detail');
                $result = $this->m_arf_detail->scope('not_exists_on_po')
                ->where('doc_id', $id)
                ->get();
                if (count($result) == 0) {
                    return false;
                } else {
                    return true;
                }
                break;
            default:
                return true;
                break;
        }
    }

    public function on_approve($id, $approval) {
        if ($approval->id_user_role == $this->bsd_staf_id) {
            $this->load->model('m_arf');
            $arf = $this->m_arf->find($approval->id_ref);
            if ($arf->review_bod) {
                $rs_module_rule = $this->db->where('module', $this->module_kode)
                ->where_in('user_roles', $this->bod_staf_id)
                ->order_by('sequence', 'asc')
                ->get('m_approval_rule')
                ->result();
                foreach ($rs_module_rule as $r_module_rule) {
                    $exists = $this->db->where('id_ref',$approval->id_ref)
                    ->where('id_user_role', $r_module_rule->user_roles)
                    ->where('sequence', $r_module_rule->sequence)
                    ->get($this->table)
                    ->row();
                    if (!$exists) {
                        $this->db->insert($this->table, array(
                            'id_ref' => $approval->id_ref,
                            'id_user_role' => $r_module_rule->user_roles,
                            'id_user' => '%',
                            'sequence' => $r_module_rule->sequence,
                            'description' => $r_module_rule->description,
                            'reject_step' => $r_module_rule->reject_step,
                            'email_approve' => $r_module_rule->email_approve,
                            'email_reject' => $r_module_rule->email_reject,
                            'edit_content' => $r_module_rule->edit_content,
                            'status' => 0
                        ));
                    }
                }
            } else {
                $this->db->where('id_ref', $approval->id_ref)
                ->where_in('id_user_role', $this->bod_staf_id)
                ->delete($this->table);
            }
        }
    }

    public function get($id, $creator = false) {
        if (!$creator) {
            $this->db->where($this->table.'.sequence >', 1);
        }
        return $this->db->select(array(
            $this->table.'.id',
            $this->table.'.id_ref',
            $this->table.'.id_user_role',
            $this->table.'.id_user',
            $this->table.'.description',
            $this->table.'.note',
            $this->table.'.status',
            $this->table.'.approved_by',
            $this->table.'.approved_at',
            'm_user_roles.DESCRIPTION as role',
            'GROUP_CONCAT(m_user.NAME SEPARATOR \', \') as name',
            'approver.NAME as approver',
            '(
                SELECT COUNT(1) FROM m_user auth
                WHERE auth.ID_USER = \''.$this->session->userdata('ID_USER').'\'
                AND auth.ROLES LIKE CONCAT(\'%,\','.$this->table.'.id_user_role,\',%\')
                AND auth.ID_USER LIKE '.$this->table.'.id_user
            ) as auth'
        ))
        ->join('t_arf', 't_arf.id = '.$this->table.'.id_ref')
        ->join('t_purchase_order', 't_purchase_order.po_no = t_arf.po_no')
        ->join('t_msr', 't_msr.msr_no = t_purchase_order.msr_no')
        ->join('m_user_roles', 'm_user_roles.ID_USER_ROLES = '.$this->table.'.id_user_role')
        ->join('m_user', 'm_user.ROLES LIKE CONCAT(\'%,\',m_user_roles.ID_USER_ROLES,\',%\') AND m_user.ID_USER LIKE '.$this->table.'.id_user')
        ->join('m_user approver', 'approver.ID_USER = '.$this->table.'.approved_by', 'left')
        ->where($this->table.'.id_ref', $id)
        ->where($this->table.'.id_user_role <> ', $this->scm_performance_support_id)
        ->where('m_user.COMPANY LIKE CONCAT(\'%\',t_msr.id_company,\'%\')')
        ->group_by(array(
            $this->table.'.id',
            $this->table.'.id_ref',
            $this->table.'.id_user_role',
            $this->table.'.id_user',
            $this->table.'.description',
            $this->table.'.note',
            $this->table.'.status',
            $this->table.'.approved_by',
            $this->table.'.approved_at',
            'm_user_roles.DESCRIPTION',
            'approver.NAME'
        ))
        ->order_by($this->table.'.sequence', 'ASC')
        ->get($this->table)
        ->result();
    }
}