<section class="content-header">
  <h1>User Menu
    <small>User Access</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> User Access</a></li>
    <li class="active">User Access</li>
  </ol>
</section>
<section class="content">
  <h4>Role : <?= $role['role'] ?> </h4>
  <div class="row">
      <div class="box">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Access</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($row->result() as $key => $value) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $value->menu ?></td>

                  <td>
                    <div class="form-check">
                                      <?php
                $menuId = $value->id;
                $querySubMenu = "SELECT `user_sub_menu`.`title`,`user_sub_menu`.`id` as id_sub,`user_menu`.*
                FROM `user_sub_menu` JOIN `user_menu` 
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
               WHERE `user_sub_menu`.`menu_id` = $menuId
               AND `user_sub_menu`.`is_active` = 1
               ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>

                 <?php foreach ($subMenu as $sm) : ?>
                  <input class="form-check-input" type="checkbox" <?= check_access($role['id'],$sm['id_sub']); ?>
                        data-role="<?= $role['id']; ?>"
                        data-menu="<?= $sm['id_sub'] ?>"
                      >
                      <label class="" for="customCheck1"><?= $sm['title'] ?></label><br>

                <?php endforeach; ?>




                      



                    </div>

                  </td>
                    </form>
                </tr>
              <?php
              } ?>

            </tbody>
          </table>
      </div>
    </div>
</section>
    <script type="text/javascript">
      $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
          url: "<?= base_url('level/changeaccess'); ?>",
          type: "post",
          data: {
            menuId: menuId,
            roleId: roleId,
          },
          success: function() {
            document.location.href = "<?= base_url('level/role/') ?>" + roleId;
          }

        });

      })
    </script>