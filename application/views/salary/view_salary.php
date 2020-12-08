<section class="content-header">
      <h1>salary
        <small>Data salary</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">salary</li>
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
                  <th>Perusahaan</th>
                  <th>Status Karyawan</th>
                  <th>Rate Gaji/Jam</th>
<!--                   <th>Jumlah Jam Kerja</th> -->
<!--                   <th>Total Gaji</th> -->
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
                    <td><?=$value->nama_jabatan?></td>
                    <td><?=$value->nama_perusahaan?></td>
                    <td><?=$value->nama_status?></td>
                    <td><?=$value->rate_gaji ?></td>
<!--                     <td><?php echo $lama_kerja ?></td> -->
<!--                     <td><?php echo $lama_kerja*$value->rate_gaji; ?></td> -->
                    <td class="text-center" width="160px">
                      <a href="<?=site_url('salary/print/'.$value->karyawan_id)?>" class ="btn btn-warning btn-xs" target="_blank"><i class="fa fa-print"></i> Slip Gaji</a>
                       
                        
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>