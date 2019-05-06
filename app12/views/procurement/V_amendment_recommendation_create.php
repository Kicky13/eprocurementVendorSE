<?php $this->load->view('procurement/partials/script') ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title"><?= lang("Amendment Recommendation Preparation", "Amendment Recommendation Preparation") ?></h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/home/">Home</a></li>
                        <li class="breadcrumb-item active"><?= lang("Pengadaan", "Procurement") ?></li>
                        <li class="breadcrumb-item active"><?= lang("Amendment Recommendation Preparation", "Amendment Recommendation Preparation") ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row info-header">
                <div class="col-md-4">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td width="35%">Title</td>
                                <td width="1px">:</td>
                                <td><?= $arf->title ?></td>
                            </tr>
                            <tr>
                                <td>Supplier</td>
                                <td>:</td>
                                <td><?= $arf->vendor ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                     <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>Company</td>
                                <td>:</td>
                                <td><?= $arf->company ?></td>
                            </tr>
                            <tr>
                                <td>Amendment Value</td>
                                <td>:</td>
                                <td><?= numIndo($arf->estimated_value) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                     <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>Agreement Number</td>
                                <td>:</td>
                                <td><?= $arf->po_no ?></td>
                            </tr>
                            <tr>
                                <td>Amendment Number</td>
                                <td>:</td>
                                <td><?= substr($arf->doc_no, -5) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard card-scroll">
                        <form id="wizard-arf" class="wizard-circle">
                          <input type="hidden" name="arf_response_id" value="<?= $arf->id ?>">
                          <input type="hidden" name="doc_no" value="<?= $arf->doc_no ?>">
                          <input type="hidden" name="po_no" value="<?= $arf->po_no ?>">
                            <?php if(isset($issued)): ?>
                            <?php else:?>
                            <h6><i class="step-icon icon-info"></i> Amendment Request</h6>
                            <fieldset>
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">Type/Description<br><small>(thick one when applicable)</small></th>
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
                                            <td>Value</td>
                                            <td>
                                                <?php if (isset($arf->revision['value'])) { ?>
                                                    <?= $arf->currency ?> <span id="arf_request_value"></span>
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
                                            <td>Time</td>
                                            <td><?= dateToIndo(@$arf->revision['time']->value) ?></td>
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
                                            <td>Scope</td>
                                            <td><?= @$arf->revision['scope']->value ?></td>
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
                                            <td><?= @$arf->revision['other']->value ?></td>
                                            <td><?= @$arf->revision['other']->remark ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4><b>Amendment Process</b></h4>
                                <div class="form-group row">
                                    <label class="col-md-3">ARF Received</label>
                                    <div class="col-md-3">
                                        <?= dateToIndo($arf->assignment_date, false, true) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Amendment Notification Issued</label>
                                    <div class="col-md-3">
                                        <?= dateToIndo($arf->notification_date, false, true) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Contractor Response Received</label>
                                    <div class="col-md-3">
                                        <?= dateToIndo($arf->responsed_at, false, true) ?>
                                    </div>
                                </div>
                            </fieldset>
                            <?php endif;?>
                            <h6><i class="step-icon fa fa-calendar"></i> Schedule of Price</h6>
                            <fieldset>
                                <div id="po-detail">
                                    <h4>Original</h4>
                                    <table width="100%" id="po_item-table" class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Item Type</th>
                                                <th>Description</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">UoM</th>
                                                <th class="text-center">Item Modif</th>
                                                <th class="text-center">Inventory Type</th>
                                                <th class="text-center">Cost Center</th>
                                                <th class="text-center">Acc Sub</th>
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
                                                    <td class="text-center"><?= ($item->item_modification) ? '<i class="fa fa-check-square text-success"></i>' : '<i class=" fa fa-times text-danger"></i>' ?></td>
                                                    <td class="text-center"><?= $item->inventory_type ?></td>
                                                    <td class="text-center"><?= $item->id_costcenter ?> - <?= $item->costcenter ?></td>
                                                    <td class="text-center"><?= $item->id_account_subsidiary ?> - <?= $item->account_subsidiary ?></td>
                                                    <td class="text-right"><?= numIndo($item->unit_price) ?></td>
                                                    <td class="text-right"><?= numIndo($item->total_price) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="form-group row">
                                        <label class="offset-md-6 col-md-3">Total</label>
                                        <div class="col-md-3 text-right">
                                            <?= numIndo($arf->amount_po) ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Amendment</h4>
                                        </div>
                                    </div><br>
                                    <div class="table-responsive">
                                        <table id="arf_item-table" class="table table-bordered table-sm" style="font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    <th>Item Type</th>
                                                    <th>Description</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">UoM</th>
                                                    <th class="text-center">Item Modif</th>
                                                    <th class="text-center">Inventory Type</th>
                                                    <th class="text-center">Cost Center</th>
                                                    <th class="text-center">Acc Sub</th>
                                                    <th class="text-right">Unit Price</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total = 0;
                                                    foreach ($arf->item as $item) {
                                                        $qty = $item->qty2 > 0 ? $item->qty1*$item->qty2 : $item->qty1;
                                                        $response_qty = $item->response_qty1 > 0 ? $item->response_qty1*$item->response_qty2 : $item->response_qty1;
                                                        $uom = $item->uom2 ? $item->uom1.'/'.$item->uom2 : $item->uom1;
                                                        $price = $item->new_price > 0 ? $item->new_price : $item->response_unit_price;
                                                        $subTotalPrice = $price*$qty;      
                                                        $total += $subTotalPrice;
                                                ?>
                                                    <tr id="arf_item-row-<?= $item->item_semic_no_value ?>" data-row-id="<?= $item->item_semic_no_value ?>">
                                                        <td><?= $item->item_type ?></td>
                                                        <td><?= $item->item ?></td>
                                                        <td class="text-center"><?= $qty ?></td>
                                                        <td class="text-center"><?= $uom ?></td>
                                                        <td class="text-center"><?= ($item->item_modification) ? '<i class="fa fa-check-square text-success"></i>' : '<i class=" fa fa-times text-danger"></i>' ?></td>
                                                        <td class="text-center"><?= $item->inventory_type ?></td>
                                                        <td class="text-center"><?= $item->id_costcenter ?> - <?= $item->costcenter_desc ?></td>
                                                        <td class="text-center"><?= $item->id_accsub ?> - <?= $item->accsub_desc ?></td>
                                                        <td class="text-right"><?= numIndo($price) ?></td>
                                                        <td class="text-right">
                                                            <?= numIndo($subTotalPrice) ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group row">
                                        <label class="offset-md-6 col-md-3">Total</label>
                                        <div class="col-md-3 text-right">
                                            <?= numIndo($total) ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="offset-md-6 col-md-3">Total Summary</label>
                                        <div class="col-md-3 text-right">
                                            <?= numIndo($arf->amount_po + $total ) ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <?php if(isset($issued)): ?>
                            <?php else:?>
                            <h6><i class="step-icon fa fa-exclamation"></i> Amendment Notification Response</h6>
                            <fieldset>
                                <h4>Amendment Notification Response</h4>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <input disabled="" type="radio" name="confirm" value="1" <?= $arf->confirm == 1 ? "checked": "" ?> >
                                        <label style="bottom: 8px;position: relative;margin-left: 10px;">Confirm</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input disabled="" type="radio" name="confirm" value="2" <?= $arf->confirm == 2 ? "checked": "" ?> >
                                        <label style="bottom: 8px;position: relative;margin-left: 10px;">Confirm With Note</label>
                                    </div>
                                    <div class="col-md-6">
                                        <b style="margin-left: 25px;font-weight: bold;">Comments</b>
                                        <textarea disabled="" class="form-control" style="margin-left: 25px;"><?= $arf->note ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input disabled="" type="radio" name="confirm" value="3" <?= $arf->confirm == 3 ? "checked": "" ?> >
                                        <label style="bottom: 8px;position: relative;margin-left: 10px;">Quotation refer to schedule of price and attachment</label>
                                    </div>
                                </div>

                                <h4>Attachment</h4>
                                <hr>
                                <table id="attachment-table" class="table" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>File</th>
                                            <th>Upload At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($arf->response_attachment as $attachment) { ?>
                                            <tr>
                                                <td><?= $attachment->type ?></td>
                                                <td><a href="<?= base_url($document_path.'/'.$attachment->file) ?>"><?= $attachment->file ?></a></td>
                                                <td><?= dateToIndo($attachment->created_at, false, true) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                            <?php endif;?>
                            
                            <h6><i class="step-icon fa fa-thumbs-up"></i> <?= isset($issued) ? ' Amendment Data' : 'Amendment Recommendation' ?></h6>
                            <fieldset>
                                <?php if(isset($issued)): ?>
                                <?php else:?>
                                <div class="row amendment_recommendation_tab">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Analysis <small style="font-style: italic">(Technical justification and commercial impact for recommending the Amendment)</small></label>
                                            <?= $this->form->textarea('analysis', @$recom->analysis, 'class="form-control"') ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Negotiation</label><br>
                                            <?= $this->form->radio('nego', 0) ?> No
                                            <?= $this->form->radio('nego', 1) ?> Yes
                                        </div>
                                        <div class="form-group">
                                            <?= $this->form->textarea('nego_str', @$recom->nego_str, 'class="form-control" style="height:170px;"') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row amendment_recommendation_tab">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Budget Analysis</label>
                                            <?= $this->form->textarea('budget_analysis', @$recom->budget_analysis, 'class="form-control"') ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="row amendment_recommendation_tab">
                                    <div class="col-md-12" style="font-weight: bold;margin-bottom: 10px">
                                        Agreement Data including this Amendment
                                    </div>
                                </div>
                                <div class="form-group row amendment_recommendation_tab">
                                    <label class="col-md-3">Original Agreement Value</label>
                                    <div class="col-md-3">
                                        <input class="form-control" disabled value="<?=numIndo($arf->amount_po)?>">
                                    </div>
                                    <label class="col-md-3">Additional Value</label>
                                    <div class="col-md-3">
                                        <input class="form-control" disabled value="<?=numIndo($total)?>">
                                    </div>
                                </div>
                                <div class="form-group row amendment_recommendation_tab">
                                    <label class="col-md-3">Latest Agreement Value</label>
                                    <div class="col-md-3">
                                        <input class="form-control" disabled value="<?=numIndo($arf->amount_po_arf)?>">
                                    </div>
                                    <label class="col-md-3">New Agreement Value</label>
                                    <div class="col-md-3">
                                        <input class="form-control" disabled value="<?=numIndo($total+$arf->amount_po_arf)?>">
                                    </div>
                                </div>
                                <div class="form-group row amendment_recommendation_tab" style="margin-top:20px">
                                    <div class="col-md-6">
                                        BOD Approval for this Value Amendment Request is required
                                        <br>
                                        <input type="radio" name="bod_approval" value="0">
                                        <label style="bottom: 10px;position: relative;margin-right: 20px;">No</label>
                                        <input type="radio" name="bod_approval" value="1" checked="">
                                        <label style="bottom: 10px;position: relative;">Yes, BOD Review Required</label>
                                    </div>
                                    <div class="col-md-6">
                                        Accumulative Amendment
                                        <br>
                                        <input type="radio" name="aa" value="0">
                                        <label style="bottom: 10px;position: relative;margin-right: 20px;">No</label>
                                        <input type="radio" name="aa" value="1" checked="">
                                        <label style="bottom: 10px;position: relative;">Yes, requires 1 level up for the Amendment signature as per AAS</label>
                                    </div>
                                </div>
                                <div class="form-group row amendment_recommendation_tab">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Original Agreement Period
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" disabled value="<?=dateToIndo($po->po_date,false,false)?>">
                                            </div>
                                            <div class="col-md-1 text-center">
                                                to
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" disabled value="<?=dateToIndo($po->delivery_date,false,false)?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Additional Time
                                            </div>
                                            <div class="col-md-3" style="font-weight: bold">
                                                Up to
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" disabled value="<?=dateToIndo($addTime,false,false)?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row amendment_recommendation_tab">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Latest Agreement Period
                                                <!--
                                                po_date
                                                 -->
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" disabled value="<?=dateToIndo($po->po_date,false,false)?>">
                                            </div>
                                            <div class="col-md-1 text-center">
                                                to
                                            </div>
                                            <div class="col-md-3">
                                                <!--
                                                    kondisi ammendment
                                                    max date di t_arf_detail_revision kolom tipe per doc_id
                                                 -->
                                                <input class="form-control" disabled value="<?=dateToIndo($arf->amended_date,false,false)?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                New Agreement Period
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" disabled value="<?=dateToIndo($po->po_date,false,false)?>">
                                            </div>
                                            <div class="col-md-1 text-center">
                                                to
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" disabled value="<?=dateToIndo($newAgreementPeriodTo,false,false)?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="font-weight: bold;margin-bottom: 10px">
                                        Additional Documents
                                    </div>
                                </div>
                                <div class="form-group row amendment_recommendation_tab">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">Original Expiry Date</div>
                                            <div class="col-md-4">Latest Expiry Date</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Performance Bond</div>
                                            <div class="col-md-4"><input class="form-control" disabled ></div>
                                            <div class="col-md-4"><input class="form-control" disabled value="<?=$new_date_1?>" ></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Insurance</div>
                                            <div class="col-md-4"><input class="form-control" disabled ></div>
                                            <div class="col-md-4"><input class="form-control" disabled value="<?=$new_date_2?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-2">Extend</div>
                                            <div class="col-md-5">New Date</div>
                                            <div class="col-md-5">Remarks</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2"><input type="checkbox" name="extend1" id="extend1" value="1"></div>
                                            <div class="col-md-5"><input class="form-control" disabled="" name="new_date_1" id="new_date_1" ></div>
                                            <div class="col-md-5"><input class="form-control" disabled="" name="remarks_1" id="remarks_1" ></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2"><input type="checkbox" name="extend2" id="extend2" value="1"></div>
                                            <div class="col-md-5"><input class="form-control" disabled="" name="new_date_2" id="new_date_2" ></div>
                                            <div class="col-md-5"><input class="form-control" disabled="" name="remarks_2" id="remarks_2" ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="font-weight: bold;margin-bottom: 10px">
                                        Recommendation
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        Based on the above overall analysis, Team is recommending continuing the amendment process by signing the Amendment <b>#6</b> of this Agreement.
                                    </div>
                                </div>
                            </fieldset>
                            <h6><i class="step-icon fa fa-paperclip"></i> Amendment Document</h6>
                            <fieldset>
                                <div class="row">
                                  <div class="col-md-12" style="margin-bottom: 10px">
                                    <a href="#" class="btn btn-success btn-sm pull-right btn-upload" data-toggle="modal" data-target="#myModal">Upload</a>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="table-responsive">
                                      <table class="table table-condensed">
                                        <thead>
                                          <tr>
                                            <th>TYPE</th>
                                            <th>FILE NAME</th>
                                            <th>UPLOAD AT</th>
                                            <th>UPLOADER</th>
                                            <th>ACTION</th>
                                          </tr>
                                        </thead>
                                        <tbody id="devbled-attachment">
                                          <?php foreach ($doc as $key => $value) {
                                            if(isset($issued))
                                            {
                                                $docType = biduploadtype($value->tipe, true);
                                            }
                                            else
                                            {
                                                $docType = 'Amendment Signed';
                                            }
                                            echo "<tr>
                                              <td>$docType</td>
                                              <td>".$value->file_path."</td>
                                              <td>".dateToIndo($value->created_at, false, true)."</td>
                                              <td>".user($value->created_by)->NAME."</td>
                                              <td>
                                                <a href='".base_url('upload/ARFRECOMPREP/'.$value->file_path)."' target='_blank' class='btn btn-sm btn-primary'>Download</a>
                                                <a href='#' class='btn btn-sm btn-danger btn-hapus-file' onclick='hapusFile($value->id)'>Hapus</a>
                                              </td>
                                            </tr>";
                                          }?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                            </fieldset>
                            <?php if(isset($issued)): ?>
                            <?php else:?>
                            <?php if(!$view or $approval_view): ?>
                            <h6><i class="step-icon fa fa-thumbs-up"></i> Approval</h6>
                            <fieldset>
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Role Akses</th>
                                      <th>User</th>
                                      <th>Approval Status</th>
                                      <th>Transaction Date</th>
                                      <th>Comments</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($approval_list->result() as $al) {
                                      $status = '';
                                      $transactionDate = '';
                                      if($al->sequence > 1)
                                      {
                                        if($al->status > 0)
                                          {
                                            $status = $al->status == 1 ? "Approve":"Reject";
                                            $transactionDate = dateToIndo($al->approved_at, false, false);
                                          }
                                          $approve_link = '';
                                          if($al->id_user == $this->session->userdata('ID_USER') and $al->status == 0)
                                          {
                                            $approve_link = "<a id='btn-approval-$al->id' onclick='approveClick($al->id)' href='#' class='btn btn-sm btn-primary'>Approve</a>";
                                          }
                                          if(@$is_reject)
                                          {
                                            $approve_link = '';
                                          }
                                          echo "<tr>
                                          <td>$al->role_name</td>
                                          <td>$al->user_name</td>
                                          <td id='status-$al->id'>$status</td>
                                          <td id='transaction-date-$al->id'>$transactionDate</td>
                                          <td id='note-$al->id'>$al->note</td>
                                          <td>
                                            $approve_link
                                          </td>
                                          </tr>";
                                      }
                                    }?>
                                  </tbody>
                                </table>
                              </div>
                            </fieldset>
                            <?php endif;?>
                            <?php endif;?>
                        </form>
                    </div>
                    <div class="card-footer">
                      <?php if(!$view): ?>
                        <button class="btn btn-primary" onclick="beforeSubmitConfirmation()">Submit</button>
                      <?php endif;?>
                      <?php if(isset($issued)): ?>
                        <button class="btn btn-primary" onclick="beforeIssued()">Issued</button>
                      <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Upload</h4>
      </div>
      <div class="modal-body">
        <form id="form-attachment-arf-recom-prep" method="post" class="form-horizontal" enctype="multipart/form-data">
          <!-- data_id -->
          <input type="hidden" name="module_kode" value="<?= isset($issued) ? 'arf-issued' : 'arf-recom-prep' ?>">
          <input type="hidden" name="data_id" value="<?=$arf->doc_no?>">
          <!-- m_approval_id -->
          <div class="form-group">
            <label>Type</label>
            <div class="col-sm-12">
              <select class="form-control" name="tipe" id="tipe">
                <?php 
                if(isset($issued))
                {
                    echo "<option value='1'>Amendment Signed</option>";
                }
                else
                {
                    foreach (arfRecomPrepType() as $key => $value) {
                      echo "<option value='$key'>$value</option>";
                    }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>File</label>
            <div class="col-sm-12">
              <input type="file" class="form-control" name="file_path" id="file_path" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" onclick="attachmentClick()" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Submit Confirmation</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-sm-12">
            Are you sure to Submit Amendment Recommendation?
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="submitConfirmation()" class="btn btn-primary">Yes, Continue</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-issued" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Amendment Issued</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-sm-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="issuedConfirmation()" class="btn btn-primary">Yes, Continue</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Approval</h4>
      </div>
      <div class="modal-body">
        <form id="frm-approval">
          <input type="hidden" name="approval_id" id="approval_id">
          <div class="form-group row">
            <label class="col-md-3">Status</label>
            <div class="col-md-9">
              <select class="form-control" name="status" id="status">
                <option value="1">Approve</option>
                <option value="2">Reject</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Comments</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="3" name="note" id="note"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="approveRejectclick()" class="btn btn-primary">Yes, Continue</button>
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
        $('#new_date_1,#new_date_2').datepicker({
            dateFormat : 'yy-mm-dd'
        });
        $("#extend1").on('click',function(){
          var rs = $("#extend1:checked").val()
          if(rs)
          {
            $("#new_date_1,#remarks_1").removeAttr("disabled")
          }
          else
          {
            $("#new_date_1,#remarks_1").attr("disabled","disabled")
          }
        });
        $("#extend2").on('click',function(){
          var rs = $("#extend2:checked").val()
          if(rs)
          {
            $("#new_date_2,#remarks_2").removeAttr("disabled")
          }
          else
          {
            $("#new_date_2,#remarks_2").attr("disabled","disabled")
          }
        });
    });
  function attachmentClick() {
    var form = $("#form-attachment-arf-recom-prep")[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "<?=base_url('procurement/amendment_recommendation/attachment_upload')?>",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        beforeSend:function(){
          start($('#myModal'));
        },
        success: function (data) {
          $("#devbled-attachment").html(data);
          stop($('#myModal'));
          $("#myModal").modal('hide');
          $("#file_path").val('');
          $("#file_name").val('');
        },
        error: function (e) {
          swal('Ooopss', 'Fail, Try Again', 'warning');
          stop($('#myModal'));
          $("#myModal").modal('hide');
        }
    });
  }
  function hapusFile(argument) {
    swalConfirm('Amendment Recommendation', 'Are you sure to delete this data ?', function() {
      $.ajax({
        url:'<?=base_url('procurement/amendment_recommendation/hapus_attachment')?>/'+argument,
        beforeSend:function(){
          start($('#icon-tabs'));
        },
        success: function (data) {
          $("#devbled-attachment").html(data);
          stop($('#icon-tabs'));
        },
        error: function (e) {
          swal('Ooopss', 'Fail, Try Again', 'warning');
          stop($('#icon-tabs'));
        }
      });
    })
  }
  function beforeSubmitConfirmation() {
    $("#modal-submit").modal('show')
  }
  function beforeIssued() {
    $("#modal-issued").modal('show')
  }
  function submitConfirmation() {
    var form = $("#wizard-arf")[0];
    var data = new FormData(form);
    /*var performance_bond_value = $("#performance_bond_value").val();
    var performance_bond_expiry_date = $("#performance_bond_expiry_date").val();
    var insurance_expiry_date = $("#insurance_expiry_date").val();

    if(performance_bond_value && performance_bond_expiry_date && insurance_expiry_date)
    {*/
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?=base_url('procurement/amendment_recommendation/store')?>",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            beforeSend:function(){
              start($('#wizard-arf'));
            },
            success: function (data) {
              var e = eval("("+data+")");
              if(e.status)
              {
                /*stop($('#wizard-arf'));
                $("#modal-submit").modal('hide');
                swal('Done',e.msg, 'success');
                window.open("<?= base_url('home') ?>","_self")*/
                setTimeout(function(){ swal('Done',e.msg, 'success'); stop($('#wizard-arf')); window.location.href = '<?=  base_url('home') ?>'; }, 3000);
              }
              else
              {
                /*swal('Ooopss','Fail, Try Again', 'warning');
                stop($('#icon-tabs'));
                $("#modal-submit").modal('hide');*/
                setTimeout(function(){ swal('Ooopss','Fail, Try Again', 'warning'); stop($('#wizard-arf')); }, 3000);
              }
            },
            error: function (e) {

              swal('Ooopss','Fail, Try Again', 'warning');
              stop($('#icon-tabs'));
              $("#modal-submit").modal('hide');
            }
        });
    /*}
    else
    {
        swal('Ooopss',"Form Must Be filled", 'warning');
    }*/
  }
  function issuedConfirmation() {
    var form = $("#wizard-arf")[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "<?=base_url('procurement/amendment_recommendation/issued')?>",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        beforeSend:function(){
          start($('#wizard-arf'));
        },
        success: function (data) {
          var e = eval("("+data+")");
          if(e.status)
          {
            /*stop($('#wizard-arf'));
            $("#modal-submit").modal('hide');
            swal('Done',e.msg, 'success');
            window.open("<?= base_url('home') ?>","_self")*/
            setTimeout(function(){ swal('Done',e.msg, 'success'); stop($('#wizard-arf')); window.location.href = '<?=  base_url('home') ?>'; }, 3000);
          }
          else
          {
            /*swal('Ooopss','Fail, Try Again', 'warning');
            stop($('#icon-tabs'));
            $("#modal-submit").modal('hide');*/
            setTimeout(function(){ swal('Ooopss','Fail, Try Again', 'warning'); stop($('#wizard-arf')); }, 3000);
          }
        },
        error: function (e) {
          swal('Ooopss','Fail, Try Again', 'warning');
          stop($('#icon-tabs'));
          $("#modal-submit").modal('hide');
        }
    });
  }
  function approveClick(id) {
    $("#approval_id").val(id)
    $("#modal-approve").modal('show')
  }
  function approveRejectclick() {
    var status = $("#status").val()
    if(status == '2')
    {
      var note = $("#note").val()
      if(note)
      {
        submitApproval()
      }
      else
      {
        swal('Ooopss','Note must be filled', 'warning');
      }
    }
    else
    {
      submitApproval()
    }
  }
  function submitApproval() {
    $.ajax({
      type:'post',
      url:"<?=base_url('procurement/amendment_recommendation/approve')?>",
      data:$("#frm-approval").serialize(),
      beforeSend:function(){
        start($('#frm-approval'));
      },
      success:function(e){
        var r = eval("("+e+")")
        if(r.status)
        {
          swal('Done','Approved', 'success');
          window.open("<?= base_url('home') ?>","_self")
        }
        else
        {
          swal('Done','Approved', 'success');
          var approval_id = $("#approval_id").val()
          $("#btn-approval-"+approval_id).hide()
          $("#status-"+approval_id).html(r.status_str)
          $("#transaction-date-"+approval_id).html(r.transaction_date)
          $("#note-"+approval_id).html(r.note)
          /*<td id='status-$al->id'>$status</td>
                                      <td id='transaction-date-$al->id'>$transactionDate</td>
                                      <td id='note-$al->id'>$al->note</td>*/
        }
        stop($('#frm-approval'));
        $("#modal-approve").modal('hide');
      },
      error:function(e) {
        swal('Ooopss','Fail, Try Again', 'warning');
        stop($('#frm-approval'));
        $("#modal-approve").modal('hide');
      }
    })
  }
  $(document).ready(function(){
    <?php if($approval_view): ?>
    $(".amendment_recommendation_tab textarea, .amendment_recommendation_tab input").attr("disabled","")
    $(".btn-upload, .btn-hapus-file").hide()
    <?php endif;?>
    <?php if(isset($issued)):?>
        $(".btn-upload, .btn-hapus-file").show()
    <?php endif;?>
    $("#arf_request_value").text('<?= numIndo($total) ?>');
  })
</script>