<div class="box">
  <!--<div align="center">
    <img src="<?php echo hdev_url::img(hdev_url::menu('dist/img/rasms2.ico'));?>" style="height: 138px;width: 138px;">
  </div>-->
  
  <h3>Register at <br> <?php echo APP_NAME ?></h3>
  
  <form id="login_form" class="form-signin" method="POST">
    <input type="hidden" name="ref" value="login">
    <div class="inputBox">
      <?php if (hdev_data::service('land_lord_reg')): ?>
      <button type="button" class="btn btn-primary btn-block ftb" data-bs-toggle="modal" data-bs-target=".modal-reg"><i class="fas fa-plus-circle"></i> Register as new Landlord</button>&nbsp;
      <?php endif ?>
    </div>
    <i style="color: #fff;">&copy;- <?php echo date("Y"); ?> - <a href="https://www.facebook.com/roger.hrw/" target="_blank" style="background-color: transparent!important;">  <?php echo APP_PROGRAMMER["name"] ?> </a> --- All rights reserved</i>
  </form>
</div>


<?php if (hdev_data::service('land_lord_reg')): ?>
<div class="modal fade modal-reg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Register New Landlord</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="<?php echo hdev_lang::on("form","close"); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="card">
          <div class="card-body register-card-body table-responsive p-3">

            <form method="post" id="land_lord_reg">
              <?php 
                $csrf = new CSRF_Protect();
                $csrf->echoInputField();
              ?>
              <input type="hidden" name="ref" value="land_lord_reg">
              <div class="form-group">
              <label for="l_l_name">
                Landlord name :
              </label>
              <div class="input-group mb-3">
                
                <input type="text" name="l_l_name" id="l_l_name" class="form-control" placeholder="Landlord Name" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user-alt"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="n_id">
                National identity :
              </label>
              <div class="input-group mb-3">
                
                <input type="text" name="n_id" id="n_id" class="form-control" placeholder="National identity" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user-alt"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="sex">
                Sex :
              </label>
              <div class="input-group mb-3">
                <select class="form-control" name="sex" id="sex">
                  <option value="">Select Sex</option>
                  <option value="m">Male</option>
                  <option value="f">Female</option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user-friends"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="l_l_username">
                Username :
              </label>
              <div class="input-group mb-3">
                
                <input type="text" id="l_l_username" name="l_l_username" class="form-control" placeholder="Username" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user-tag"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email">
                Email :
              </label>
              <div class="input-group mb-3">
                
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span>@</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="tel">
                Telephone :
              </label>
              <div class="input-group mb-3">
                
                <input type="text" id="tel" name="tel" class="form-control" placeholder="Telephone" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="pwd">
                Landlord Password :
              </label>
              <div class="input-group mb-3">
                
                <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user-lock"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="wait" align="center"></div>
            <input type="hidden" name="mod_close" value="#reg_close">
            </form>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" id="reg_close"><span class="fa fa-times"></span> <?php echo hdev_lang::on("form","close"); ?></button>
        <button type="button" class="btn btn-primary" id="reg_land_lord"><i class="fas fa-save"></i> Register Landlord</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endif ?>