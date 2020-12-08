<section class="content-header">
      <h1>Data Jenis Simpanan
        <small>Data Jenis Simpanan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Jenis Simpanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Data Jenis Simpanan</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Perusahaan</th>
                  <th>View Data Jenis Simpanan</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->name?></td>
                    <td><a href="<?=site_url('jenissimpanan/view_jenissimpanan/'.$value->perusahaan_id)?>" class ="btn btn-success btn-xs"><i class="fa fa-eye"></i>View</a></td>
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>