<section class="content-header">
      <h1>Library Kamus
        <small>Library Kamus</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Library Kamus</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Library Kamus</h3>
          </div>

          <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th style="width: 20%;">Kode Kamus <font style="color: red">(Yang dipanggil getteks)</font></th>
                  <th>Terjemahan Bahasa</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  <?php foreach ($library_kamus as $rows) { ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $rows ['kode_kamus']; ?></td>
                  <td><?php echo $rows ['teks']; ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>kamus/edit_kamus/<?php echo $rows['bahasa_id'] ?>/<?php echo $rows['kode_kamus'] ?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i>Edit</a>
                  </td>
                </tr>
                <?php $no++ ?>
              <?php } ?>
              </table>



            
          </div>

    </section>

