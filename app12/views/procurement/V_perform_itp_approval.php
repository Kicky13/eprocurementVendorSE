<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title"><?= lang("Persetujuan ITP Vendor", "ITP Vendor Approval") ?></h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/home/">Home</a></li>
                        <li class="breadcrumb-item active"><?= lang("Pengadaan", "Procurement") ?></li>
                        <li class="breadcrumb-item active"><?= lang("Persetujuan ITP Vendor", "ITP Vendor Approval") ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-header">
                                        <div class="heading-elements">
                                            <h5 class="title pull-right">
                                                <!-- <button data-id="" id="approve" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary" title="Update"><i class=""> Proses</i></button>
                                                <button data-id="" id="reject" data-toggle="modal" data-target="#modal_rej" class="btn btn-sm btn-danger" title="Update"><i class=""> Reject</i></button> -->
                                                <!-- <button aria-expanded="false" id="itp_doc" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> <?= lang("Tambah ITP Document", "Create ITP Document") ?></button>
                                                <button aria-expanded="false" id="itp_progres" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> <?= lang("Show ITP Document On Progress", "Show ITP Document On Progress") ?></button> -->
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-content collapse show list_progress">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tbl" class="table table-striped table-bordered table-fixed-column order-column dataex-lr-fixedcolumns table-hover display" width="100%">
                                                <tfoot>
                                                    <tr>
                                                        <th><center>No</center></th>
                                                        <th><center>ITP No</center></th>
                                                        <th><center><?= lang("Jabatan", "Position") ?></center></th>
                                                        <th><center><?= lang("PO Title", "PO Title") ?></center></th>
                                                        <th><center>Status</center></th>
                                                        <th><center><?= lang("Aksi", "Action") ?></center></th>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-content collapse show itp_agrement">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tbl1" class="table table-striped table-bordered table-fixed-column order-column dataex-lr-fixedcolumns table-hover display" width="100%">
                                                <tfoot>
                                                    <tr>
                                                        <th><center>No</center></th>
                                                        <th><center><?= lang("No Persetujuan", "Agrement No") ?></center></th>
                                                        <th><center><?= lang("Tipe", "Type") ?></center></th>
                                                        <th><center><?= lang("Subjek Kerja", "Subject Work") ?></center></th>
                                                        <th><center><?= lang("Contractor", "Contractor") ?></center></th>
                                                        <th><center><?= lang("Matauang", "Currency") ?></center></th>
                                                        <th><center><?= lang("Mulai Validasi", "Validity Start") ?></center></th>
                                                        <th><center><?= lang("Selesai Validasi", "Validity End") ?></center></th>
                                                        <th><center><?= lang("Aksi", "Action") ?></center></th>
                                                    </tr>
                                                </tfoot>

                                            </table>
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

<div id="myModal" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class=" modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card-content">
                        <div class="card-body">
                          <h1><b>ITP Development</b></h1>
                          <table class="table table-responsive">
                            <tbody>
                              <tr>
                                <th class="text-nowrap" scope="row"><?= lang("Perusahaan", "Company"); ?></th>
                                <td> <span id="comp_htm"></span> </td>
                              </tr>
                              <tr>
                                <th class="text-nowrap" scope="row">Contractor</th>
                                <td><input type="hidden" id="vendor" class="form-control" value="" readonly> <span id="contractor_htm"></span> </td>
                              </tr>
                              <tr>
                                <th class="text-nowrap" scope="row">Agrement No</th>
                                <td colspan="5"><input type="hidden" id="agrm_no" class="form-control" value="" readonly> <span id="agreement_htm"></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <!-- row2 -->
                    <div class="col-md-6">
                      <div class="card-content">
                        <div class="card-body">
                          <h1><b>&nbsp;</b></h1>
                          <table class="table table-responsive">
                            <tbody>
                              <tr>
                                <th class="text-nowrap" scope="row"><?= lang("Departemen", "Departement"); ?></th>
                                <td> <span id="dept_htm"></span> </td>
                              </tr>
                              <tr>
                                <th class="text-nowrap" scope="row"><?= lang("Tanggal", "Date"); ?></th>
                                <td colspan="5"><input type="date" name="date_itp" id="date_itp" class="form-control" value="" required> <span id=""></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
                        <div class="app-content">
                            <div class="content-wrapper">
                                <div id="edit" class="wrapper wrapper-content animated fadeInRight white-bg">
                                  <form id="itp_form" action="#" class="steps-validation wizard-circle" enctype="multipart/form-data">
                                      <h6><?= lang("Informasi", "Information"); ?></h6>
                                      <h6><?= lang("Attachment", "Attachment"); ?></h6>

                                      <fieldset id="bagian1" class="col-md-12" class="white-bg">
                                          <input type="hidden" id="sequence" name="sequence" value="">
                                          <input type="hidden" id="idx" name="idx" value="">
                                          <input type="hidden" id="user_roles" name="user_roles" value="">
                                          <input type="hidden" id="id_itp" name="id_itp" value="">
                                          <input type="hidden" id="email_approve" name="email_approve" value="">
                                          <input type="hidden" id="edit_content" name="edit_content" value="">
                                          <input type="hidden" id="id_vendor" name="id_vendor" value="">
                                          <input type="hidden" id="vendor_name" name="vendor_name" value="">
                                          <input type="hidden" id="po_number" name="po_number" value="">
                                          <h2 class="m-b-md"><?= lang("Item Selection :", "Item Selection :"); ?></h2>
                                          <div class="row">
                                            <table id="tbl_msritem" class="table table-bordered table-striped table-responsive" width="100%">
                                              <thead>
                                                <tr>
                                                  <th>No</th>
                                                  <th><?= lang("Deskripsi", "Description") ?></th>
                                                  <th><?= lang("Qty", "Qty") ?></th>
                                                  <th><?= lang("Harga Satuan", "Unit Price") ?></th>
                                                  <th><?= lang("Total", "Total") ?></th>
                                                  <th><?= lang("Pengeluaran", "Spending") ?></th>
                                                  <th><?= lang("Sisa", "Remaining") ?></th>
                                                  <th><?= lang("Checklist", "Checklist") ?></th>
                                                </tr>
                                              </thead>
                                              <tbody id="get_item_selection">

                                              </tbody>
                                            </table>
                                          </div>

                                          <h2 class="m-b-md"><?= lang("Item Selected to ITP", "Item Selected to ITP"); ?></h2>
                                          <div class="row">
                                            <!-- <input type="hidden" id="id_itp" name="id_itp" value=""> -->
                                            <table id="tbl_item_selected" class="table table-bordered table-striped table-responsive" width="100%">
                                              <thead>
                                                <tr>
                                                  <th>No</th>
                                                  <th><?= lang("Deskripsi", "Description") ?></th>
                                                  <th><?= lang("Estimate ITP Ammount", "Estimate ITP Ammount") ?></th>
                                                  <th><?= lang("Remark", "Remark") ?></th>
                                                  <th><?= lang("Aksi", "Action") ?></th>
                                                </tr>
                                              </thead>
                                              <tbody id="item_selected">

                                              </tbody>
                                            </table>
                                            <div class="col-sm-12">
                                              <!-- <h2 class="m-b-md"><?= lang("Catatan :", "Note :"); ?></h2>
                                              <textarea class="form-control" id="descTextarea" rows="3" name="note" placeholder="Write Note Here" readonly></textarea> -->
                                              <input type="hidden" id="descTextarea" name="note">
                                            </div>
                                          </div>
                                      </fieldset>
                                      <br>
                                      <fieldset id="bagian2" class="col-12">
                                          <h2 class="m-b"><?= lang("File Attachment", "File Attachment"); ?></h2>
                                          <div class="row">
                                            <table id="tbl_attch" class="table table-bordered table-striped table-responsive" width="100%">
                                              <thead>
                                                <tr>
                                                  <th><?= lang("Tipe", "Type") ?></th>
                                                  <th><?= lang("Nama File", "File Name") ?></th>
                                                  <th><?= lang("Uploaded At", "Uploaded At") ?></th>
                                                  <th><?= lang("Lihat File", "View File") ?></th>
                                                  <th><?= lang("Aksi", "Action") ?></th>
                                                </tr>
                                              </thead>
                                              <tbody id="get_attch">

                                              </tbody>
                                            </table>
                                          </div>
                                          <br>
                                          <div class="form-group col-12 mb-2">
                                            <div data-repeater-list="repeater-list">
                                              <div data-repeater-list="repeater-list">
                                                <div data-repeater-item="" style="" id="file-repeater">
                                                  <div class="row mb-1 ">
                                                    <div class="col-9 col-xl-10">
                                                      <label class="file center-block">
                                                        <input style="width: fit-content;" class="form-control" type="file" name="file_attch[]" id="file" disabled>
                                                        <span class="file-custom"></span>
                                                      </label>
                                                    </div>
                                                    <div class="col-2 col-xl-1">
                                                      <!-- <button type="button" data-repeater-delete="" class="btn btn-icon btn-danger mr-1 remove_attch"><i class="fa fa-times"></i></button> -->
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <button type="button" data-repeater-create="" class="btn btn-primary add_attch">
                                              <i class="fa fa-plus"></i> Add new file
                                            </button>
                                        </div>
                                      </fieldset>

                                </div>
                            </div>
                        </div>
                        <!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('Tutup', 'Close') ?></button>
                    <button type="button" data-id="" data-code="" id="procesreject" data-toggle="modal" data-target="#modal_rej" class="btn btn-danger" title="Reject">Reject</button>
                    <button type="submit" class="btn btn-primary" id="save"><?= lang('Proses', 'Process') ?></button>
                </div>
              </form>
        </div>
    </div>
</div>

<!--reject-->
<div id="modal_rej" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <form class=" modal-content" id="reject_mdl">
            <div class="modal-header">
                <?= lang("Tolak Data", "Reject Data") ?>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="edit-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <input type="hidden" name="id_rej" id="id_rej" value="">
                    <input type="hidden" name="id_itp_rej" id="id_itp_rej" value="">
                    <input type="hidden" name="user_roles_rej" id="user_roles_rej" value="">
                    <input type="hidden" name="email_approve_rej" id="email_approve_rej" value="">
                    <input type="hidden" name="edit_content_rej" id="edit_content_rej" value="">
                    <input type="hidden" name="email_reject_rej" id="email_reject_rej" value="">
                    <input type="hidden" name="sequence_rej" id="sequence_rej" value="">
                    <input type="hidden" name="status_approve_rej" id="status_approve_rej" value="">
                    <input type="hidden" name="reject_step_rej" id="reject_step_rej" value="">

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label" for="field-1"><?= lang("Catatan", "Note") ?></label>
                            <label id="label_kirim" class="control-label" for="field-1" style="color:rgb(217, 83, 79)">*</label>
                            <textarea placeholder="Isi komentar anda" class="form-control" rows="5" id="note" name="note" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal"><?= lang("Batal", "Cancel") ?></button>
                <button type="submit" class="btn btn-danger"><?= lang("Tolak Data", "Reject Data") ?></button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<!-- <script src="<?= base_url()?>ast11/app-assets/js/scripts/forms/wizard-steps.js" type="text/javascript"></script> -->

<script type="text/javascript">
  $(document).ready(function() {
    // $("#save").hide();
    $(".itp_agrement").hide();
    var arr_file = new Array();

    // $("#itp_list").hide();
    // $("#itp_doc").on('click', function(e) {
    //   // e.preventDefault();
    //   // $(this).hide();
    //   $(".list_progress").hide();
    //   $(".itp_agrement").show();
    // });
    //
    //
    // $("#itp_progres").on('click', function(e) {
    //   // e.preventDefault();
    //   // $(this).hide();
    //   $(".list_progress").show();
    //   $(".itp_agrement").hide();
    // });

    var form = $(".steps-validation").show();
    $(".number-tab-steps").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: 'Submit'
        },
        onFinished: function (event, currentIndex) {
            alert("Form submitted.");
        }
    });

    // Show form
    var form = $(".steps-validation").show();

    $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: 'Submit'
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age-2").val()) < 18)
            {
                return false;
            }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex)
            {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            $("li a:contains(Submit)").hide();
            // $("#save").show();
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });

    // Initialize validation
    $(".steps-validation").validate({
        ignore: 'input[type=hidden]', // ignore hidden fields
        errorClass: 'danger',
        successClass: 'success',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        rules: {
            email: {
                email: true
            }
        }
    });



    ////////////////////////////////////////////////////////////////// hole process /////////////////////////////////////////////////////////////////////////////
    $(document).on('show.bs.modal', '#myModal', function(e){
      // e.preventDefault();
      $('#myModal .modal-header').css("background", "#1c84c6");
      $('#myModal .modal-header').css("color", "#fff");

      var xmodalx = modal_start($("#myModal").find(".modal-content"));

      while(arr_file.length > 0) {
          arr_file.pop();
      }

      var idnya = $(e.relatedTarget).data("id");
      var code = $(e.relatedTarget).data("code");
      $("#procesreject").attr('data-id', idnya);
      $("#procesreject").attr('data-code', code);
      var result;
      var speding = 0;
      document.getElementById("itp_form").reset();

      $("#get_item_selection").find('tr').remove();
      $("#item_selected").find('tr').remove();
      $("#get_attch").find('tr').remove();
      $(".data-repeater").remove();
      $("#id_itp").val(idnya);


      var al = code.split("|");
      $("#sequence").val(al[6]);
      $("#idx").val(al[0]);
      $("#id_itp").val(al[1]);
      $("#user_roles").val(al[2]);
      $("#email_approve").val(al[3]);
      $("#edit_content").val(al[4]);

      if (al[7] == 2) {
        $("#procesreject").hide();
        $("#save").hide();
      } else {
        $("#procesreject").show();
        $("#save").show();
      }
      // alert(idnya);
      $.ajax({
        url: '<?= base_url('procurement/Perform_itp_approval/get_item_selection') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {idnya: idnya}
      })
      .done(function() {
        result = true;
      })
      .fail(function() {
        result = false;
      })
      .always(function(res) {
        modal_stop(xmodalx)
        if (result == true) {
          var no = 0;
          var str = '';
          var total_value = [];
          var total_spending = [];
          var total_remaining = [];
          $("#vendor").val(res[0].vendor)
          $("#id_vendor").val(res[0].id_vendor)
          $("#agrm_no").val(res[0].no_po)
          $("#contractor_htm").html(res[0].vendor)
          $("#agreement_htm").html(res[0].no_po)
          $("#vendor_name").val($("#vendor").val())
          $("#po_number").val($("#agrm_no").val())
          $("#comp_htm").html(res[0].dt_comp.company_desc)
          $("#dept_htm").html(res[0].dt_comp.DEPARTMENT_DESC)

          $.each(res, function(index, el) {
            no++;
            var total_harga = el.priceunit*el.qty;

            total_value.push(parseInt(total_harga));
            total_spending.push(parseInt(speding));
            total_remaining.push(parseInt(total_harga));
                str = '<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+el.MATERIAL_NAME+'</td>'+
                        '<td><input type="hidden" id="qty'+el.MATERIAL+'" value="'+el.qty+'" />'+el.qty+'</td>'+
                        '<td>'+el.priceunit+'</td>'+
                        '<td><input id="total_harga'+el.MATERIAL+'" style="width: fit-content;" class="form-control" type="text" value="'+numeral(parseInt(total_harga)).format('0,0')+'" readonly /></td>'+
                        '<td><input id="spending'+el.MATERIAL+'" style="width: fit-content;" class="form-control tdspending" type="text" value="'+numeral(speding).format('0,0')+'" readonly /></td>'+
                        '<td><input id="total_spending'+el.MATERIAL+'" style="width: fit-content;" class="form-control tdremaining" name="total_spending[]" type="text" value="'+numeral(parseInt(total_harga)).format('0,0')+'" readonly /></td>'+
                        '<td><button type="button" data-id="'+el.MATERIAL+'" onClick="get_id('+el.MATERIAL+', \''+el.id_itemtype+'\', \''+el.MATERIAL_NAME+'\', '+el.qty+', \''+el.UOM1+'\', '+el.priceunit+', '+total_harga+')" class="btn btn-sm btn-default checklist_item'+el.MATERIAL+'" ><i class="fa fa-check"></i></button></td>'+
                      '</tr>';
            $("#get_item_selection").append(str);

            setTimeout(function(){
              if (al[4] == 1) {
                $(".add_attch").prop('disabled', true);
                $("#qty2"+el.MATERIAL).prop('readonly', true);
                $("#descTextarea").prop('readonly', true);
                $("#file").prop('disabled', true);
                $(".remove_item"+el.MATERIAL).prop('disabled', true);
                $(".checklist_item"+el.MATERIAL).prop('disabled', true);
                $(".spending2"+el.MATERIAL).prop('disabled', true);
                $(".remove_item"+el.MATERIAL).prop('disabled', true);
                // $("#save").hide();
                $("#date_itp").attr('disabled', true);
                console.log("on");
              } else {
                console.log("off");
                $(".add_attch").prop('disabled', true);
                $("#qty2"+el.MATERIAL).prop('readonly', true);
                $("#descTextarea").prop('readonly', true);
                $("#file").prop('disabled', true);
                $(".remove_item"+el.MATERIAL).prop('disabled', true);
                $(".checklist_item"+el.MATERIAL).prop('disabled', true);
                $(".spending2"+el.MATERIAL).prop('disabled', true);
                $(".remove_item"+el.MATERIAL).prop('disabled', true);
                // $("#save").show();
                $("#date_itp").attr('disabled', true);
              }
            },100);
          });

          var str2 = '<tr style="font-weight:bold;">'+
                        '<td bgcolor="#f4f6f9"></td>'+
                        '<td bgcolor="#f4f6f9"></td>'+
                        '<td bgcolor="#f4f6f9"></td>'+
                        '<td bgcolor="#f4f6f9">TOTAL</td>'+
                        '<td bgcolor="white">'+numeral(total_value.reduce(getSum)).format('0,0')+'</td>'+
                        '<td bgcolor="white"><input style="width: fit-content;" class="form-control" type="text" id="total_spending" onChange="change_total()" value="'+numeral(total_spending.reduce(getSum)).format('0,0')+'" readonly></td>'+
                        '<td bgcolor="white"><input style="width: fit-content;" class="form-control" type="text" id="total_remaining" onChange="change_total()" value="'+numeral(total_remaining.reduce(getSum)).format('0,0')+'" readonly></td>'+
                        '<td bgcolor="white"></td>'+
                      '</tr>';
          $("#get_item_selection").append(str2);
        }

      });

      $("#descTextarea").val("");
      // show itp data
      $.ajax({
        url: '<?=base_url('procurement/Perform_itp_approval/show_data_itp')?>',
        type: 'POST',
        dataType: 'json',
        data: {msr_no: idnya}
      })
      .done(function() {
        result = true;
      })
      .fail(function() {
        result = false;
      })
      .always(function(res) {
        if (result = true) {
          $("#descTextarea").val(res.itp.note);
          $("#date_itp").val(res.itp.dated);

          var no = 0;
          $.each(res.itp_detail, function(index, el) {
            no++;
            get_id(el.data_itp_detail.material_id, el.data_itp_detail.id_itemtype, el.data_itp_detail.MATERIAL_NAME, el.data_itp_detail.qty, el.data_itp_detail.uom, el.data_itp_detail.priceunit, el.data_itp_detail.total, no, el.data_itp_detail.remark);
            console.log(el.data_itp_detail.material_id);
          });
          $.each(res.itp_upload, function(indexx, dul) {
            if (dul.data_itp_upload.filename == '-') {
              var vfile = '';
            } else {
              var vfile = '<a href="<?= base_url('upload/ITP/')?>'+dul.data_itp_upload.filename+'" target="_blank"> View File</a>';
            }

            if (al[4] == 1) {
              var vrm_btn = '<button type="button" data-id="'+dul.data_itp_upload.filename+'" id="rm_file" class="btn btn-sm btn-danger btn-block">Remove</button>';
            } else {
              var vrm_btn = '-';
            }
            var get_attch = '<tr>'+
                        '<td>'+dul.data_itp_upload.type+'</td>'+
                        '<td>'+dul.data_itp_upload.filename+'</td>'+
                        '<td>'+dul.data_itp_upload.created_date+'</td>'+
                        '<td>'+vfile+'</td>'+
                        '<td> '+vrm_btn+' </td>'+
                      '</tr>';
            $("#get_attch").append(get_attch);
          });
        }

      });

    });

    $(document).on('click', '#remove_item', function(e) {
    // e.preventDefault();
    // var itemid = $(e.relatedTarget).data("id");
    var itemid = $(this).data("id");
    $(this).closest('tr').remove();
    console.log(itemid);
    $(".checklist_item"+itemid).prop("disabled", false);
    $(".checklist_item"+itemid).css({"background-color": "#dddddd", "color": "black"});
    });

    $(document).on('click', '.add_attch', function(e) {
      // e.preventDefault();
      var str = '<div class="row mb-1 data-repeater">'+
        '<div class="col-9 col-xl-10">'+
          '<label class="file center-block">'+
            '<input style="width: fit-content;" class="form-control" type="file" name="file_attch[]" id="file">'+
            '<span class="file-custom"></span>'+
          '</label>'+
        '</div>'+
        '<div class="col-2 col-xl-1">'+
          '<button type="button" data-repeater-delete="" class="btn btn-icon btn-danger mr-1 remove_attch"><i class="fa fa-times" disabled></i></button>'+
        '</div>'+
      '</div>';
      $("#file-repeater").append(str);
    });

    $(document).on('click', '.remove_attch', function(e) {
      // e.preventDefault();
      if (confirm('Are you sure you want to remove this item?')) {
      $(this).closest('.data-repeater').remove();
    }
    });

    $(document).on('click', '#rm_file', function(e) {
      // e.preventDefault();
      // arr_file.length = 0;

      var idnya = $(this).data("id");
      $(this).closest('tr').remove();

      arr_file.push(idnya);
      console.log(arr_file);
    });

    $("#itp_form").submit(function(e){
      e.preventDefault();
      var xmodalx = modal_start($("#myModal").find(".modal-content"));

      var data = new FormData(this);
      for (var i = 0; i < arr_file.length; i++) {
        // formData.append('arr[]', arr[i]);
        data.append('rm_file[]', arr_file[i]);
      }

      var resultx;
      // console.log(data);
      $.ajax({
        url: '<?= base_url('procurement/Perform_itp_approval/itp_doc_approval')?>',
        type: 'POST',
        dataType: 'JSON',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
      })
      .done(function() {
        resultx = true;
      })
      .fail(function() {
        resultx = false;
      })
      .always(function(res) {
        if (resultx == true) {
          modal_stop(xmodalx);
          console.log(res);
          console.log(data);
          swal({
                  title: "Done",
                  text: "Data is successfuly saved.",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  confirmButtonText: "Oke",
                  closeOnConfirm: false
              },function () {
                window.location.href = "<?= base_url()?>/procurement/perform_itp_approval";
          });
        } else {
          modal_stop(xmodalx);
          window.location.href = "<?= base_url()?>/procurement/perform_itp_approval";
        }
      });

    })

    // reject //
    $(document).on('show.bs.modal', '#modal_rej', function(e) {
      $("#myModal").modal("toggle");
      document.getElementById("reject_mdl").reset();
      var idnya = $(e.relatedTarget).data("id");
      var code = $(e.relatedTarget).data("code");
      $('#modal_rej .modal-header').css("background", "#d9534f");
      $('#modal_rej .modal-header').css("color", "#fff");

      var al = code.split("|");

      $("#id_rej").val(al[0]);
      $("#id_itp_rej").val(al[1]);
      $("#user_roles_rej").val(al[2]);
      $("#email_approve_rej").val(al[3]);
      $("#edit_content_rej").val(al[4]);
      $("#email_reject_rej").val(al[5]);
      $("#sequence_rej").val(al[6]);
      $("#status_approve_rej").val(al[7]);
      $("#reject_step_rej").val(al[8]);
      // console.log(al);

      $("#reject_mdl").submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        var result;
        var xmodalx = modal_start($("#modal_rej").find(".modal-content"));

        $.ajax({
          url: '<?= base_url("procurement/Perform_itp_approval/reject_itp_doc")?>',
          type: 'POST',
          dataType: 'JSON',
          data: data,
          cache: false,
          processData: false,
          contentType: false,
        })
        .done(function() {
          result = true;
        })
        .fail(function() {
          result = false;
        })
        .always(function(res) {
          if (result = true) {
            if (res = true) {
              modal_stop(xmodalx);
              swal({
                      title: "Done",
                      text: "ITP Document Rejected",
                      type: "success",
                      showCancelButton: false,
                      confirmButtonColor: "#3085d6",
                      confirmButtonText: "Oke",
                      closeOnConfirm: true
                  },function () {
                    window.location.href = "<?= base_url()?>/procurement/perform_itp_approval";
              });
            } else {
              window.location.href = "<?= base_url()?>/procurement/perform_itp_approval";
            }
          }
        });
      });

    });
    // reject //
    ////////////////////////////////////////////////////////////////// hole process /////////////////////////////////////////////////////////////////////////////




    // show data
    $('#tbl1 tfoot th').each(function (i) {
            var title = $('#tbl1 thead th').eq($(this).index()).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" data-index="' + i + '" />');
    });
    var table=$('#tbl1').DataTable({
        "ajax": {
            "url": "<?= base_url('procurement/Perform_itp_approval/datatable_msr_remaining') ?>",
            "dataSrc": ""
        },
        "data": null,
        "searching": true,
        "paging": true,
        "columns": [
          {title: "<center>No</center>"},
          {title: "<center><?= lang("No Persetujuan", "Agrement No") ?></center>"},
          {title: "<center><?= lang("Tipe", "Type") ?></center>"},
          {title: "<center><?= lang("Subjek Kerja", "Subject Work") ?></center>"},
          {title: "<center><?= lang("Contractor", "Contractor") ?></center>"},
          {title: "<center><?= lang("Matauang", "Currency") ?></center>"},
          {title: "<center><?= lang("Mulai Validasi", "Validity Start") ?></center>"},
          {title: "<center><?= lang("Selesai Validasi", "Validity End") ?></center>"},
          {title: "<center><?= lang("Aksi", "Action") ?></center>"}
        ],
        "columnDefs": [
            {"className": "dt-center", "targets": [0]},
            {"className": "dt-center", "targets": [1]},
            {"className": "dt-center", "targets": [2]},
            {"className": "dt-center", "targets": [3]},
            {"className": "dt-center", "targets": [4]},
            {"className": "dt-center", "targets": [5]},
            {"className": "dt-center", "targets": [6]},
            {"className": "dt-center", "targets": [7]},
            {"className": "dt-center", "targets": [8]},
        ]
    });
    $(table.table().container()).on('keyup', 'tfoot input', function () {
      table.column($(this).data('index')).search(this.value).draw();
    });

    // show data
    $('#tbl tfoot th').each(function (i) {
            var title = $('#tbl thead th').eq($(this).index()).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" data-index="' + i + '" />');
    });
    var table=$('#tbl').DataTable({
        "ajax": {
            "url": "<?= base_url('procurement/Perform_itp_approval/datatable_list_itp_on_progress') ?>",
            "dataSrc": ""
        },
        "data": null,
        "searching": true,
        "paging": true,
        "columns": [
          {title: "<center>No</center>"},
          {title: "<center><?= lang("No ITP", "ITP No") ?></center>"},
          {title: "<center><?= lang("PO Title", "PO Title") ?></center>"},
          {title: "<center><?= lang("Tanggal", "Create Date") ?></center>"},
          {title: "<center><?= lang("Status", "Status") ?></center>"},
          {title: "<center><?= lang("Aksi", "Action") ?></center>"}
        ],
        "columnDefs": [
            {"className": "dt-center", "targets": [0]},
            {"className": "dt-center", "targets": [1]},
            {"className": "dt-center", "targets": [2]},
            {"className": "dt-center", "targets": [3]},
            {"className": "dt-center", "targets": [4]},
            {"className": "dt-center", "targets": [5]},
        ]
    });
    $(table.table().container()).on('keyup', 'tfoot input', function () {
      table.column($(this).data('index')).search(this.value).draw();
    });

  });

  function get_id(id, type, desc, qty, uom, unitprice, total_harga, no, remark){
    // console.log(el);
    setTimeout(function(){
      $(".checklist_item"+id).prop("disabled", true);
      $(".checklist_item"+id).css({"background-color": "green", "color": "white"});
    },100);

    var str = '<tr>'+
                '<td><input style="width: fit-content;" class="form-control" type="hidden" name="material_id[]" value="'+id+'" readonly />'+no+'</td>'+
                '<td><input style="width: fit-content;" class="form-control" type="hidden" name="price_unit[]" value="'+unitprice+'" readonly />'+desc+'</td>'+
                '<td><input style="width: fit-content;" class="form-control" id="qty2'+id+'" type="hidden" name="item_qty[]" onKeyup="change('+id+', '+unitprice+', '+total_harga+')" value="'+qty+'" readonly required />'+qty+'</td>'+
                '<td><input style="width: fit-content;" class="form-control" id="spending2'+id+'" type="text" name="item_ammount[]" onChange="change('+id+', '+total_harga+')" value="'+total_harga+'" readonly required /></td>'+
                '<td><textarea class="form-control" name="remark[]" id="remark2'+id+'" rows="3" cols="60" placeholder="Input some note" disabled>'+remark+'</textarea></td>'+
                '<td><button type="button" data-id="'+id+'" id="remove_item" class="btn btn-sm btn-danger remove_item'+id+'">Remove</button></td>'+
              '</tr>';
    $("#item_selected").append(str);
    input_numberic('#spending2'+id, true);
  }

  function change(id, unitprice, total_hargax){
    var qty1 = $("#qty"+id).val();
    var qty2 = $("#qty2"+id).val();
    var ammount_itp = 0;
    if (parseInt(qty2) > parseInt(qty1)) {
      qty2 = $("#qty2"+id).change().val(0);
      ammount_itp = 0;
    } else {
      ammount_itp = parseInt(qty2)*parseInt(unitprice);
    }

    console.log(ammount_itp);
    var spending2 = $("#spending2"+id).val(ammount_itp);
    var total_harga = $("#total_harga"+id).val();
    var total_spending = total_harga-ammount_itp;

    // speding = ammount_itp;
    var total_spending = $("#total_spending"+id).val(total_spending);
    var spending = $("#spending"+id).val(ammount_itp);

    var sum_spending = 0;
    var sum_remaining = 0;
    // iterate through each td based on class and add the values
    $(".tdspending").each(function() {

        var value = $(this).val();
        // add only if the value is number
        if(!isNaN(value) && value.length != 0) {
            sum_spending += parseFloat(value);
        }
    });
    $(".tdremaining").each(function() {

        var value = $(this).val();
        // add only if the value is number
        if(!isNaN(value) && value.length != 0) {
            sum_remaining += parseFloat(value);
        }
    });

    $("#total_spending").val(sum_spending);
    $("#total_remaining").val(sum_remaining);
    // iterate through each td based on class and add the values
  }

  function change_total(){
    // var total_spending = $("#total_spending").val();
    // var total_remaining = $("#total_remaining").val();

  }

  function getSum(total, num) {
    return total + Math.round(num);
  }
</script>
