
<div class="box-header with-border">
  <h3 class="box-title">BackUP DataBase</h3>
</div>
<div class="col-md-12" style="padding:20px;">
    <div class="col-md-12 padding-0">
        <div class="panel box-v3">
            <div class="panel-body">
              <div class="alert alert-success alert-dismissible fade in" role="alert" style="opacity: 0.5;display: none;" id="alert-box">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <p>Berhasil mencadangkan database</p>
              </div>
              <center>
                <a href="<?= site_url() ;?>backup/file" class="btn btn-primary btn-raised btn-lg" onclick="alert()"><i class="fa fa-download"></i> Back Up DataBase</a>
              </center>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  function alert() {
    $("#alert-box").css({"display":"block"});
  }
</script>