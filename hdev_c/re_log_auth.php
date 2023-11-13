<?php if (1==2) { ?>
<div class="box">
  <div align="center">
    <img src="<?php echo hdev_url::img(hdev_url::menu('dist/img/rasms.ico'));?>" style="height: 138px;width: 138px;">
  </div>
  
  <h3>Log in at <br> <?php echo APP_NAME ?></h3>
  
  <form id="login_form" class="form-signin" method="POST">
    <input type="hidden" name="ref" value="login">
    <div class="inputBox">
      <input type="text" name="usn" onkeyup="login();" required />
      <label>Email</label>
    </div>

    <div class="inputBox">
      <input type="password" name="psw" onkeyup="login();" required />
      <label>Password</label>
    </div>
    <div class="wait" align="center" style="display: none;color: #ffffff;">
        <span><img src="<?php echo hdev_url::img(hdev_url::menu('dist/img/loading2.gif'));?>" alt="" /></span>
        <br>
        <i>Processing ... Please wait!!!</i>
    </div>
    <div id="fsave"></div>
    <div class="inputBox">
      <button type="button" class="btn btn-primary btn-block ftb" data-bs-toggle="modal" data-bs-target=".modal-reg" onclick="window.location.href='<?php echo hdev_url::menu('forgot'); ?>'"><i class="fas fa-question-circle"></i> Forgot password ?</button>&nbsp;
    </div>
    <hr>
    <div class="text-light text-lg" align="center">Or</div>
    <hr>

    <div class="inputBox">
      <?php if (hdev_data::service('citizen_reg')): ?>
      <button type="button" class="btn btn-primary btn-block ftb" data-bs-toggle="modal" data-bs-target=".modal-reg"><i class="fas fa-plus-circle"></i> Register account</button>&nbsp;
      <?php endif ?>
    </div>

    <hr>
    <i style="color: #fff;">&copy;- <?php echo date("Y"); ?> - <a href="https://www.facebook.com/roger.hrw/" target="_blank" style="background-color: transparent!important;">  <?php echo APP_PROGRAMMER["name"] ?> </a> --- All rights Reserved</i>
  </form>
</div>

<?php } ?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo hdev_data::abbr(constant('APP_NAME')) ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form id="login_form" class="row g-3 needs-validation" novalidate>

                    <input type="hidden" name="ref" value="login">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="usn" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="psw" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                    </div>
                    <div class="col-12" id="fsave">
                      <button class="btn btn-primary w-100" type="button" onclick="login();">Login</button>
                    </div>

                    <div class="wait" align="center">
                        
                    </div>
                    <div class="col-12">
                      <!--<p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>-->
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="#"><?php echo APP_PROGRAMMER['name'] ?></a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->