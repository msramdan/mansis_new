<section class="content-header">
      <h1>raker
        <small>Pemasok Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">raker</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> rakers</h3>
<!--             <div class="pull-right">
              <a href="<?=site_url('raker')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div> -->
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('raker/process')?>" method="post">
                  <div class="form-group ">
                    <label>Kode Karyawan*</label>
                    <input type="text" disabled="" name="raker_name" value="<?=$row->kd_karyawan?>" class="form-control "required >
                  </div>
                  <div class="form-group ">
                    <input type="hidden" name="id_ramdan" value="<?=$row->raker_id?>">
                    <input type="hidden" name="raker_name" value="<?=$row->karyawan_id?>" class="form-control "required>
                    <label>Nama Karyawan*</label>
                    <input type="text" disabled="" name="" value="<?=$row->nama_karyawan?>" class="form-control "required>
                  </div>
                   <div class="form-group ">
                    <label>Jobdesk*</label>
                    <input type="text" name="title" value="<?=$row->title?>" class="form-control " required>
                  </div>
                   <div class="form-group">
                    <label>Rencana Kerja*</label>
                    <textarea name="desk" class="form-control " required><?=$row->desk?></textarea>
                  </div>
                  <div class="form-group ">
                    <label>Tanggal Mulai*</label>
                    <input type="" disabled="" name="" value="<?=$row->tgl_mulai?>" class="form-control " required>
                  </div>
                  <div class="form-group">
                    <label>Status*</label>
                    <select name="status" class="form-control" value="<?=$row->status?>" required>
                    <option value="">- Pilih -</option>
                    <option value="Waiting" <?= $row->status =='Waiting' ? 'selected' : 'null' ?>>Waiting</option>
                    <option value="On Progress" <?= $row->status =='On Progress' ? 'selected' : 'null' ?>>On Progress</option>
                    <option value="Complate" <?= $row->status =='Complate' ? 'selected' : 'null' ?>>Complate</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Evaluasi</label>
                    <textarea name="note" class="form-control " rows="5" ><?=$row->note?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Soluasi</label>
                    <textarea name="solusi" class="form-control " rows="5" ><?=$row->solusi?></textarea>
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