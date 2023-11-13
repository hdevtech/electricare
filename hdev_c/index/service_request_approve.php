<?php 
//echo   hdev_backup::backup();
//  exit();//
 ?>
<div id="app_data">
      <div class="row">
          <div class="col-sm-12">
            <div class="card" style="height: 100%;">
              <div class="card-header"><h5>Approved Requested Services</h5>
              </div>
              <div class="card-body table-responsive p-2">

                <?php //var_dump(hdev_data::get_student('',['year'])); ?>
                  <table class="table table-bordered table-hover table-striped text-nowrap" id="rasms_all_tables">
                  <thead class="border-top">
                    <tr>
                      <th class="table-plus datatable-nosort">Reg no</th>
                      <th>Username</th>
                      <th>Tell</th>
                      <th>National Id</th>
                      <th>Service</th>
                      <th>Disrict</th>
                      <th>status</th>
                      <th>Reg Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $ck = hdev_data::service_request("",['approve']);
                      //var_dump($ck);
                      $i = 1;
                     ?>
                    <?php foreach ($ck AS $service_request) { 
                      $csrf = new CSRF_Protect();
                      $tkn = $csrf->getToken();
                      $build2 = "ref:service_request_approve;id:".$service_request['sr_id'].";src:1;from:".urlencode(hdev_url::get_url_host().$_SESSION['act_url'][2]);
                      $reject = hdev_data::encd("mod_close:#sk_del_close;app:".$tkn.";".$build2);
                      $build3 = "ref:service_request_reject;id:".$service_request['sr_id'].";src:1;from:".urlencode(hdev_url::get_url_host().$_SESSION['act_url'][2]);
                      $reject2 = hdev_data::encd("mod_close:#sk_del_close;app:".$tkn.";".$build3);
                    ?>

                    <tr>
                      <td class="table-plus">
                        <?php echo $i++; ?>
                      </td>
                      <td>
                        <?php echo $service_request["sr_username"]; ?>
                      </td>                                         
                      <td>
                        <?php echo $service_request["sr_tell"]; ?>
                      </td>                                         
                      <td>
                        <?php echo $service_request["sr_nid"]; ?>
                      </td>                                         
                      <td>
                        <?php 
                            $service = $service_request["s_id"];
                            $service = hdev_data::action($service,['data']);
                            echo $service["s_id"]." - ".$service["s_name"]; 
                        ?>
                      </td>                                         
                      <td>
                        <?php echo $service_request["sr_district"]; ?>
                      </td>                                         
                      <td>
                      <?php 
                        $status = $service_request["sr_status"];
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
                        <?php echo $service_request["sr_reg_date"]; ?>
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