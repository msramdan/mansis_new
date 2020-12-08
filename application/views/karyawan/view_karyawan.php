

<?php if ($this->uri->segment(3) == $this->fungsi->user_login()->perusahaan_id || $this->fungsi->user_login()->level ==1  ) { ?>
<section class="content-header">
      <h1>karyawans
        <small>Data Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">karyawans</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data karyawans</h3>
            <div class="pull-right">
              <a href="<?=site_url('Karyawan/add/' .$this->uri->segment(3))?>" class="btn btn-primary btn-flat">
                <i class="fa fa-plus"></i>Create Data Karyawan
              </a>
            </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama</th>
                  <th>No KTP</th>
                  <th>Alamat</th>
                  <th>Phone</th>
                  <th>Pendidikan</th>
                  <th>Jenis Kelamin</th>
                  <th>Jabatan</th>
                  <th>Perusahaan</th>
                  <th>Tanggal Masuk</th>
                  <th>Status Karyawan</th>
                  <th>Phone Saudara</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->kd_karyawan?></td>
                    <td><?=$value->name?></td>
                    <td><?=$value->ktp?></td>
                    <td><?=$value->alamat?></td>
                    <td><?=$value->phone?></td>
                    <td><?=$value->pendidikan?></td>
                    <td><?=$value->jk_kelamin?></td>
                    <td><?=$value->nama_jabatan?></td>
                    <td><?=$value->nama_perusahaan?></td>
                    <td><?=$value->tgl_masuk?></td>
                    <td><?=$value->nama_status?></td>
                    <td><?=$value->phone_saudara?></td>
                    <td><a href="<?php echo base_url().'karyawan/download/'.$value->photo ?>"><i class="ace-icon fa fa-download"></i></td>
                    <td class="text-center" width="160px">
                      <a href="<?=site_url('karyawan/edit/'.$this->uri->segment(3).'/'.$value->karyawan_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                      <a href="<?=site_url('karyawan/del/'.$this->uri->segment(3).'/'.$value->karyawan_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                       
                        
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>

    <?php }else{
  redirect('auth/blocked');
 }