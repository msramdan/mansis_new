<section class="content-header">
      <h1>History
        <small>Login</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">history login</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">History Login</h3>
            <div class="pull-right">
            </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Info</th>
                  <th>waktu</th>
                  <th>User Agent</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($history as $rows) {?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $rows['nama']; ?></td>
                    <td><?php echo $rows['info']; ?></td>
                    <td><?php echo $rows['tanggal']; ?> </td>
                    <td><?php echo $rows['user_agent']; ?> </td>
                  </tr>
                  <?php $no++ ?>
                  <?php } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>