

<?php 
  $load_reg_shop = 1;
 ?>
<style type="text/css">
  
    .carousel-item {
    height: 70% !important;
    border-radius: 20px;
    }
    main{
      padding-right: 10px;
      padding-left: 10px;
    }
    #myCarousel div,#mn_cnt{
      border-radius: 10px;
    }
    .carousel-item img{
      width: 100%!important;
      height: auto!important;
    }   
</style>
<div id="app_data">
      <div class="row">
          <div class="col-sm-12">
            <div class="card card-primary card-outline" style="height: 100%;" align="center">
              <div class="card-header"><h2><?php echo APP_NAME ?></h2>
              </div>
              <div class="card-body table-responsive p-2">
                <?php if (!hdev_log::loged()) { ?>
                <div align="center">
                  <a ext_link='ok' href="<?php echo hdev_url::menu('login'); ?>"><button type="button" class="btn btn-primary"><i class="fa fa-cubes"></i> Get Started</button></a>
                </div>
              <?php
                } ?>
              </div>
            </div>
          </div>
          <!-- /.col -->
      </div>
</div>