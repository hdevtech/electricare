<?php 

$csrf = new CSRF_Protect();
                      $tkn = $csrf->getToken();
 ?>
 <style type="text/css">
     .wait1,.wait2,.wait3{
        background-image: white;
     }
 </style>
<div class="box">
  <div align="center">
    <img src="<?php echo hdev_url::img(hdev_url::menu('dist/img/rasms.ico'));?>" style="height: 138px;width: 138px;">
  </div>
  
  <h3><?php echo APP_NAME ?></h3>

    <div class="form-signin" id="forgot_1" style="">
        <div class="login-box box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center">Forgot Password</h2>
            </div>
            <h6 class="mb-20">Enter your Phone number To reset your Password</h6>
            <form id="reset_1" onsubmit="forgot_1(); return false;">
                <?php echo $csrf->echoInputField(); ?>
                <input type="hidden" name="ref" value="send_reset_code">
                <div class="input-group custom">
                    <input type="text" name="tell" class="form-control form-control-lg" placeholder="Phone number">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 wait1 border-left border-right border-bottom border-top" align="center" style="display: none;">
                      <i class="icon-copy fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                      <br>
                      <i><?php echo hdev_lang::on('validation','processing'); ?>!!!</i>
                  </div>
                </div>
                <div class="row align-items-center" id="fsave">
                    <div class="col-12">
                        <div class="input-group mb-0">
                            <!--
                                use code for form submit
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                            -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                            <br>
                            <div class="text-center" style="width: 100%;">
                                <h3 class="text-primary">OR</h3>
                                <a href="<?php echo hdev_url::menu('login') ?>" class="btn btn-secondary btn-block">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="form-signin" id="forgot_2" style="display: none;">
        <div class="login-box box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Enter a Code sent to you</h2>
            </div>
            <form id="reset_2" onsubmit="forgot_2(); return false;">
                <?php echo $csrf->echoInputField(); ?>
                <input type="hidden" name="ref" value="enter_code">
                <input type="hidden" name="mask" id="mask">
                <div class="input-group custom">
                    <input type="text" id="tel_2" name="tel" class="form-control form-control-lg" placeholder="Phone number" readonly>
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                </div>
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" name="code" placeholder="Type Code sent to you Here">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 wait2 border-left border-right border-bottom border-top" align="center" style="display: none;">
                      <i class="icon-copy fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                      <br>
                      <i><?php echo hdev_lang::on('validation','processing'); ?>!!!</i>
                  </div>
                </div>
                <div class="row align-items-center" id="fsave2">
                    <div class="col-12">
                        <div class="input-group mb-0">
                            <!--
                                use code for form submit
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                            -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>                  
    <div class="form-signin" id="forgot_3" style="display: none;">
        <div class="login-box box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Reset Password</h2>
            </div>
            <h6 class="mb-20">Enter your new password, confirm and submit</h6>
            <form id="reset_3" onsubmit="forgot_3(); return false;">
                <?php echo $csrf->echoInputField(); ?>
                <input type="hidden" name="ref" value="reset_password">
                <input type="hidden" name="mask" id="mask2">
                <input type="hidden" name="tel" id="tel_3">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" name="user" id="profiles" required>
                        <option value="">--Select Usename for your account--</option>
                    </select>
                </div>
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" name="pass_1" placeholder="New Password">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" name="pass_2" placeholder="Confirm New Password">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 wait3 border-left border-right border-bottom border-top" align="center" style="display: none;">
                      <i class="icon-copy fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                      <br>
                      <i><?php echo hdev_lang::on('validation','processing'); ?>!!!</i>
                  </div>
                </div>
                <div class="row align-items-center" id="fsave3">
                    <div class="col-12">
                        <div class="input-group mb-0">
                            <!--
                                use code for form submit
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                            -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>  

    <hr>
    <i style="color: #fff;">&copy;- <?php echo date("Y"); ?> - <a href="https://www.facebook.com/roger.hrw/" target="_blank" style="background-color: transparent!important;">  <?php echo APP_PROGRAMMER["name"] ?> </a> --- All rights reserved</i>
  </form>

</div>