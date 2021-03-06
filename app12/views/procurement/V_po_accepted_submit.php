<?php /* page specific */
$opt_blanket = ['' => '', 1 => 'Blanket', 0 => 'Non Blanket'];
$opt_yesno = array('' => '', '1' => 'Yes', 0 => 'No');
$po_document_type = $this->M_purchase_order_document->getTypes();
?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>ast11/app-assets/css/plugins/forms/wizard.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>ast11/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>ast11/app-assets/vendors/css/tables/datatable/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>ast11/css/custom/custom.css">

<style>
body {
    font-family: "Open Sans", sans-serif;
    font-size: 14px;
    font-weight: normal;
}

#po_document-issued_date, #po_document-expired_date, #po_document-effective_date {
    background: #fff
}
</style>

<div class="app-content content">
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-1">
      <h3 class="content-header-title"><?= lang("Agreement", "Agreement") ?></h3>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>/home/">Home</a></li>
          <li class="breadcrumb-item active"><?= lang("Procurement", "Procurement") ?></li>
          <li class="breadcrumb-item active"><?= lang("Agreement", "Agreement") ?></li>
        </ol>
      </div>
    </div>
  </div>



  <div class="content-body">
    <div class="row">
      <div class="col-md-4">
        <table class="table table-condensed">
          <tr>
            <td width="30%">Company</td>
            <td width="5%">:</td>
            <td width="65%"><?= $msr->company_desc ?>
            </td>
          </tr>
          <tr>
            <td>Supplier</td>
            <td>:</td>
            <td><?= $vendor->NAMA ?>
            </td>
          </tr>
      </table>
    </div>
    <div class="col-md-4">
        <table class="table table-condensed">
          <tr>
            <td width="30%">Agreement No.</td>
            <td width="5%">:</td>
            <td width="65%"><?= $po->po_no ?></td>
          </tr>
          <tr>
            <td>Agreement Value</td>
            <td>:</td>
            <td><?= display_money(numEng(@$po->total_amount), @$opt_currency[$po->id_currency]) ?></td>
          </tr>
        </table>
      </div>
    <div class="col-md-4">
       <table class="table table-condensed">
          <tr>
            <td width="30%">Title</td>
            <td width="5%">:</td>
            <td width="65%"><?= $po->title ?></td>
          </tr>
          <tr>
            <td>Department</td>
            <td>:</td>
            <td><?= @$requestor_dept->DEPARTMENT_DESC ?></td>
          </tr>
      </table>
    </div>
  </div>
  <section id="configuration">
    <div class="row">
      <div class="col-md-12">
        <div class="card"> 
          <div class="card-content collapse show">
            <div class="card-body card-dashboard card-scroll">
               <div class="row">
                <div class="col-md-12">
                <?php $this->load->view('V_message_section', compact('message')) ?>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <form id="purchase_order_form" method="POST" enctype="multipart/form-data" class="steps-validation wizard-circle">
                    <input type="hidden" name="po_id" value="<?= $po->id ?>">

                    <?php /* PO Development */ ?>
                    <h6><i class="step-icon icon-info"></i> Agreement Data</h6>
                    <fieldset>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="title">
                              Title :
                            </label>
                            <textarea disabled class="form-control" id="title" name="title" rows="2" style="width: 100%"><?= set_value('title', $po->title) ?></textarea>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="id_currency">
                              Currency :
                            </label>
                            <input type="text" class="form-control" name="currency_desc" id="currency_desc" disabled value="<?= set_value('currency_desc', @$opt_currency[$po->id_currency]) ?>">
                            <input type="hidden" class="form-control" name="id_currency" id="id_currency" disabled value="<?= set_value('id_currency', $po->id_currency) ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="po_date">
                                Agreement Date :
                              </label>
                              <input disabled type="date" class="form-control pickadate" data-value="<?= set_value('po_date', $po->po_date) ?>" value="<?= set_value('po_date', $po->po_date) ?>" id="po_date" name="po_date">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                          <label for="msr_type">
                            Blanket Type :
                            <span class="danger">*</span>
                          </label>
                            <input type="text" name="blanket_desc" readonly class="form-control" value="<?= set_value('blanket_desc', @$opt_blanket[$po->blanket]) ?>">
                            <input type="hidden" name="blanket" readonly  value="<?= set_value('blanket', $po->blanket) ?>">
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="account_name">
                              Account Name :
                            </label>
                            <input disabled type="text" class="form-control required" value="<?= set_value('account_name', $po->account_name) ?>" id="account_name" name="account_name" value="<?= set_value('account_name', $po->account_name) ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="delivery_date">
                              <?php if ($po->po_type == $this->M_purchase_order_type::TYPE_GOODS): ?>
                                Delivery Date :
                              <?php else: ?>
                                Expired Date :
                              <?php endif; ?>
                              </label>
                              <input disabled type="date" class="form-control pickadate" data-value="<?= set_value('delivery_date', $po->delivery_date) ?>" id="delivery_date" name="delivery_date" value="<?= set_value('deliver_date', $po->delivery_date) ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="bank_name">
                              Bank Name :
                            </label>
                            <input disabled type="text" class="form-control" value="<?= set_value('bank_name', $po->bank_name) ?>" id="bank_name" name="bank_name">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="payment_term">
                                Payment Term :
                              </label>
                              <textarea rows="2" disabled type="input" class="form-control" id="payment_term" name="payment_term"><?= set_value('payment_term', $po->payment_term) ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="shipping_term">
                              Shipping Term :
                            </label>
                            <input disabled type="text" class="form-control" value="<?= set_value('shipping_term', $po->shipping_term) ?>" id="shipping_term" name="shipping_term">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="id_dpoint">
                                Delivery Point :
                              </label>
                              <input type="text" type="text" name="dpoint_desc" class="form-control disabled" disabled id="dpoint_desc" value="<?= set_value('dpoint_desc', @$opt_dpoint[$po->id_dpoint])?>">
                              <input type="hidden" name="id_dpoint" class="form-control disabled" disabled id="id_dpoint" value="<?= set_value('id_dpoint', $po->id_dpoint)?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="id_importation">
                              Importation :
                            </label>
                            <input type="text" name="importation_desc" class="form-control disabled" disabled id="importation_desc" value="<?= set_value('importation_desc', @$opt_importation[$po->id_importation])?>">
                            <input type="hidden" name="id_importation" class="form-control disabled" disabled id="id_importation" value="<?= set_value('id_importation', $po->id_importation)?>">
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tkdn_type">TKDN</label>
                            <input type="text" name="tkdn_type_desc" value="<?= set_value('tkdn_type_desc', @$opt_tkdn_type[$po->tkdn_type]) ?>" class="form-control disabled" disabled id="tkdn_type_desc">
                            <input type="hidden" name="tkdn_type" value="<?= set_value('tkdn_type', $po->tkdn_type) ?>" class="form-control disabled" disabled id="tkdn_type">
                          </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="tkdn_value_goods">TKDN Value</label>
                              <div class="row">
                                <div class="col-sm-4">
                                  <input disabled name="tkdn_value_goods" id="tkdn_value_goods" value="<?= set_value('tkdn_value_goods', $po->tkdn_value_goods) ?>" class="form-control" placeholder="Goods">
                                  <small class="form-text text-muted">Goods</small>
                                </div>
                                <div class="col-sm-4">
                                  <input disabled name="tkdn_value_service" id="tkdn_value_service" value="<?= set_value('tkdn_value_service', $po->tkdn_value_service) ?>" class="form-control" placeholder="Service">
                                  <small class="form-text text-muted">Service</small>
                                </div>
                                <div class="col-md-4">
                                  <input disabled name="tkdn_value_combination" id="tkdn_value_combination" value="<?= set_value('tkdn_value_combination', $po->tkdn_value_combination) ?>" class="form-control" placeholder="Combination">
                                  <small class="form-text text-muted">Combination</small>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>

                      <hr> 

                      <div class="row">
                        <div class="col-md-6">
                          <h5>Required Document</h5>
                          <table>
                          <tbody>
                            <?php foreach($po_document_type as $type => $description): ?>
                            <?php
                            $checked = '';
                            $reqdoc = @$po_required_doc[$type];
                            if (in_array($type, $opt_po_required_doc)) {
                              $checked .= ' checked ';
                            }
                            ?>
                            <tr>
                              <td><label for="<?= 'po_document'.$type ?>"><?= $description ?></label></td>
                              <td>
                                <fieldset class="checkbox">
                                <label>
                                <input disabled type="checkbox" name="<?= 'po_document'.$type ?>" id="<?= 'po_document'.$type ?>" <?= $checked ?>>
                                <span><?= @$reqdoc->description ?></span>
                                </label>
                                </fieldset>
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                          </table>
                        </div>
                      </div>

                      <hr>

                      <div class="row" style="padding-top: 20px; padding-bottom: 10px">
                        <div class="col-md-12" style="overflow: auto">
                          <table class="table table-striped" id="po_items" style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Type</th>
                              <th>Semic No</th>
                              <th>Description</th>
                              <th>Qty</th>
                              <th>UoM</th>
                              <th>Unit Price</th>
                              <th>Total</th>
                              <th>Cost Center</th>
                              <th>Acc. Sub.</th>
                              <th>Inventory Type</th>
                              <th>Item Modif.</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $est_total_price = $total_amount = 0 ?>
                          <?php if (count($po_items) > 0): ?>
                            <?php foreach($po_items as $i => $item): ?>
                            <tr>
                              <td><?= $i + 1 ?></td>
                              <td><?= @$opt_item_type[$item->id_itemtype] ?></td>
                              <td><?= $item->id_itemtype == 'GOODS' ? $item->semic_no : '' ?></td>
                              <td><?= $item->material_desc?></td>
                              <td><?= numeng($item->qty) ?></td>
                              <td><?= $item->uom_desc ?></td>
                              <td><span style="text-align:right"><?= numEng($item->unitprice) ?></span></td>
                              <td><span style="text-align:right"><?= numEng($item->total_price) ?></span></td>
                              <td><?= $item->costcenter_desc ?>
                              <td><?= $item->accsub_desc ?>
                              <td><?= @$opt_msr_inventory_type[$item->id_msr_inv_type] ?>
                              <td><?= $item->id_itemtype == 'GOODS' ? '' : @$opt_yesno[$item->is_modification] ?></td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><span style="text-align:right">Total</span></td>
                              <td><span style="text-align:right"><?= numEng($po->total_amount) ?></span></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tfoot>
                          <?php endif; ?>
                          </table>
                        </div>
                      </div>
                    </fieldset>

                    <?php /* PO Attachment */ ?>
                    <h6><i class="step-icon icon-paper-clip"></i> Agreement Document</h6>
                    <fieldset>
                      <div class="row">
                        <div class="col-md-12">

                          <div id="attachment-alert" class="alert alert-warning hidden" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div id="attachment-list" style="padding-bottom: 20px">

                            <div class="row">
                              <div class="col-md-2"><?php /* type */ ?>
                                <label>Type</label>
                              </div>
                              <div class="col-md-1"><?php /* sequence */ ?>
                                <label>Seq</label>
                              </div>
                              <div class="col-md-3"><?php /* filename */ ?>
                                <label>Filename</label>
                              </div>
                              <div class="col-md-3"><?php /* upload time */ ?>
                                <label>Upload Time</label>
                              </div>
                              <div class="col-md-2"><?php /* upload by */ ?>
                                <label>Uploader</label>
                              </div>
                              <div class="col-md-1"><?php /* action */ ?>
                                <label>Action</label>
                              </div>
                            </div>

                            <?php if ($po->completed == 1 &&
                                !$this->M_purchase_order_attachment->isDocumentOfTypeExists($po->id, $this->M_purchase_order_attachment::TYPE_COUNTER_SIGNED_PO)): ?>
                            <div class="row">
                              <div class="col-md-2"><?php /* type */ ?>
                                <?= $po_attachment_type[$this->M_purchase_order_attachment::TYPE_COUNTER_SIGNED_PO] ?>
                              </div>
                              <div class="col-md-1"><?php /* sequence */ ?></div>
                              <div class="col-md-3">
                                <input type="file" name="attachment_<?= $this->M_purchase_order_attachment::TYPE_COUNTER_SIGNED_PO?>" id="attachment_<?= $this->M_purchase_order_attachment::TYPE_COUNTER_SIGNED_PO?>" class="form-control required">
                              </div>
                              <div class="col-md-3"></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-1"></div>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($po_attachments) && count($po_attachments) > 0 ): ?>
                              <?php foreach($po_attachments as $attachment): ?>
                              <!-- start attachment -->
                              <div class="row">
                                <div class="col-md-2"><?php /* type */ ?>
                                  <?= $po_attachment_type[$attachment->tipe]?>
                                </div>
                                <div class="col-md-1"><?php /* sequence */ ?> 
                                  <?= $attachment->sequence ?>
                                </div>
                                <div class="col-md-3"><?= $attachment->file_name ?></div>

                                <div class="col-md-3"><?= $attachment->created_at ?> </div>

                                <div class="col-md-2"><?= $attachment->created_by_name ?></div>
                                <div class="col-md-1">
                                  <a href="<?= base_url($attachment->file_path.$attachment->file_name) ?>" target="_blank">
                                    <button type="button" class="btn btn-info btn-sm">
                                      <!-- <i class="icon-cloud-download"></i> -->
                                      Download
                                    </button>
                                  </a>
                                </div>
                              </div>
                              <?php endforeach; ?>
                            <?php endif; ?>

                          </div>  <!-- end attachment -->
                        </div>
                      </div>
                    </fieldset>

                    <?php if ($po->completed == 1): ?>
                    <h6><i class="step-icon icon-directions"></i>Completeness</h6>
                    <fieldset>
                    <?php foreach($po_required_doc as $po_rdoc): ?>
                    <div class="row">
                      <div class="col-md-12">
                        <h6>
                        <?= $po_rdoc->doc_type == $this->M_purchase_order_document::TYPE_OTHER ?
                          $po_rdoc->description :
                          $po_document_type[$po_rdoc->doc_type]
                        ?>
                        </h6>
                        <?php if ($po_rdoc->doc_type != $this->M_purchase_order_document::TYPE_OTHER): ?>
                        <button type="button" role="button" id="Add<?= $po_rdoc->doc_type?>" data-doc_type="<?= $po_rdoc->doc_type?>" data-doc_type_name="<?= $po_document_type[$po_rdoc->doc_type] ?>" class="btn btn-success pull-right po-document-open-btn" data-toggle="modal" data-target="#po_document_modal">Add</button>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="row">
                      <?php if ($po_rdoc->doc_type != $this->M_purchase_order_document::TYPE_OTHER): ?>
                      <div class="col-md-12" style="overflow: auto">
                        <table id="po_required_doc<?= $po_rdoc->doc_type?>" class="po_document_table table table-striped" style="width: 100%">
                        </table>
                      </div>
                      <?php else: ?>
                      <div class="col-md-8" class="open-this">
                      <?php $time = time() ?>
                      <input type="file" name="attachment" data-doc_id="<?= $time ?>" id="po_document<?= $po_rdoc->doc_type?>_file" class="form-control">
                      </div>
                      <?php endif; ?>
                    </div>

                    <hr>
                    <?php endforeach; ?>
                    </fieldset>
                    <?php endif; ?>

                    <?php /* PO Approval */ ?>
                    <?php if (@$po->id): ?>
                    <h6><i class="step-icon icon-directions"></i>Approval</h6>
                    <fieldset>
                    <?php
                    $data_id = $po->id;
                    $rows = $approval_list;
                    $this->load->view('procurement/V_po_approval_section', compact('po', 'data_id', 'rows', 'roles'));
                    ?>
                    </fieldset>
                    <?php endif; ?>


                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>
  </div>


<!-- modal #po_document_modal -->
<div class="modal fade text-left open-this" id="po_document_modal" role="dialog" aria-labelledby="modallabel-item" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">

<div class="modal-header">
<h4 class="modal-title" id="modal-label-item">Document</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<form action="#" id="po_document-add_form">
        <div class="modal-body">
          <input type="hidden" id="po_document-doc_type" name="doc_type">
          <input type="hidden" id="po_document-po_id" name="po_id" value="<?= $po->id ?>">
          <input type="hidden" id="po_document-doc_id" name="doc_id">
          <input type="hidden" id="po_document-id" name="id">
          <div class="form-group">
            <label><span id="po_document-no_label">No</span></label>
            <input type="text" id="po_document-doc_no" name="doc_no" class="form-control">
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="po_document-issuer">Issuer: </label>
                <input type="text" name="issuer" id="po_document-issuer" class="form-control">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="po_document-issued_date">Issued date: </label>
                <input name="issued_date" id="po_document-issued_date" class="form-control">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="po_document-value">Value: </label>
                <input type="text" name="value" id="po_document-value" class="form-control" number="true" min="0">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="currency_name">Currency: </label>
                <input type="hidden" name="currency_id" id="po_document-currency_id" value="<?= $po->id_currency ?>">
                <input readonly name="currency_name" id="po_document-currency_name" value="<?= @$opt_currency[$po->id_currency] ?>" class="form-control">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="effective_date">Effective date: </label>
                <input name="effective_date" id="po_document-effective_date" class="form-control pickadate">
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="expired_date">Expired date: </label>
                <input name="expired_date" id="po_document-expired_date" class="form-control pickadate">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="po_document-description">Description: </label>
                <textarea name="description" id="po_document-description" class="form-control"></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="attachment">Description: </label>
                <input type="file" name="attachment" id="po_document-attachment" class="form-control">
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>

    <div class="modal-footer text-right">
      <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="po_document-add">Submit</button>
    </div>
  </div>
</div>
</div>

<script src="<?= base_url() ?>ast11/select2-master/dist/js/select2.min.js" type="text/javascript"></script> 
<script src="<?= base_url() ?>ast11/filter/perfect-scrollbar.min.js" type="text/javascript"></script>     
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {

  if (!($('.modal.in').length)) {
    $('.modal-dialog').css({
      top: 0,
      left: 0
    });
  }
  $('.modal-dialog').draggable({
    handle: ".modal-header"
  });

var form = $('#purchase_order_form');

$('#purchase_order_form').steps({
  headerTag: "h6",
  bodyTag: "fieldset",
  enableFinishButton: true,
  transitionEffect: "fade",
  titleTemplate: '#title#', 
  enablePagination: true,
  enableAllSteps: true,
  labels: {
    'finish': 'Submit'
  },
  onFinishing: function(event, currenIndex) {
    // form.validate().settings.ignore = ":disabled"
    // console.log(form.valid())
    if ($('#attachment_<?= $this->M_purchase_order_attachment::TYPE_COUNTER_SIGNED_PO ?>').val() == '') {
      swal('Error', 'Please upload document', 'error')
      return false
    }

    return true
  },
  onFinished: function(event, currentIndex) {
    swal({
        title: "AGREEMENT",
        text: "Are you sure want to submit?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Submit",
        closeOnConfirm: true
      },function () {
        return form.submit()
      })
  }
});

//hide next and previous button
$('a[href="#next"]').hide();
$('a[href="#previous"]').hide();


var po_date = $('#po_date').pickadate({
format: 'd mmmm yyyy',
formatSubmit: 'yyyy-mm-dd'
})
.pickadate('picker').set('select', new Date('<?= $po->po_date ?>'));

var delivery_date = $('#delivery_date').pickadate({
format: 'd mmmm yyyy',
formatSubmit: 'yyyy-mm-dd'
})
.pickadate('picker').set('select', new Date('<?= $po->delivery_date ?>'));

$('#po_document-effective_date, #po_document-expired_date, #po_document-issued_date').pickadate({
  format: 'd mmmm yyyy',
  formatSubmit: 'yyyy-mm-dd'
})

$('#tkdn_type').change(function(e) {
var val =  $(this).val();
var goods_elem = $('#tkdn_value_goods'),
    service_elem = $('#tkdn_value_service'),
    combination_elem = $('#tkdn_value_combination')

  switch(val) {
    case '1': // Goods
      goods_elem.attr('disabled', true).addClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').show()
      service_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', null).attr('min', null)
        .closest('div').hide()
      combination_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').hide()
      break;
    case '2': // Service
      goods_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', null).attr('min', null)
        .closest('div').hide()
      service_elem.attr('disabled', true).addClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').show()
      combination_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').hide()
      break;
    case '3': // Combination
      goods_elem.val('').attr('disabled', true).addClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').show()
      service_elem.val('').attr('disabled', true).addClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').show()
      combination_elem.attr('disabled', true).addClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').show()
      break;
    default:
      goods_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').hide()
      service_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').hide()
      combination_elem.val('').attr('disabled', true).removeClass('required')
        .attr('max', 100).attr('min', 0)
        .closest('div').hide()
      break;
  }
})

$('#tkdn_type').change()


<?php foreach($po_required_doc as $po_rdoc): ?>
<?php if ($po_rdoc->doc_type != $this->M_purchase_order_document::TYPE_OTHER): ?>
$('#po_required_doc<?= $po_rdoc->doc_type ?>').DataTable({
  "paging"    : false,
  "info"      : false,
  "searching" : false,
  "ordering"  : false,
  "processing": true,
  "ajax": {
    "context": $('#po_required_doc<?= $po_rdoc->doc_type ?>'),
    "url":  '<?= base_url('procurement/purchase_order/getPODocumentAgreement/'.$po->id.'/'.$po_rdoc->doc_type) ?>',
    "complete": function(xhr, status) {
      if (status == 'success') {
        var name = 'po_required_doc'
        var id = $(this).attr('id')
        var doc_type = id.substr(name.length, id.length - name.length)
        var data = JSON.parse(xhr.responseText)

        if (data.data.length > 0) {
          $('#Add'+doc_type).hide();   
        } else {
          $('#Add'+doc_type).show();
        }
      }
    }
  },
  "columns"   : [
    { 'data': 'doc_id', 'title': 'ID', 'visible': false },
    { 'data': 'doc_type', 'title': 'Doc Type', 'visible': false },
    { 'data': 'doc_no', 'title': 'Doc No' },
    { 'data': 'issuer', 'title': 'Issuer' },
    { 'data': 'issued_date', 'title': 'Issued date' },
    { 'data': 'value', 'title': 'Value' },
    { 'data': 'currency_id', 'title': 'Currency', 'visible': false },
    { 'data': 'currency_name', 'title': 'Currency' },
    { 'data': 'effective_date', 'title': 'Effective date' },
    { 'data': 'expired_date', 'title': 'Expired date' },
    { 'data': 'description', 'title': 'Description' },
    { 'data': 'file_name', 'title': 'File', 'createdCell': function(td, cellData, rowData, row, col) {
        $(td).html('<a href="'+ rowData.file_url +'">'+ rowData.file_name + '</a>')
    }},
    { 'data': 'action_btn', 'title': 'Action', visible: true },
    { 'data': 'file_url', 'title': 'File URL', 'visible': false }
  ]
});

/*
$.get('<?= base_url('procurement/purchase_order/getPODocumentAgreement/'.$po->id.'/'.$po_rdoc->doc_type) ?>')
.done(function(data) {
  data.data.forEach(function(d) {
    var item = document_cart[<?= $po_rdoc->doc_type?>].add(
      d.doc_id,
      d.doc_no,
      d.doc_type,
      d.issuer,
      d.issued_date,
      d.value,
      d.currency_id,
      d.currency_name,
      d.effective_date,
      d.expired_date,
      d.status,
      d.description,
      d.file_name,
      d.file_url
      )

    $('#po_required_doc<?= $po_rdoc->doc_type ?>').DataTable().row.add(item)
})

$('#po_required_doc<?= $po_rdoc->doc_type ?>').DataTable().draw()
})
*/

<?php else: ?>
$.get('<?= base_url('procurement/purchase_order/getPODocumentAgreement/'.$po->id.'/'.$po_rdoc->doc_type) ?>')
.done(function(data) {
  console.log(data)
  // data.data.forEach(function(d) {
  //   var item = document_cart[<?= $po_rdoc->doc_type?>].add(
  //     d.doc_id,
  //     d.doc_no,
  //     d.doc_type,
  //     d.issuer,
  //     d.issued_date,
  //     d.value,
  //     d.currency_id,
  //     d.currency_name,
  //     d.effective_date,
  //     d.expired_date,
  //     d.status,
  //     d.description,
  //     d.file_name,
  //     d.file_url
  //     )
  // })

  if (data.data.length > 0) {
    var item = data.data[0]
    var p = $('#po_document3_file').parent()
    p.append('<a href="'+ item.file_url +'">'+ item.file_name +'</a>');
    $('#po_document3_file').val('').prop('disabled', true).removeClass('required').hide()
    return true
  }

  $('#po_document3_file').val('').prop('disabled', true).removeClass('required').hide()
  // TODO: enable this
  // $('#po_document3_file').val('').prop('disabled', false).addClass('required').show()
})

<?php endif; ?>

<?php endforeach; ?>

<?php if ($po->po_type != $this->M_purchase_order_type::TYPE_GOODS): ?> 
$('#id_dpoint').parent().parent().hide()
$('#shipping_term').parent().parent().hide()
$('#importation_desc').parent().parent().hide()
<?php endif; ?>

// $('.po_document_table').on('click', '.po-document-update-btn', function() {
//     $('#po_document_modal').modal('show')
// })


$(document).on('show.bs.modal', '#po_document_modal', function(e) {
    var btn = $(e.relatedTarget);
    var doc_id = btn.val()
    var id = btn.data('id')
    var modal = this;

    modal_start($(modal));

    $.get('/procurement/purchase_order/getPODocumentAgreementItem/'+ id)
      .done(function(data) {
        // load to modal fields
        $('#po_document-id').val(data.data.id)
        $('#po_document-po_id').val(data.data.po_id)
        $('#po_document-doc_no').val(data.data.doc_no)
        $('#po_document-doc_type').val(data.data.doc_type)
        $('#po_document-issuer').val(data.data.issuer)
        $('#po_document-issued_date').pickadate('picker').set('select', new Date(data.data.issued_date))
        $('#po_document-value').val(data.data.value)
        $('#po_document-effective_date').pickadate('picker').set('select', new Date(data.data.effective_date))
        $('#po_document-expired_date').pickadate('picker').set('select', new Date(data.data.expired_date))
        $('#po_document-description').val(data.data.description)
        $('#po_document-attachment').val('')

        $('#po_document-attachment').parents('.row').find('.po_document-file_wrapper').remove()
        if (data.data.file_name) {
          var file_wrapper = '<div class="po_document-file_wrapper col-md-12"><a href="'+data.data.file_url+'" target="blank">'+data.data.file_name+'</a></div>'
          $('#po_document-attachment').parents('.row').append(file_wrapper)
        }
      })
      .fail(function() {
        swal('Error', 'Error when loading data', 'error')
      })
      .always(function() {
        modal_stop($(modal))
      })
})

$('#po_document-add').click(function(e) {
    var btn = this
    var modal = $(this).parents('.modal')
    var form = modal.find('form')

    var formdata = new FormData(form[0])
    formdata.set('issued_date', moment($('#po_document-issued_date').val()).format('YYYY-MM-DD'))
    formdata.set('effective_date', moment($('#po_document-effective_date').val()).format('YYYY-MM-DD'))
    formdata.set('expired_date', moment($('#po_document-expired_date').val()).format('YYYY-MM-DD'))

    // only post if any value
    if ($('#po_document-attachment').val() == '') {
        formdata.delete('attachment')
    }

    modal_start(modal)
    // send data
    $.ajax({
      url: '<?= base_url('procurement/purchase_order/uploadPODocumentAgreement') ?>',
      data: formdata,
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      async: true,
      method: "POST",
    })
    .done(function(data) {
      // if succeed
      if (data.type == 'success') {
        // reload data grid
        $('#po_required_doc'+formdata.get('doc_type')).DataTable().ajax.reload().draw()
        // close modal
        toastr.success(data.message)
        $(btn).parents('.modal').modal('hide')
        return true
      }

      toastr.error(data.message)
      return false
    })
    .fail(function(error) {
       toastr.error(error)
    })
    .always(function(data) {
      modal_stop(modal)
    })
})

});
</script>
<?php /* vim: set fen foldmethod=indent ts=2 sw=2 tw=0 et autoindent :*/ ?> 
