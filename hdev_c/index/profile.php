<div class="content">
      <div class="container">       
        <div class="row" align="center">
          <div class="col-sm-12">
          	<div class="card card-primary card-outline" style="height: 100%;">
              <div class="card-header">
                <h5 class="card-title m-0">User informations</h5>
              </div>
              <div class="card-body table-responsive p-0">
                <div class="row">
                  <div class="col-sm-3 border-bottom">
                    <div style="margin-top: 30%;">
                    <i class="fa fa-user fa-5x"></i><br>
                    <i class="fa"><?php echo APP_NAME; ?> ACCOUNT</i>
                    </div>
                  </div>
                  <div class="col-sm-9 border-left">
              	<table class="table table-hover border-left border-bottom text-nowrap">
                  <tbody>
                    <tr>
                      <td>Names :</td> 
                      <td><?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_name"]; ?></td>
                    </tr>
                    <tr>
                      <td>National Id :</td>
                      <td><?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_nid"]; ?></td>
                    </tr>
                    <tr>
                      <td>Email :</td>
                      <td><?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_email"]; ?></td>
                    </tr>
                    <tr>
                      <td>Telephone :</td>
                      <td><?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_tell"]; ?></td>
                    </tr>
                    <tr>
                      <td>Reg_no :</td>
                      <td><span class='text-success'><?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_id"]; ?></span></td>
                    </tr>
                  </tbody>
                </table>
                  </div>
                </div>
                <br>
                <div class="btn-group">
                  <?php if (hdev_data::service('user_edit')): ?> 
                  <button type="button" class="btn btn-primary user_editt" data-bs-toggle="modal" data-bs-target=".modal-edit">
                        <span class="fas fa-edit"></span>
                     Change Account Info
                  </button>
                  <?php endif ?>
                  <?php if (hdev_data::service('self_change_user_pwd')): ?> 
                  <button type="button" class="btn btn-success user_editt" data-bs-toggle="modal" data-bs-target="#modal-default">
                        <span class="fas fa-unlock"></span>
                     Change password
                  </button>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php if (hdev_data::service('self_change_user_pwd')): ?> 
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="<?php echo hdev_lang::on("form","close"); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="self_sec_p">
      <div class="modal-body">
         <div class="card">
          <div class="card-body register-card-body table-responsive p-3">
              <?php 
                  $csrf = new CSRF_Protect();
                  $csrf->echoInputField();
                ?>
              <input type="hidden" name="ref" value="self_change_user_pwd">
              <div class="form-group">
              <label for="r_acc_name">
                Current Password :
              </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-unlock"></span>
                  </div>
                </div>
                <input type="password" id="old_password" name="old_password" class="form-control" required="true" placeholder="Current Password">
              </div>
            </div>
              <div class="form-group">
              <label for="r_acc_name">
                New Password :
              </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                <input type="password" name="new_password" class="form-control" placeholder="New Password" required="true">
              </div>
            </div>
            <div class="form-group">
              <label for="r_acc_name">
                Re-type New Password :
              </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span> 
                  </div>
                </div>
                <input type="password" name="confirm_password" id="cfp" class="form-control" placeholder="Re-type New Password" required="true">
              </div>
            </div>
            <div class="wait" align="center"></div>
            <input type="hidden" name="mod_close" value="#prof_edit_close">
          </div>
          <!-- /.form-box --> 
        </div><!-- /.card -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="prof_edit_close"><?php echo hdev_lang::on("form","close"); ?></button>
        <button type="submit" class="btn btn-primary" id="self_sec_p_btn"><i class="fas fa-save"></i>Change Password</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog --> 
</div>
<?php endif ?>
<?php if (hdev_data::service('user_edit')): ?> 
<div class="modal fade modal-edit"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Account Info</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="<?php echo hdev_lang::on("form","close"); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="card">
          <form method="post" id="user_edit">
          <div class="card-body register-card-body table-responsive p-3">
              <?php 
                $csrf = new CSRF_Protect();
                $csrf->echoInputField();
              ?>
              <input type="hidden" name="ref" value="user_edit">
            <div class="form-group">
              <label for="name">
                Names :
              </label>
              <div class="input-group mb-3">
                
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-user-alt"></span>
                  </div>
                </div>
                <input type="text" name="name" id="name" class="form-control" placeholder="Names" required="true" value="<?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_name"]; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="sex">
                National Id :
              </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-user-friends"></span>
                  </div>
                </div>

                <input type="text" name="a_nid" id="a_nid" class="form-control" placeholder="National Id" required="true" value="<?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_nid"]; ?>">
              </div>
            </div> 
            <div class="form-group">
              <label for="email">
                Email :
              </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required" value="<?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_email"]; ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="tel">
                Telephone:
              </label>
              <div class="input-group mb-3">
                
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                  </div>
                </div>
                <input type="text" id="tel" name="tel" class="form-control" placeholder="Telephone" required="true" maxlength="10" value="<?php echo hdev_data::get_admin(hdev_log::uid(),['data'])["a_tell"]; ?>">
              </div>
            </div>
            <div class="wait" align="center"></div>
            <input type="hidden" name="mod_close" value="#reg_close">
            
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="reg_close"><?php echo hdev_lang::on("form","close"); ?></button>
        <button type="button" class="btn btn-primary" id="edit_user_btn"><i class="fas fa-save"></i> Change Account Info</button>
      </div>
      </form>
    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog --> 
</div>
<?php endif ?>