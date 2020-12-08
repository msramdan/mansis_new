<section class="content-header">
      <h1>Bahasa
        <small>Bahasa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bahasa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Bahasa</h3>
            <div class="pull-right">
              <a href="<?=site_url('bahasa/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-plus"></i>Create
              </a>
            </div>
          </div>

          <div class="box-body table-responsive">
            <div class="alert alert-warning alert-dismissible">
        Note : Ketika Menghapus Bahasa maka Library Kamus Bahasa akan terhapus Juga
        </div>
            <table class="table table-bordered table-striped" id="table1">
              <a href="<?=site_url('kamus/tambah_kamus_kata')?>" class="btn btn-primary" style="margin-bottom:20px; ">Tambah Kamus</a>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->name?></td>
                    <td class="text-center" width="160px">

                      <a href="<?=site_url('bahasa/edit/'.$value->bahasa_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                      
                      <a href="<?=site_url('bahasa/del/'.$value->bahasa_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>

                      <a href="<?=site_url('kamus/library_kamus/'.$value->bahasa_id)?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-eye"></i>Library Kamus</a>
                       
                        
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>