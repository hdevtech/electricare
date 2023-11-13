<?php 
//echo   hdev_backup::backup();
//  exit();//
 ?>
<div id="app_data">
      <div class="row">
          <div class="col-sm-12">
            <div class="card" style="height: 100%;">
              <div class="card-header"><h5>Services to be requested</h5>
              </div>
              <div class="card-body table-responsive p-2">

                <div class="btn-group">
                  <?php if (hdev_data::service('action_reg')): ?>
                  <button class="btn btn-primary ftb" data-bs-toggle="modal" data-bs-target=".modal-reg"><i class="fa fa-plus-circle"></i> Add new Service</button>&nbsp;
                  <?php endif ?>
                </div>
                <?php //var_dump(hdev_data::get_student('',['year'])); ?>
                  <table class="table table-bordered table-hover table-striped text-nowrap" id="rasms_all_tables">
                  <thead class="border-top">
                    <tr>
                      <th class="table-plus datatable-nosort">Reg no</th>
                      <th>Service Name</th>
                      <th>Reg Date</th>
                      <?php if (hdev_data::service('action_approve') || hdev_data::service('action_reject')): ?>
                      <th>Action</th>
                      <?php endif ?> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $ck = hdev_data::action();
                      //var_dump($ck);
                     ?>
                    <?php $i=1; foreach ($ck AS $action) { 
                      $csrf = new CSRF_Protect();
                      $tkn = $csrf->getToken();
                      $build2 = "ref:action_approve;id:".$action['s_id'].";src:1;from:".urlencode(hdev_url::get_url_host().$_SESSION['act_url'][2]);
                      $reject = hdev_data::encd("mod_close:#sk_del_close;app:".$tkn.";".$build2);
                      $build3 = "ref:action_delete;id:".$action['s_id'].";src:1;from:".urlencode(hdev_url::get_url_host().$_SESSION['act_url'][2]);
                      $reject2 = hdev_data::encd("mod_close:#sk_del_close;app:".$tkn.";".$build3);
                    ?>

                    <tr>
                      <td class="table-plus">
                        <?php echo $i++; ?>
                      </td>
                      <td>
                        <?php echo $action["s_name"]; ?>
                      </td>                                         
                      <td>
                        <?php echo $action["s_reg_date"]; ?>
                      </td>
                      <?php if (hdev_data::service('action_approve') || hdev_data::service('action_reject')): ?>
                      <td>
                        <div class="btn-group btn-group-sm">                      
                          <?php if (hdev_data::service('action_delete')): ?>
                          <button type="button" set_btn='fm_set_clk' e_tit="Are you Sure That You Want to Delete this Service?" ref_id="<?php echo $action['s_id']; ?>" data="<?php echo $reject2; ?>" hash="<?php echo $tkn; ?>" rel="external" class="btn btn-danger fm_pre_set" data-bs-toggle="modal" data-bs-target=".modal-set" ><i class="fa fa-times-circle"></i> Delete</button>
                           <?php endif ?>
                        </div>
                      </td>
                      <?php endif ?> 
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
      </div>
</div>

<?php if (hdev_data::service('action_reg')): ?>
<div class="modal fade modal-reg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add new Service</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="<?php echo hdev_lang::on("form","close"); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="card">
          <div class="card-body register-card-body table-responsive p-3">

            <form method="post" id="action_reg">
              <?php 
                $csrf = new CSRF_Protect();
                $csrf->echoInputField();
              ?>
              <input type="hidden" name="ref" value="action_reg">
              <div class="form-group">
              <label for="s_name">
                Service name:
              </label>
              <div class="input-group mb-3">
                
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-file-alt"></span>
                  </div>
                </div>
                <input type="text" name="s_name" id="s_name" class="form-control" placeholder="Service Name" required="true">
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
        <button type="button" class="btn btn-primary" id="action_reg_btn" onclick="fm_submit('action_reg_btn','action_reg');"><i class="fas fa-save"></i> Submit new Service</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endif ?>


<div class="modal fade modal-set" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Accept</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="<?php echo hdev_lang::on("form","close"); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="card">
          <div class="card-body register-card-body table-responsive p-3">
              <?php 
                  $csrf = new CSRF_Protect();
                  $csrf->echoInputField();
                ?>
              <table class="table border-bottom">
                <tr>
                  <th colspan="2" id="e_tit"></th>
                </tr>
                <tr>
                  <td>Record id : </td>
                  <td id="ref_id"></td>
                </tr>           
              </table>
            <div class="wait" align="center"></div>
          </div>
          <!-- /.form-box --> 
        </div><!-- /.card -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="sk_del_close"><?php echo hdev_lang::on("form","close"); ?></button>
        <button type="button" class="btn btn-danger" id="fm_set_clk" data="" hash="" onclick="fm_app('fm_set_clk')"><i class="fa fa-times-circle"></i> </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog --> 
</div>