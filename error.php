<div class="content">
      <div class="container">
      <?php 
        if (!isset($rasms_access_error)) {
      ?>
      <div class="row" align="center">
        <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="card card-primary card-outline" style="height: 100%;">
              <div class="card-header"><h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Network failure.</h3>
              </div>
              <div class="card-body table-responsive p-3">
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-10">
                    <h1 class="headline text-warning text-xl"> 404</h1>
                    <p class="border-top border-bottom border-left border-right p-3 text-warning">
                      We could not find the page you were looking for.<br>
                      PLEASE TRY AGAIN LATER<br><br>
                      Mwihangane!<br>Ibyo mwasabye ntibibashije kuboneka mwongere mugerageze mukanya!<br>
                      Havutse ikibazo, turimo kugerageza kugikemura<br>
                      <?php echo "you can't access : <b class='text-info text-nowrap'>".hdev_url::get_url_full()."</b>"; ?>
                    </p>
                  </div>                
                </div>
              </div>
              <div class="card-footer">
                <i>&copy; <?php echo date('Y'); ?>  <?php echo APP_PROGRAMMER["name"] ?>  - <?php echo APP_NAME; ?></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
      </div>
      <?php
        }else{
      ?>
      <div class="row" align="center">
        <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <div class="card card-primary card-outline" style="height: 100%;">
              <div class="card-header"><h3 class="text-primary"><i class="fas fa-exclamation-triangle text-primary"></i> Access denied.</h3>
              </div>
              <div class="card-body table-responsive p-3">
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-10">
                    <i class="fa fa-lock fa-5x text-danger"></i><br>
                    <p class="border-top border-bottom border-left border-right p-3 mt-3 text-danger">
                      <?php echo $rasms_access_error."<br>"; ?>
                      <?php echo "you can't access : <b class='text-info text-nowrap'>".hdev_url::get_url_full()."</b>"; ?>
                    </p>
                  </div>                
                </div>
              </div>
              <div class="card-footer">
                <i>&copy; <?php echo date('Y'); ?> <?php echo APP_PROGRAMMER["name"] ?> - <?php echo APP_NAME; ?></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
      </div>
      <?php
        }
       ?>
      <!-- /.error-page -->
    </div>
  </div>