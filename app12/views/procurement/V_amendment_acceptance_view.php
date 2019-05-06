<?php $this->load->view('procurement/partials/script') ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title"><?= lang("Amendment Acceptante & Supplier Document Subissions", "Amendment Acceptante & Supplier Document Subissions") ?></h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/home/">Home</a></li>
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
                                                    foreach ($arf->item as $item) {
                                                        $qty = $item->qty2 > 0 ? $item->qty1*$item->qty2 : $item->qty1;
                                                        $response_qty = $item->response_qty1 > 0 ? $item->response_qty1*$item->response_qty2 : $item->response_qty1;
                                                        $uom = $item->uom2 ? $item->uom1.'/'.$item->uom2 : $item->uom1;
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
                                                        <td class="text-right"><?= numIndo($item->response_unit_price) ?></td>
                                                        <td class="text-right">
                                                            <?= numIndo(($item->response_unit_price * $response_qty)) ?>
                                                        </td>
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
                                            <?= numIndo($arf->estimated_new_value) ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h6><i class="step-icon fa fa-paperclip"></i> Amendment Document</h6>
                            <fieldset>
                                <div class="row">
                                  <div class="col-md-12" style="margin-bottom: 10px">
                                    <a href="#" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal">Upload</a>
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
                                            echo "<tr>
                                              <td>".biduploadtype($value->tipe, true)."</td>
                                              <td>".$value->file_name."</td>
                                              <td>".$value->created_at."</td>
                                              <td>".user($value->created_by)->NAME."</td>
                                              <td>
                                                <a href='".base_url('userfiles/temp/'.$value->file_path)."' target='_blank' class='btn btn-sm btn-primary'>Download</a>
                                                <a href='#' class='btn btn-sm btn-danger' onclick='hapusFile($value->id)'>Hapus</a>
                                              </td>
                                            </tr>";
                                          }?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                            </fieldset>

                            <h6><i class="step-icon fa fa-check"></i> Completeness</h6>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <h4>Performance Bond</h4>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Performance Bond No</th>
                                            <th class="text-center">Issuer</th>
                                            <th class="text-center">Issued Date</th>
                                            <th class="text-center">Value</th>
                                            <th class="text-center">Curr</th>
                                            <th class="text-center">Effective Date</th>
                                            <th class="text-center">Expired Date</th>
                                            <th>Description</th>
                                            <th width="100px" class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="completness-performance-bond">
                                        <?php $no = 1 ?>
                                        <?php foreach ($acceptance_docs as $doc) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $doc->no ?></td>
                                                <td class="text-center"><?= $doc->issuer ?></td>
                                                <td class="text-center"><?= dateToIndo($doc->issued_date) ?></td>
                                                <td class="text-center"><?= numIndo($doc->value) ?></td>
                                                <td class="text-center"><?= $doc->currency ?></td>
                                                <td class="text-center"><?= dateToIndo($doc->effective_date) ?></td>
                                                <td class="text-center"><?= dateToIndo($doc->expired_date) ?></td>
                                                <td><?= $doc->description ?></td>
                                                <td class="text-right">
                                                    <a href="#" onclick="completnessClick('<?=$doc->id?>')" class="btn btn-info btn-sm btn-block">Show/Edit</a>
                                                </td>
                                            </tr>
                                            <?php $no++ ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </form>
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-success" type="button" onclick="completnesSubmit()">Completeness</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-completness" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Completness</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-completness" class="modal-body" style="max-height: 70vh; overflow-y: auto;">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="completness-submit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Amendment Completed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <button class="btn btn-primary pull-right" type="button" onclick="amendmentCompleteClick()">Ok</button>
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
    function completnessClick(id) {
        $.ajax({
            type:'POST',
            data:{id:id},
            url:"<?=base_url('procurement/amendment_acceptance/completness')?>",
            success:function(e){
                $("#body-completness").html(e)
                $("#modal-completness").modal('show')
            }
        })
    }
    function completnesStore() {
      var form = $("#compleness-form")[0];
      var data = new FormData(form);
      $.ajax({
          type: "POST",
          enctype: 'multipart/form-data',
          url: "<?=base_url('procurement/amendment_acceptance/completness_store')?>",
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
              stop($('#wizard-arf'));
              $("#modal-completness").modal('hide');
              alert(e.msg)
              $("#completness-performance-bond").html(e.html)
            }
            else
            {
              alert('Fail, Try Again');
              stop($('#wizard-arf'));
              $("#modal-completness").modal('hide');
            }
          },
          error: function (e) {
            alert('Fail, Try Again');
            stop($('#wizard-arf'));
            $("#modal-completness").modal('hide');
          }
      });
    }
    function completnesSubmit() {
        $("#completness-submit-modal").modal('show')
    }
    function amendmentCompleteClick() {
        $.ajax({
            type:'POST',
            data:{id:"<?= $arf->acceptance->id ?>"},
            url:"<?=base_url('procurement/amendment_acceptance/store')?>",
            beforeSend:function(){
                start($('#wizard-arf'));
            },
            success:function(data){
                var e = eval("("+data+")");
                if(e.status)
                {
                  stop($('#wizard-arf'));
                  $("#completness-submit-modal").modal('hide');
                  alert(e.msg)
                  window.open("<?= base_url('home') ?>","_self")
                }
                else
                {
                  alert('Fail, Try Again');
                  stop($('#wizard-arf'));
                  $("#completness-submit-modal").modal('hide');
                }
            },
            error: function (e) {
                alert('Fail, Try Again');
                stop($('#wizard-arf'));
                $("#completness-submit-modal").modal('hide');
            }
        })
    }
</script>