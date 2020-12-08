<?php if ($this->uri->segment(3) == $this->fungsi->user_login()->perusahaan_id || $this->fungsi->user_login()->level ==1  ) { ?>
<section class="content-header">
      <h1>karyawan
        <small>Data Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">karyawan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">

          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>View Raker</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->kd_karyawan?></td>
                    <td><?=$value->name?></td>
                    <td><?=$value->nama_jabatan?></td>
                    <td class="text-center" width="160px">
                      <a href="<?=site_url('raker/view_raker/'.$this->uri->segment(3).'/'.$value->karyawan_id)?>" class ="btn btn-success btn-xs"><i class="fa fa-eye"></i> View</a>
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