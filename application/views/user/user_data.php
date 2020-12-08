<section class="content-header">
      <h1>Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Users</h3>
            <div class="pull-right">
              <a href="<?=site_url('user/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-user-plus"></i>Create
              </a>
            </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Admin PT</th>
                  <th>Level</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->username?></td>
                    <td><?=$value->name?></td>
                    <td><?=$value->address?></td>
                    <td><?=$value->nama_perusahaan ?></td>
                    <td><?=$value->nama_role?></td>
                    <td class="text-center" width="160px">
                      <form action="<?=site_url('user/del')?>" method="post">
                        <a href="<?=site_url('user/edit/'.$value->user_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                        <input type="hidden" name="user_id" value="<?=$value->user_id?>">
                        <button onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs">
                          <i class="fa fa-trash"></i>Delete
                        </button>
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>