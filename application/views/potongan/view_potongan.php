<section class="content-header">
      <h1>potongan
        <small>Data potongan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">potongan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data potongan</h3>
            <div class="pull-right">
              <a href="<?=site_url('potongan/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-plus"></i>Create
              </a>
            </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>Nama Potongan</th>
                  <th>Besar Uang</th>
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
                    <td><?=$value->nama_categoripotongan?></td>
                    <td><?=$value->besar_potongan?></td>

                    <td class="text-center" width="160px">
                      <a href="<?=site_url('potongan/edit/'.$value->potongan_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                      
                      <a href="<?=site_url('potongan/del/'.$value->potongan_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                       
                        
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>