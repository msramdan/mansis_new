<section class="content-header">
      <h1>kasbon
        <small>Pemasok Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">kasbon</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> kasbons</h3>
            <div class="pull-right">
              <a href="<?=site_url('kasbon')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('kasbon/process')?>" method="post">
                  <div class="form-group ">
                    <label for="barcode">Nama Karyawan</label>
                  </div>
                  <div class="form-group input-group">
                    <input type="hidden" name="id_ramdan" value="<?=$row->kasbon_id?>">
                    <input type="hidden" name="karyawan_id" id="karyawan_id" class="form-control " value="<?=$row->karyawan_id?>" required>


                    <input type="text" readonly="" name="nama_karyawan" value="<?=$row->name?>" id="nama_karyawan" class="form-control" required="" autofocus="">
                    
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div>

                  <div class="form-group ">
                    <label>Kode Karyawan</label>
                    <input type="text" id="kd_karyawan" value="<?=$row->kd_karyawan?>"  name="kd_karyawan" value="" class="form-control "  readonly="">
                  </div>
                   <div class="form-group ">
                    <label>Besar Uang</label>
                    <input type="number" name="besar_uang" value="<?=$row->besar_uang?>" class="form-control " required>
                  </div>
                  <div class="form-group ">
                    <label>Tanggal Kasbon</label>
                    <input type="date" name="tanggal" value="<?=$row->tanggal?>" class="form-control " required>
                  </div>
                  <div class="form-group ">
                    <label>Deskripsi</label>
                    <textarea name="desk" class="form-control "><?=$row->desk?></textarea>
                  </div>


                  <div class="form-group">
                    <button type="submit" name="<?=$page?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
                    <button type="reset" class="btn btn">Reset</button>
                  </div>
                  <div class="card-footer small text-danger">
                    * Wajib diisi
                  </div>
                </form>
                
              </div>
              
            </div>
            
            
          </div>

    </section>

        <div class="modal fade" id="modal-item">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Select Data Karyawan</h4>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>Kode Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>Jabatan</th>
                  <th>Perusahaan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($karyawan as $key => $data) { ?>
                    <tr>
                      <td><?= $data->kd_karyawan ?></td>
                      <td><?= $data->name ?></td>
                      <td><?= $data->nama_jabatan ?></td>
                      <td><?= $data->nama_perusahaan ?></td>
                      <td>
                        <button class="btn btn-xs btn-info" id="select"
                          data-id="<?php echo $data->karyawan_id ?>"
                          data-name="<?php echo $data->name ?>"
                          data-kd_karyawan="<?php echo $data->kd_karyawan ?>">

                          <i class="fa fa-check"></i> Select
                        </button>
                      </td>
                    </tr>
                  <?php } ?>
                  

                
              </tbody>
            </table>
            
            
          </div>
          
        </div>
      </div>
      
    </div>

        <script>
      $(document).ready(function(){
        $(document).on('click','#select',function(){
          var karyawan_id = $(this).data('id');
          var name = $(this).data('name');
          var kd_karyawan = $(this).data('kd_karyawan');
          $('#karyawan_id').val(karyawan_id);
          $('#nama_karyawan').val(name);
          $('#kd_karyawan').val(kd_karyawan);

          $('#modal-item').modal('hide');
        })
      })
    </script>