<section class="content-header">
      <h1>customer
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data customer</h3>
            <div class="pull-right">
              <a href="<?=site_url('customer/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-plus"></i>Create
              </a>
            </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                 <!--  <th>Pasar</th> -->
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->name?></td>
           <!--           <td><?=$value->name_pasar?></td> -->
                    <td><?=$value->gender?></td>
                    <td><?=$value->phone?></td>
                    <td><?=$value->address?></td>
                    <td class="text-center" width="160px">
                      <a href="<?=site_url('customer/edit/'.$value->customer_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                      
                      <a href="<?=site_url('customer/del/'.$value->customer_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                       
                        
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>