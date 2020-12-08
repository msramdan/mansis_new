<?php if ($this->uri->segment(3) == $this->fungsi->user_login()->perusahaan_id || $this->fungsi->user_login()->level ==1 ) { ?>
  <section class="content-header">
      <h1>karyawan
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">karyawan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> karyawan</h3>
            <div class="pull-right">
          </div>
          <div class="box-body ">
          <div class="row">
            <div class="col-md-6">
            <form action="<?=site_url('karyawan/process/'.$this->uri->segment(3))?>" method="post" enctype="multipart/form-data" role="form">
              <div class="form-group ">
                    <input type="hidden" name="karyawan_id" value="<?=$row->karyawan_id?>">
                    <label>Kode Karyawan</label>
                    <input type="text" name="kd_karyawan" value="<?=$row->kd_karyawan?>" class="form-control ">
                  </div>
              <div class="form-group ">
                    <label>Nama Karyawan</label>
                    <input type="text" name="name" value="<?=$row->name?>" class="form-control ">
                  </div>
              <div class="form-group ">
                    <label>KTP </label>
                    <input type="text" name="ktp" value="<?=$row->ktp?>" class="form-control ">
                  </div>
              <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jk_kelamin" class="form-control" value="<?=$row->jk_kelamin?>" >
                    <option value="">- Pilih -</option>
                    <option value="Laki Laki" <?= $row->jk_kelamin =='Laki Laki' ? 'selected' : 'null' ?>>Laki Laki</option>
                    <option value="Perempuan" <?= $row->jk_kelamin =='Perempuan' ? 'selected' : 'null' ?>>Perempuan</option>
                    </select>
                  </div>

               <div class="form-group ">
                    <label for="status_id">Status Karyawan</label>
                    <select name="status_id" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($status as $key => $data) { ?>
                         <?php if ($row->status_id==$data->status_id) { ?>
                        <option value="<?php echo $data->status_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->status_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>

              <div class="form-group ">
                    <label>Tanggal Masuk Kerja </label>
                    <input type="date" name="tgl_masuk" value="<?=$row->tgl_masuk?>" class="form-control ">
                  </div>
                  <div class="form-group ">
                    <label for="status_id">Nama Bank</label>
                    <select name="bank_id" class="form-control" ="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($bank as $key => $data) { ?>
                         <?php if ($row->bank_id==$data->bank_id) { ?>
                        <option value="<?php echo $data->bank_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->bank_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                <div class="form-group ">
                    <label>No Rekening</label>
                    <input type="number" name="no_rek" id="no_rek" value="<?=$row->no_rek?>" class="form-control ">
                  </div> 
                  <?php if ($page=='add') { ?>
                    <div class="form-group ">
                    <label>Photo </label>
                    <input type="file" name="photo" id="photo" value="" class="form-control " required="">
                  </div>
                  <?php }else{ ?>
                    <div class="form-group">
                      <img width="200" height="200" src="<?php echo base_url();?>assets/img/karyawan/<?=$row->photo?>">
                      <input required="" type="hidden" name="gambar_lama" value="<?=$row->photo?>">
                      <input readonly="" type="file" class="form-control" name="photo" id="phone">
                      <p class="help-block" style="color: #FF0000;">Pilih Photo Jika Ingin Merubah Photo Profile</p>
                    </div >
                  <?php } ?>  
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?=$row->alamat?>" class="form-control ">
                  </div>
              <div class="form-group ">
                    <label>No Telfon</label>
                    <input type="text" name="phone" value="<?=$row->phone?>" class="form-control ">
                  </div>
               <div class="form-group">
                    <label>Pendidikan</label>
                    <select name="pendidikan" class="form-control" value="<?=$row->pendidikan?>" >
                    <option value="">- Pilih -</option>
                    <option value="SMP" <?= $row->pendidikan =='SMP' ? 'selected' : 'null' ?>>SMP</option>
                    <option value="SMA/SMK" <?= $row->pendidikan =='SMA/SMK' ? 'selected' : 'null' ?>>SMA/SMK</option>
                    <option value="D3" <?= $row->pendidikan =='D3' ? 'selected' : 'null' ?>>D3</option>
                    <option value="S1" <?= $row->pendidikan =='S1' ? 'selected' : 'null' ?>>S1</option>
                    <option value="S2" <?= $row->pendidikan =='S2' ? 'selected' : 'null' ?>>S2</option>
                    </select>
                  </div>
              <div class="form-group ">
                    <label for="jabatan_id">Jabatan</label>
                    <select name="jabatan_id" class="form-control" required="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($jabatan as $key => $data) { ?>
                         <?php if ($row->jabatan_id==$data->jabatan_id) { ?>
                        <option value="<?php echo $data->jabatan_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->jabatan_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
              <?php if($this->fungsi->user_login()->level==1){?>
              <div class="form-group ">
                    <label for="perusahaan_id">Perusahaan</label>
                    <select name="perusahaan_id" class="form-control" required="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($perusahaan as $key => $data) { ?>
                         <?php if ($row->perusahaan_id==$data->perusahaan_id) { ?>
                        <option value="<?php echo $data->perusahaan_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->perusahaan_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                <?php }else{ ?>
                    <input type="hidden" name="perusahaan_id" value="<?= $this->fungsi->user_login()->perusahaan_id?>" class="form-control ">
                <?php } ?>
              
                  <div class="form-group ">
                    <label>Phone Saudara</label>
                    <input type="text" name="phone_saudara" value="<?=$row->phone_saudara?>" class="form-control ">
                  </div>
                  <div class="form-group ">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" id="gaji_pokok" value="<?=$row->gaji_pokok?>" class="form-control ">
                  </div>
                  <div class="form-group ">
                    <label>Jumlah Jam Kerja/bulan</label>
                    <input type="number" name="jam_kerja" id="jam_kerja" value="<?=$row->jam_kerja?>" class="form-control ">
                  </div>
                  <div class="form-group ">
                    <label>Rate Gaji/Jam</label>
                    <input readonly="" type="number" name="rate_gaji" id="rate_gaji" value="<?=$row->rate_gaji?>" class="form-control ">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="<?=$page?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
                    <button type="reset" class="btn btn">Reset</button>
                  </div>
                  <div class="card-footer small text-danger">
                     Wajib diisi
                  </div>
                </div>
              </form>

    </section>
    <script type="text/javascript">


        function calculate(){
            var gaji_pokok = $('#gaji_pokok').val();
            var jam_kerja = $('#jam_kerja').val();
            var jam_kerja = $('#jam_kerja').val();
            jam_kerja !=0 ? $('#rate_gaji').val(gaji_pokok / jam_kerja) : $('#rate_gaji').val(0)
        }

        $(document).ready(function(){ 
            calculate()
        })

        $(document).on('keyup mouseup','#gaji_pokok,#jam_kerja',function(){
            calculate()
        })
      
    </script>


<?php }else{
  redirect('auth/blocked');
 }



   