<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
                <h3 class="content-header-title"><?= lang("Master Job Title", "Master Job Title") ?></h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/home/">Home</a></li>
                        <li class="breadcrumb-item active"><?= lang("Pengaturan", "Setting") ?></li>
                        <li class="breadcrumb-item active"><?= lang("Master Job Title", "Master Job Title") ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-body">
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
                                      <button class="btn btn-outline-success" onclick="add()"><i class="fa fa-plus-circle"></i> <?=lang("Tambah data","CREATE")?></button>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>


                      <div class="card-content collapse show">
                          <div class="card-body card-dashboard">
                              <div class="row">
                                  <div class="col-md-12">
                                      <table id="tbl" class="table table-striped table-bordered table-fixed-column order-column dataex-lr-fixedcolumns table-hover display" width="100%">

                                          <tfoot>
                                              <tr>
                                                  <th><center>No</center></th>
                                                  <th><center>desc</center></th>
                                                  <th><center>status</center></th>
                                                  <th><center>Action</center></th>
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
        </div>
  </div>
</div>



<!--change data-->
<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class=" modal-content">
        <form id="formtambah" class="form-horizontal">
            <!--hide value-->
            <input type="hidden" name="idaccsub" id="idaccsub" value="">
            <!--end hide value-->
            <div class="modal-header bg-primary white">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id" maxlength="6" class="form-control" required>
                <div class="form-group">
                    <label class="form-label"><?= lang("Job Title Deskripsi", "Job Title Description") ?></label>
                    <div class="controls">
                        <input type="text" name="acc_desc" id="acc_desc" class="form-control" maxlength="40" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="controls">
                        <div class="col-sm-10">
                            <input type="radio" value="1" name="status" id="aktif"> <i></i><?= lang('Aktif', 'Active') ?>
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" value="0" name="status" id="nonaktif"> <i></i><?= lang('Nonaktif', 'Nonactive') ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('Tutup', 'Close') ?></button>
                <button type="submit" class="btn btn-primary" id="save"><?= lang('Simpan', 'Submit') ?></button>
            </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $(document).on('submit', '#formtambah', function (e) {
    e.preventDefault();
    $.ajax({
      url: '<?= base_url('setting/Job_title/add'); ?>',
      dataType: 'json',
      type: 'POST',
      data: $(this).serialize(),
      success: function (res) {
        console.log(res);
        if (res.success == 1) {
          $('#modal').modal('hide');
          $('#tbl').DataTable().ajax.reload();
          msg_info('Success Save');
        } else if(res.success == 2){
          msg_danger("Kode Sudah Terpakai");
        } else {
          msg_danger("Something wrong, Please Call The Admin");
        }
      }
    });
  });

});

    function add() {
      document.getElementById("formtambah").reset();
      $("#idaccsub").val("");
      $('.modal-title').html("<?= lang("Tambah Data", "Add Data") ?>");
      $('#modal').modal('show');
      document.getElementById("aktif").checked = true;
      lang();
    }

    function update(id) {
    $("#idaccsub").val(id);
    $.ajax({
    type: 'GET',
    url: '<?= base_url('setting/Job_title/get/') ?>' + id,
    success: function (res) {
        $('.modal-title').html("<?= lang("Edit Data", "Update Data") ?>");
        // console.log(id);
        var res = res.replace("[", "");
        var res = res.replace("]", "");
        var d = JSON.parse(res);
        $('#id').val(d.id);
        $('#acc_desc').val(d.description);
        if (d.status == "1"){
          document.getElementById("aktif").checked = true;
        } else {
          document.getElementById("nonaktif").checked = true;
        }
        $('#modal').modal('show');
        lang();
      }
    });
  }

    $('#tbl tfoot th').each( function (i) {
      var title = $('#tbl thead th').eq($(this).index()).text();
      if ($(this).text() == 'No') {
        $(this).html('');
      } else if ($(this).text() == 'Action') {
        $(this).html('');
      } else {
        $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" data-index="' + i + '" />');
      }
    });
    lang();

    var table=$('#tbl').DataTable({
      ajax: {
          url: '<?= base_url('setting/Job_title/show') ?>',
          dataSrc: ''
      },
      scrollX: true,
      scrollY: '300px',
      scrollCollapse: true,
      paging: true,
      filter: true,
      info:true,
      columns: [
          {title: "<center>No</center>"},
          {title: "<center><?= lang('Job Title Deskripsi', 'Job Title Description') ?></center>"},
          {title: "<center><?= lang("Status", "Status") ?></center>", "width": "50px"},
          {title: "<center>Action</center>", "width": "50px"},
      ],
      "columnDefs": [
        {"className": "dt-center", "targets": [0]},
        {"className": "dt-center", "targets": [1]},
        {"className": "dt-center", "targets": [2]},
        {"className": "dt-center", "targets": [3]},
      ]
    });
    $(table.table().container() ).on( 'keyup', 'tfoot input', function () {
            table.column( $(this).data('index') )
            .search( this.value )
            .draw();
    });
    lang();

</script>
