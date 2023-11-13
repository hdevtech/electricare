<div id="app_data">
      <div class="row">
          <div class="col-sm-12">
            <div class="card" style="height: 100%;">
              <div class="card-header"><h5>Approved Reported Faults</h5>
              </div>
              <div class="card-body table-responsive p-2">
                <?php //var_dump(hdev_data::get_student('',['year'])); ?>
                  <table class="table table-bordered table-hover table-striped text-nowrap" id="rasms_all_tables">
                  <thead class="border-top">
                    <tr>
                      <th class="table-plus datatable-nosort">Reg no</th>
                      <th>Username</th>
                      <th>Tell</th>
                      <th>Fault</th>
                      <th>Disrict</th>
                      <th>status</th>
                      <th>Reg Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $ck = hdev_data::fault_report("",['approve']);
                      //var_dump($ck);
                     ?>
                    <?php foreach ($ck AS $fault_report) { 
                      $csrf = new CSRF_Protect();
                      $tkn = $csrf->getToken();
                      $build2 = "ref:fault_report_approve;id:".$fault_report['fr_id'].";src:1;from:".urlencode(hdev_url::get_url_host().$_SESSION['act_url'][2]);
                      $reject = hdev_data::encd("mod_close:#sk_del_close;app:".$tkn.";".$build2);
                      $build3 = "ref:fault_report_reject;id:".$fault_report['fr_id'].";src:1;from:".urlencode(hdev_url::get_url_host().$_SESSION['act_url'][2]);
                      $reject2 = hdev_data::encd("mod_close:#sk_del_close;app:".$tkn.";".$build3);
                    ?>

                    <tr>
                      <td class="table-plus">
                        <?php echo $fault_report["fr_id"]; ?>
                      </td>
                      <td>
                        <?php echo $fault_report["fr_username"]; ?>
                      </td>                                         
                      <td>
                        <?php echo $fault_report["fr_tell"]; ?>
                      </td>                                          
                      <td>
                        <?php 
                            $fault = $fault_report["f_id"];
                            $fault = hdev_data::fault($fault,['data']);
                            echo $fault["f_id"]." - ".$fault["f_name"]; 
                        ?>
                      </td>                                         
                      <td>
                        <?php echo $fault_report["fr_district"]; ?>
                      </td>                                         
                      <td>
                      <?php 
                        $status = $fault_report["fr_status"];
                        if($status == "1"){
                       ?>
                        <span class="badge bg-warning">Pending</span>
                       <?php
                        }elseif($status == "2"){
                        ?>
                          <span class="badge bg-success">Approved</span>
                        <?php
                        }elseif($status ==3){
                        ?>
                          <span class="badge bg-danger">Rejected</span>
                        <?php
                        }
                        ?>
                      </td>      
                      <td>
                        <?php echo $fault_report["fr_reg_date"]; ?>
                      </td>
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