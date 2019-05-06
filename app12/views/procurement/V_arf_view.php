<?php $this->load->view('procurement/partials/script') ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title"><?= lang("View ARF", "View ARF") ?></h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/home/">Home</a></li>
                        <li class="breadcrumb-item active"><?= lang("Pengadaan", "Procurement") ?></li>
                        <li class="breadcrumb-item active"><?= lang("View ARF", "View ARF") ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row info-header">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td width="35%">Title</td>
                                <td width="1px">:</td>
                                <td><?= $po->title ?></td>
                            </tr>
                            <tr>
                                <td>Requestor</td>
                                <td>:</td>
                                <td><?= $po->requestor ?></td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>:</td>
                                <td><?= $po->department ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                     <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>Total (Excl. VAT)</td>
                                <td>:</td>
                                <td class="text-right"><?= display_multi_currency_format($arf->estimated_value, $arf->currency, $arf->estimated_value_base, $arf->currency_base) ?></td>
                            </tr>
                            <tr>
                                <td>VAT</td>
                                <td>:</td>
                                <td class="text-right"><?= display_multi_currency_format($arf->tax, $arf->currency, $arf->tax_base, $arf->currency_base) ?></td>
                            </tr>
                            <tr>
                                <td>Total (Incl. VAT)</td>
                                <td>:</td>
                                <td class="text-right"><?= display_multi_currency_format($arf->total, $arf->currency, $arf->total_base, $arf->currency_base) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div id="wizard-arf" class="wizard-circle">
                            <h6><i class="step-icon icon-info"></i> Header</h6>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2">ARF No</label>
                                    <div class="col-md-4">
                                        <?= $arf->doc_no ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">ARF Reference<br><small><?= $po->po_type ?> No</small></label>
                                    <div class="col-md-4">
                                        <?= $arf->po_no ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="col-md-5">Title of <?= $po->po_type ?> </label>
                                            <div class="col-md-7">
                                                <?= $po->title ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">Name of <?= ($po->po_type == 'PO') ? 'Vendor' : 'Contractor' ?></label>
                                            <div class="col-md-7">
                                                <?= $po->vendor ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">Company</label>
                                            <div class="col-md-7">
                                                <?= $po->company ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">Date of <?= ($po->po_type == 'PO') ? 'Vendor' : 'Contractor' ?></label>
                                            <div class="col-md-7">
                                                <?= dateToIndo($po->po_date) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h4><?= $po->po_type ?>  Value (Excl. VAT)</h4>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-md-5">Original Value<br><small class="text-primary">(excluding any amendment)</small></label>
                                            <div class="col-md-7">
                                                <?= ($arf->status == 'submitted') ? numIndo($arf->amount_po) : numIndo($po->total_amount) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">Latest Value<br><small class="text-primary">(Original value plus previous amendment)</small></label>
                                            <div class="col-md-7">
                                                <?= ($arf->status == 'submitted') ? numIndo($arf->amount_po_arf) : numIndo($po->latest_value) ?>
                                            </div>
                                        </div>
                                        <h4><?= $po->po_type ?>  Remaining Value (Excl. VAT)</h4>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-md-5">Spending to Date<br><small class="text-primary">(comitted value incl.unpaid invoices)</small></label>
                                            <div class="col-md-7">
                                                <?= ($arf->status == 'submitted') ? numIndo($arf->amount_spending) : numIndo($po->spending_value) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">Remaining Value<br><small class="text-primary">(as of now)</small></label>
                                            <div class="col-md-7">
                                                <?= ($arf->status == 'submitted') ? numIndo($arf->amount_remaining) : numIndo($po->remaining_value) ?>
                                            </div>
                                        </div>
                                        <h4><?= ($po->po_type = 'PO') ? 'PO Delivery Date (take the longest if partial)' : 'SO/Contract (CO) Period' ?></h4>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-md-5">Original Date(s)<br><small class="text-primary">(as per orignal)</small></label>
                                            <div class="col-md-7">
                                                <?= ($arf->status == 'submitted') ? dateToIndo($arf->delivery_date_po) : dateToIndo($po->delivery_date)  ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-5">Amended Date<br><small class="text-primary">(as amended by previous amendment)</small></label>
                                            <div class="col-md-7">
                                                <?= ($arf->status == 'submitted') ? dateToIndo($arf->amended_date) : dateToIndo($po->prev_date) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h6><i class="step-icon icon-list"></i> Detail</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-5">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Type/Description<br><small>(thick one when applicable)</small></th>
                                                    <th style="vertical-align: top !important;">Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="1px">
                                                        <?php if (isset($arf->revision['value'])) { ?>
                                                            <i class="fa fa-check-square text-success"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-square-o"></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td width="50px">Value</td>
                                                    <td width="150px">
                                                        <?php if (isset($arf->revision['value'])) { ?>
                                                            <?= $arf->currency ?> <?= numIndo(@$arf->revision['value']->value) ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= @$arf->revision['value']->remark ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="1px">
                                                        <?php if (isset($arf->revision['time'])) { ?>
                                                            <i class="fa fa-check-square text-success"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-square-o"></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td width="50px">Time</td>
                                                    <td width="150px"><?= dateToIndo(@$arf->revision['time']->value) ?></td>
                                                    <td><?= @$arf->revision['time']->remark ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="1px">
                                                        <?php if (isset($arf->revision['scope'])) { ?>
                                                            <i class="fa fa-check-square text-success"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-square-o"></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td width="50px">Scope</td>
                                                    <td width="150px"><?= @$arf->revision['scope']->value ?></td>
                                                    <td><?= @$arf->revision['scope']->remark ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="1px">
                                                        <?php if (isset($arf->revision['other'])) { ?>
                                                            <i class="fa fa-check-square text-success"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-square-o"></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td width="50px">Other</td>
                                                    <td width="150px"><?= @$arf->revision['other']->value ?></td>
                                                    <td><?= @$arf->revision['other']->remark ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-7">
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <thead>
                                                <tr>
                                                    <th>Additional Explanation</th>
                                                </tr>
                                                <tr>
                                                    <td>The justification for this Amendment has met the criteria below, as stipulated in the applicable procedure (can be more then on)</td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div style="max-height: 200px; overflow-y: auto;">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <?php foreach ($this->m_procurement->get_reason('arf') as $reason) { ?>
                                                            <tr>
                                                                <td width="1px">
                                                                    <?php if (isset($arf->reason[$reason->id])) { ?>
                                                                        <i class="fa fa-check-square text-success"></i>
                                                                    <?php } else { ?>
                                                                        <i class="fa fa-square-o"></i>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?= $reason->description ?>
                                                                    <?php if ($reason->addendum_required) { ?>
                                                                        <br><small><?= @$arf->reason[$reason->id]->description ?></small>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($arf->revision['value'])) { ?>
                                    <div id="po-detail">
                                        <h4>Original</h4>
                                        <div class="table-responsive mb-1">
                                            <table width="100%" id="po_item-table" class="table table-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th>Item Type</th>
                                                        <th>Description of Unit</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-center">UoM</th>
                                                        <th class="text-center">Item Modification</th>
                                                        <th>Inv Type</th>
                                                        <th>Cost Center</th>
                                                        <th>Account Subsidiary</th>
                                                        <th class="text-right">Unit Price</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($po->item as $item) { ?>
                                                        <tr>
                                                            <td><?= $item->item_type ?></td>
                                                            <td><?= $item->material_desc ?></td>
                                                            <td class="text-center"><?= $item->qty ?></td>
                                                            <td class="text-center"><?= $item->uom ?></td>
                                                            <td class="text-center"><?= ($item->item_modification) ? 'Yes' : 'No' ?></td>
                                                            <td><?= $item->inventory_type ?></td>
                                                            <td><?= $item->costcenter ?></td>
                                                            <td><?= $item->id_account_subsidiary ?> - <?= $item->account_subsidiary ?></td>
                                                            <td class="text-right"><?= numIndo($item->unit_price) ?></td>
                                                            <td class="text-right"><?= numIndo($item->total_price) ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group row">
                                            <label class="offset-md-6 col-md-3">Total</label>
                                            <div class="col-md-3 text-right">
                                                <?php if ($arf->status == 'submitted') { ?>
                                                    <?= numIndo($arf->amount_po) ?>
                                                <?php } else { ?>
                                                    <?= numIndo($po->total_amount) ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>Amendment</h4>
                                            </div>
                                        </div><br>
                                        <div class="table-responsive mb-1">
                                            <table id="arf_item-table" class="table table-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th>Item Type</th>
                                                        <th>Description of Unit</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-center">UoM</th>
                                                        <th class="text-center">Item Modification</th>
                                                        <th>Inv Type</th>
                                                        <th>Cost Center</th>
                                                        <th>Account Subsidiary</th>
                                                        <th class="text-right">Unit Price</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($arf->item as $item) { ?>
                                                        <tr>
                                                            <td><?= $item->item_type ?></td>
                                                            <td><?= $item->material_desc ?></td>
                                                            <td class="text-center"><?= $item->qty ?></td>
                                                            <td class="text-center"><?= $item->uom ?></td>
                                                            <td class="text-center"><?= ($item->item_modification) ? 'Yes' : 'No' ?></td>
                                                            <td><?= $item->inventory_type ?></td>
                                                            <td><?= $item->costcenter ?></td>
                                                            <td><?= $item->id_account_subsidiary ?> - <?= $item->account_subsidiary ?></td>
                                                            <td class="text-right"><?= numIndo($item->unit_price) ?></td>
                                                            <td class="text-right"><?= numIndo(($item->unit_price * $item->qty)) ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group row">
                                            <label class="offset-md-6 col-md-3">Total</label>
                                            <div class="col-md-3 text-right">
                                                <?= numIndo($arf->estimated_value) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="offset-md-6 col-md-3">Total Summary</label>
                                            <div class="col-md-3 text-right">
                                                <?php if ($arf->status == 'submitted') { ?>
                                                    <?= numIndo($arf->estimated_new_value) ?>
                                                <?php } else { ?>
                                                    <?= numIndo(($po->total_amount + $arf->estimated_value)) ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </fieldset>
                            <h6><i class="step-icon icon-calculator"></i> Budget</h6>
                            <fieldset >
                                <div class="mb-1">
                                    <?= numIndo(1) ?> <?= base_currency_code() ?> = <?= numIndo(exchange_rate_by_id(base_currency(), $arf->currency_id, 1)) ?> <?= $arf->currency ?>
                                </div>
                                <div class="table-responsive">
                                    <table id="budget_item-table" class="table table-no-wrap">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Cost Center</th>
                                                <th rowspan="2">Account Subsidiary</th>
                                                <th rowspan="2" class="text-center">Currency</th>
                                                <th rowspan="2" class="text-center">Booking Amount</th>
                                                <th colspan="3" class="text-center">Available Budget</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Cost Center Value</th>
                                                <th class="text-center">Acc.Subsidiary Value</th>
                                                <th class="text-center">Status Budget</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($budget as $row) { ?>
                                                <tr>
                                                    <td><?= $row->id_costcenter ?> - <?= $row->costcenter ?></td>
                                                    <td><?= $row->id_account_subsidiary ?> - <?= $row->account_subsidiary ?></td>
                                                    <td class="text-center"><?= $row->currency ?></td>
                                                    <td class="text-center"><?= numIndo($row->booking_amount) ?></td>
                                                    <td class="text-center"><?= numIndo($row->costcenter_value) ?></td>
                                                    <td class="text-center"><?= numIndo($row->account_subsidiary_value) ?></td>
                                                    <td class="text-center">
                                                        <?php if ((strpos($this->session->userdata('ROLES'), ','.$this->m_arf_approval->bsd_staf_id.',') !== false ||  strpos($this->session->userdata('ROLES'), ','.$this->m_arf_approval->vp_bsd_id.',') !== false) && $allowed_approve) { ?>
                                                            <?= $this->form->select('budget['.$row->id.']', array('' => 'Not Determined Yet')+$this->m_arf_budget->enum('status'), $row->status, 'class="form-control input-sm"') ?>
                                                        <?php } else { ?>
                                                            <?php if ($row->status == 'insufficient') { ?>
                                                                <span class="badge badge-danger">Insufficient</span>
                                                            <?php } elseif ($row->status == 'sufficient') { ?>
                                                                <span class="badge badge-success">Sufficient</span>
                                                            <?php } else { ?>

                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <table class="table">
                                    <tr>
                                        <td width="1px" style="padding-left: 0px !important;">
                                            <?php if (strpos($this->session->userdata('ROLES'), ','.$this->m_arf_approval->bsd_staf_id.',') === FALSE || !$allowed_approve) { ?>
                                                <?= $this->form->checkbox('review_bod', 1, $arf->review_bod, 'id="review_bod" disabled') ?>
                                            <?php } else { ?>
                                                <?= $this->form->checkbox('review_bod', 1, $arf->review_bod, 'id="review_bod"') ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            BOD Approval for this Amendment Request is required<br>
                                            <small>BOD to give check mark on this box if the amendment Request is coming from the <span class="label-po_type">PO</span> with Original Value or Latest value or Latest Value plus estimated additional value of than USD 100.000</small>
                                        </td>
                                </table>
                            </fieldset>
                            <h6><i class="step-icon icon-paper-clip"></i> Attachment</h6>
                            <fieldset>
                                <table id="attachment-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Filename</th>
                                            <th>Uploaded Date</th>
                                            <th>Uploaded By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($arf->attachment as $attachment) { ?>
                                            <tr>
                                                <td><?= $attachment->type ?></td>
                                                <td><a href="<?= base_url($document_path.'/'.$attachment->file) ?>"><?= $attachment->file_name ?></a></td>
                                                <td><?= dateToIndo($attachment->created_at, false, true) ?></td>
                                                <td><?= $attachment->creator ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                            <?php if ($allowed_approve) { ?>
                                <?php $this->load->view('procurement/partials/arf_approval') ?>
                            <?php } else { ?>
                                <?php $this->load->view('procurement/partials/arf_approval_history') ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-right">
                <?php if ($allowed_approve && $allowed_approve->id_user_role == $this->m_arf_approval->scm_performance_support_id) { ?>
                    <button type="button" class="btn btn-success" onclick="approve('<?= $allowed_approve->id ?>')">Approve</button>
                <?php } ?>
                <?php if ($notif_flag[0] == 1) { ?>
                    <button class="btn btn-success" onclick="notification()">Prepare Notification</button>
                <?php } else if ($arf->arf_status == 'completed') { ?>
                    <?php if (strpos($this->session->userdata('ROLES'), ','.$procurement_head_id.',') !== FALSE) { ?>
                        <?php if (!$this->m_arf_assignment->where('doc_id', $arf->id)->first()) { ?>
                            <button type="button" class="btn btn-success" onclick="assignment()">Assignment</button>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="assignment-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <?php foreach ($this->m_arf_assignment->get_user_assigned() as $user_assigned) { ?>
                        <tr>
                            <td width="1px"><?= $this->form->radio('user_id', $user_assigned->user_id, ($user_assigned->user_id == $po->id_procurement_specialist) ? true : false) ?></td>
                            <td><?= $user_assigned->username ?> - <?= $user_assigned->name ?></td>
                            <td class="text-center"><span class="badge badge-primary"><?= $user_assigned->num_of_assigned ?></span></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="assign()">Assign</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#wizard-arf").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '#title#',
            enableFinishButton: false,
            enablePagination: false,
            enableAllSteps: true,
            enableFinishButton: false
        });
    });

    function assignment() {
        $('#assignment-modal').modal('show');
    }

    function assign() {
        swalConfirm('ARF Assignment', '<?= __('confirm_submit') ?>', function(){
            $.ajax({
                url : '<?= base_url('procurement/arf/assign/'.$arf->id) ?>',
                type : 'post',
                data : {
                    user_id : $('[name="user_id"]:checked').val(),
                },
                dataType : 'json',
                success : function(response) {
                    if (response.success) {
                        window.location.href = '<?=  base_url('home') ?>';
                    } else {
                        swal('<?= __('warning') ?>',response.message,'warning')
                    }
                }
            });
        })
        /*pnotifyConfirm('Are you sure want to preceed?', function() {
            $.ajax({
                url : '<?= base_url('procurement/arf/assign/'.$arf->id) ?>',
                type : 'post',
                data : {
                    user_id : $('[name="user_id"]:checked').val(),
                },
                dataType : 'json',
                success : function(response) {
                    if (response.success) {
                        pnotifyAlert('Success', response.message, 'success', function() {
                            document.location.href = '<?=  base_url('procurement/arf/assignment') ?>';
                        });
                    } else {
                        swal_notify('Ooops!', response.message, 'warning');
                    }
                }
            });
        });*/
        /*var conf = confirm('Are you sure to assign ARF no : <?= $arf->doc_no ?>');
        if (conf) {

        } else {
            return false;
        }*/
    };

    <?php if ($notif_flag[0] == 1) { ?>
        function notification() {
            document.location.href = '<?= base_url('procurement/arf_notif_preparation/create_main/' . $notif_flag[1]) ?>';
        }
    <?php } ?>
</script>