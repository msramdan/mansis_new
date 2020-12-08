<?php if ($this->uri->segment(3) == $this->fungsi->user_login()->perusahaan_id || $this->fungsi->user_login()->level ==1  ) { ?>
<section class="content-header">
  <h1>Raker
    <small>Rencana Kerja</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Raker</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data raker</h3>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Karyawan</th>
            <th>Jobdesk</th>
            <th>Rencana Kerja</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Evaluasi</th>
            <th>Solusi</th>
            <th>Photo</th>
            <th>Nilai</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>

      </table>

    </div>

</section>

<script>
  $(document).ready(function() {
    tampil_data_raker();
  })
</script>

<div class="modal fade" id="modal-detail" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <center>
        <!-- <p id="pesan" style="color: red"></p> -->
      </center>

      <table class="table">
        <input type="hidden" name="raker_id" id="raker_id" value="" class="form-control">
        <tr>
          <td>Soluasi</td>
          <td><textarea name="solusi" id="solusi" rows="8" class="form-control"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="button" id="btn_simpan" onclick="tambahdata()" class="btn btn-primary">Tambah</button>
            <button type="button" id="btn_ubah" onclick="editdata()" class="btn btn-primary">Submit</button>
            <button type="button" data-dismiss="modal" class="btn btn-danger">Batal</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

<!-- modal evaluasi -->
<div class="modal fade" id="modal-evaluasi" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <center>
        <!-- <p id="pesan" style="color: red"></p> -->
      </center>

      <table class="table">
        <input type="hidden" name="raker_id" id="raker_id" value="" class="form-control">
        <tr>
          <td>Evaluasi</td>
          <td><textarea name="note" id="note" rows="8" class="form-control"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="button" id="btn_simpan2" onclick="tambahdata()" class="btn btn-primary">Tambah</button>
            <button type="button" id="btn_ubah2" onclick="ramdan()" class="btn btn-primary">Submit</button>
            <button type="button" data-dismiss="modal" class="btn btn-danger">Batal</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

<!-- <script type="text/javascript">
        $(document).on('click','#detail',function(){
          var note = $(this).data('note');
          $('#note').text(note);
        })
    </script> -->

<script type="text/javascript">
  function tampil_data_raker() {
    $('#table1').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= site_url('raker/get_ajax') ?>",
        data: {
          'karyawan_id': <?php echo $this->uri->segment(3) ?>
        },
        "type": "POST"
      }

    });

  }



  function submit_tombol(type_button) {
    if (type_button == 'tambah') {
      $('#btn_simpan').show();
      $('#btn_ubah').hide();
    } else {
      $('#btn_simpan').hide();
      $('#btn_ubah').show();

      $.ajax({
        type: 'POST',
        data: 'raker_id=' + type_button,
        url: '<?php echo base_url('raker/get_by_id') ?>',
        dataType: 'json',
        success: function(data) {
          $('[name="raker_id"]').val(data[0].raker_id);
          $('[name="solusi"]').val(data[0].solusi); // jika banyak field tinggal tambahkan di sini
        }

      });
    }
  }

    function submit_evaluasi(type_button) {
    if (type_button == 'tambah') {
      $('#btn_simpan2').show();
      $('#btn_ubah2').hide();
    } else {
      $('#btn_simpan2').hide();
      $('#btn_ubah2').show();

      $.ajax({
        type: 'POST',
        data: 'raker_id=' + type_button,
        url: '<?php echo base_url('raker/get_by_id') ?>',
        dataType: 'json',
        success: function(data) {
          $('[name="raker_id"]').val(data[0].raker_id);
          $('[name="note"]').val(data[0].note);
        }

      });
    }
  }

  function ramdan() {
    var raker_id = $('#raker_id').val();
    var note = $('#note').val();
    $.ajax({
      type: 'POST',
      data: {
        raker_id: raker_id,
        note: note
      },
      url: '<?php echo base_url('raker/ubahevaluasi') ?>',
      dataType: 'json',
      success: function(data) {
        $("#pesan").html(data.pesan); // cari yang ber #id pesan maka di tambahkan didalam nya denhan data.pesan (pesan dari ctrl pesan)
        if (data.pesan == '') {
          $('#modal-evaluasi').modal('hide');
          $('#table1').DataTable().clear();
          $('#table1').DataTable().destroy();
          tampil_data_raker();
          $('[name="note"]').val("");
        }
      }
    })

  }

  function editdata() {
    var raker_id = $('#raker_id').val();
    var solusi = $('#solusi').val();
    $.ajax({
      type: 'POST',
      data: {
        raker_id: raker_id,
        solusi: solusi
      },
      url: '<?php echo base_url('raker/ubahdata') ?>',
      dataType: 'json',
      success: function(data) {
        $("#pesan").html(data.pesan); // cari yang ber #id pesan maka di tambahkan didalam nya denhan data.pesan (pesan dari ctrl pesan)
        if (data.pesan == '') {
          $('#modal-detail').modal('hide');
          // tampil_data_user_level();
          $('#table1').DataTable().clear();
          $('#table1').DataTable().destroy();
          tampil_data_raker();
          $('[name="solusi"]').val("");
        }
      }
    })

  }


</script>

    <?php }else{
  redirect('auth/blocked');
 }