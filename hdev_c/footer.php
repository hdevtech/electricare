
</div><!-- ./app body -->










  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span><?php echo APP_NAME ?></span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="<?php echo hdev_url::menu(""); ?>"><?php echo APP_PROGRAMMER['name'] ?></a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- jQuery -->
  <script src="<?php echo hdev_url::menu('assets/jquery/jquery.min.js'); ?>"></script>
  <!-- Vendor JS Files -->
  <script src="<?php echo hdev_url::menu('assets/vendor/apexcharts/apexcharts.min.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/chart.js/chart.min.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/echarts/echarts.min.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/quill/quill.min.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/tinymce/tinymce.min.js'); ?>"></script>
  <script src="<?php echo hdev_url::menu('assets/vendor/php-email-form/validate.js'); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo hdev_url::menu('assets/js/main.js'); ?>"></script>
<script src="<?php echo hdev_url::menu('script-1'); ?>"></script>

<script src="<?php echo hdev_url::menu('assets/pace-progress/pace.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<!-- DataTables  & Plugins -->
<script src="<?php echo hdev_url::menu("assets/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-bs4/js/dataTables.bootstrap4.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-responsive/js/dataTables.responsive.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-responsive/js/responsive.bootstrap4.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-buttons/js/dataTables.buttons.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-buttons/js/buttons.bootstrap4.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/jszip/jszip.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/pdfmake/pdfmake.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/pdfmake/vfs_fonts.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-buttons/js/buttons.html5.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-buttons/js/buttons.print.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu("assets/datatables-buttons/js/buttons.colVis.min.js"); ?>"></script>
<script src="<?php echo hdev_url::menu('assets/ajax/sl.js');?>"></script>
<script src="<?php echo hdev_url::menu('assets/ajax/former.js');?>"></script>


<script >
  function logout(ur = '') {
    var confim = window.confirm('Are you Sure You Want To logout ?');
    if (confim) {
      window.location.href=ur;
    }
  }
  function id_validator(val_text='',input_icon='',message_box='',sub_btn='') {

    if (val_text.length != 16) {
      errors = "Id must be 16 digits";
      var a = '<span class="text-danger">'+errors+'</span>';
      $(sub_btn).hide();
      $(message_box).html(a);
      $(input_icon).html('<span class="fa fa-times-circle text-danger"></span>');
    }else{
      $(sub_btn).show();
      $(message_box).html('');
      $(input_icon).html('<span class="fa fa-check-circle text-success"></span>');
    }
  }
  function mr_step(calll,val=1) {
    var stepper = new Stepper($('.bs-stepper')[0]);
    if (calll == "next") {
      for (var i = 1; i <= val; i++) {
        stepper.next();
      }
    }
    if (calll == "previous") {
      for (var i = 1; i <= val; i++) {
        stepper.previous();
      }
    }
  }
      function delete_me(ref='',ur='') {
        var cf = window.confirm('Are you sure you want to delete this '+ref);
        if (cf) {
            window.location.href = ur;
        }
    }  
  function mr_locator(ret='',prov_v="",dist_v="",sect_v="",cel_v="") {
    
      var cv = '<?php $csrf = new CSRF_Protect();echo $csrf->getToken();  ?>';
        $.ajax({
        url   : "<?php echo hdev_url::menu('up'); ?>",
        method  : "POST",
        data  : {ref:'location_select',type:ret,prov:prov_v,dist:dist_v,sect:sect_v,cell:cel_v,cover:cv},
        beforeSend: function(){

          var icoo = $('#'+ret).attr(ret+"-ico");
          $('#'+ret+' input-group-text').html('<div class="process-loader"></div>');
             },
            success:function(html){
              //alert(html);
              var icoo = $('#'+ret).attr(ret+"-ico");
              $('#'+ret+' input-group-text').html('<span class="'+icoo+'" ></span>');
              switch(ret) {
                case 'district':
                  $('#'+ret).html(html); 
                  $('#sector').html('<option value="">---Hitamo---</option>');
                  $('#cell').html('<option value="">---Hitamo---</option>'); 
                  $('#village').html('<option value="">---Hitamo---</option>');
                  break;
                case 'sector':
                  $('#'+ret).html(html); 
                  $('#cell').html('<option value="">---Hitamo---</option>'); 
                  $('#village').html('<option value="">---Hitamo---</option>');
                  break;
                case 'cell':
                  $('#'+ret).html(html); 
                  $('#village').html('<option value="">---Hitamo---</option>'); 
                  break; 
                case 'village':
                  $('#'+ret).html(html); 
                  break;   
              }
            }, 
            error: function(){
              alert("refresh a page and try again");
            }
      })
  }
  var $load_status= '<span><i class="fa fa-spinner fa-spin"></i></span><i>&nbsp;&nbsp;wait...!!!</i>';
    function fm_submit(btn_ck,fm_ck,url_action='') {
      //alert('hello');
        var formData = jQuery('#'+fm_ck).serialize();
        $.ajax({ 
              type: "POST",
              url: "<?php echo hdev_url::menu('up');?>",
              data: formData,
              beforeSend: function(){
                $('.wait').html($load_status);
                $('#'+btn_ck).hide();
               },
              success:function(html){
                  a = '<span class="text-danger">'+html+'</span>';
                  $('.wait').html(a);
                  setTimeout(function(){
                    $('.wait').html('');
                    $('#'+btn_ck).show();
                  }, 4000);
              },
              error: function(){
                $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
                $('#'+btn_ck).show();
              }
            });
    }
    function fm_app(fm_btn) {
      var dtt = $('#'+fm_btn).attr("data");
      var hss = $('#'+fm_btn).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#'+fm_btn).hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#'+fm_btn).show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#'+fm_btn).show();
            }
          });
        return false;
    }
  function call_stepper() {
    // As a jQuery Plugin
    var step_var = $('.bs-stepper').attr('step_val');
    if(step_var == "ok") {
      $(document).ready(function () {
      var stepper = new Stepper($('.bs-stepper')[0]);
    });
    }
    
  }
  function loc_edit(province='',district='',sector='',cell='',village='') {
      $("#province option[value!='"+province+"']").attr("selected",false);
      $("#province option[value='"+province+"']").attr("selected",true);
      $("#district option[value!='"+district+"']").attr("selected",false);
      $("#district option[value='"+district+"']").attr("selected",true);
      $("#sector option[value!='"+sector+"']").attr("selected",false);
      $("#sector option[value='"+sector+"']").attr("selected",true);
      $("#cell option[value!='"+cell+"']").attr("selected",false);
      $("#cell option[value='"+cell+"']").attr("selected",true);
      $("#village option[value!='"+village+"']").attr("selected",false);
      $("#village option[value='"+village+"']").attr("selected",true);
  }; 
  //sm_nt();
  function update_datatable() {
    //init_editor();
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
    //CKEDITOR.replace( 'editor1' );
    //$( '#editor1' ).ckeditor();
    //$('.textarea').summernote()
  })
      //window.stepper = new Stepper(document.querySelector('.bs-stepper'));
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        lazyLoad: true,
        lazyLoadEager: 1,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 3,
            nav: true
          },
          1000: {
            items: 4,
            nav: true,
            loop: true,
            margin: 10
          }
        }
      })
    });
  /* wait for images to load */
  $(window).ready(function() { 
    //$('.sp-wrap').smoothproducts();
  });

  $("#rasms_all_tables").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    //"buttons": ["copy", "csv", "excel", "pdf", "print"]
    //"buttons": [""]
  });//.buttons().container().appendTo('#rasms_all_tables_wrapper .col-md-6:eq(0)');
  $("#rasms_question").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": true,"paging": false
  }); 
  $("#rasms_all_tables2").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": true
  });  
  call_stepper();
    var $load_status= '<span><i class="fa fa-spinner fa-spin"></i></span><i>&nbsp;&nbsp;wait...!!!</i>';
    $(document).on('submit','#form_reg',function(e) {
        e.preventDefault();
      if($('#form_reg #p_pic').val()) {

        $(this).ajaxSubmit({  
          target:   '#form_reg .wait',  
          beforeSubmit: function() {
            $("#form_reg #progress-bar").width('0%');
            $('#form_reg .wait').html($load_status);
            $('#form_reg #form_reg_btn').hide();
          },
          uploadProgress: function (event, position, total, percentComplete){ 
            $("#form_reg #progress-bar").width(percentComplete + '%');
            $("#form_reg #progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>');

          },
          success:function (){
              $('#form_reg_btn').show();

            setTimeout(function(){
              $('#form_reg .wait').html('');
            }, 4000);
          },
          resetForm: false 
        }); 
        return false; 
      }else{
              $('#form_reg .wait').html('Select what to upload first');
      }
    });
}
  function attach(cur='') {
    //alert(cur);
    if (cur == "") {
      cur = window.location.href;
    }
    $('#menu_loader').html('<div class="process-loader"></div>');
    var rest =  cur.split("?");
     xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {
            $('body #app_body').html(this.responseText);
            $('#menu_loader').html('<!--loader-->');
            update_datatable();
          }
          if (this.status == 404) {
            //window.location.reload();
          }
        }
      }
      xhttp.open("GET", ""+rest[0]+"/a/b/c", true);
      xhttp.send();
  }

  $load_status= $('<span><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></span><i>&nbsp;&nbsp;wait...!!!</i>');
  $saved = $('<span class="text-success"><?php echo hdev_lang::on("validation","saved"); ?></span>');
  $min_wait = $('<span class="text-success"><?php echo hdev_lang::on("validation","loading"); ?></span>');
 $(document).ready(function(){ 
  update_datatable();
    $(document).on('click','.fm_pre_set',function(e) {

      //alert('helloooo');
      var ref_id=$(this).attr("ref_id");
      var e_tit=$(this).attr("e_tit");
      var m_dt=$(this).html();
      var set_btn = $(this).attr('set_btn');
      var precls = $(this).attr('class');

      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");

      $('.modal-set #ref_id').html(ref_id);
      $('.modal-set #e_tit').html(e_tit);

      $('.modal-set #'+set_btn).attr("data","");
      $('.modal-set #'+set_btn).attr("hash","");      
      $('.modal-set #'+set_btn).attr("data",dt);
      $('.modal-set #'+set_btn).attr("hash",hs);
      $('.modal-set #'+set_btn).html(m_dt);
      $('.modal-set #'+set_btn).attr('class',precls);
      $('.modal-set #'+set_btn).removeClass('fm_pre_set');
      //alert(dt);
    }); 
    $(document).on('click','.pager_control',function(e) {
        var urr=$(this).attr("url");
        var pgg=$(this).attr("page");
        var lcc = urr+'/'+pgg;
        attach(lcc);
    }); 
  <?php if (hdev_data::service('manager_reg')): ?> 
    $(document).on('click','#reg_manager',function(e) {
      e.preventDefault();
      var formData = jQuery('#manager_reg').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#reg_manager').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#reg_manager').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#reg_manager').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>
  <?php if (hdev_data::service('employee_reg')): ?> 
    $(document).on('click','#reg_employee',function(e) {
      e.preventDefault();
      var formData = jQuery('#employee_reg').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#reg_employee').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#reg_employee').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#reg_employee').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>
  <?php if (hdev_data::service('promo_reg')): ?> 
    $(document).on('click','#reg_promo',function(e) {
      e.preventDefault();
      var formData = jQuery('#promo_reg').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#reg_promo').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#reg_promo').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#reg_promo').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>
    <?php if (hdev_data::service('manager_delete')): ?> 
    $(document).on('click','.ld_delete',function(e) {
      var manager_name=$(this).attr("name");
      var manager_post=$(this).attr("post");
      var manager_nid=$(this).attr("nid");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-delete #manager_name').html(manager_name);
      $('.modal-delete #manager_post').html(manager_post);
      $('.modal-delete #manager_nid').html(manager_nid);
      $('.modal-delete #manager_delete').attr("data","");
      $('.modal-delete #manager_delete').attr("hash","");      
      $('.modal-delete #manager_delete').attr("data",dt);
      $('.modal-delete #manager_delete').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#manager_delete',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#manager_delete').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#manager_delete').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class="text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#manager_delete').show();
            }
          });
        return false; 
    });
    <?php endif ?>
    <?php if (hdev_data::service('employee_delete')): ?> 
    $(document).on('click','.ld_delete',function(e) {
      var employee_name=$(this).attr("name");
      var employee_post=$(this).attr("post");
      var employee_nid=$(this).attr("nid");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-delete #employee_name').html(employee_name);
      $('.modal-delete #employee_post').html(employee_post);
      $('.modal-delete #employee_nid').html(employee_nid);
      $('.modal-delete #employee_delete').attr("data","");
      $('.modal-delete #employee_delete').attr("hash","");      
      $('.modal-delete #employee_delete').attr("data",dt);
      $('.modal-delete #employee_delete').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#employee_delete',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#employee_delete').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#employee_delete').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#employee_delete').show();
            }
          });
        return false; 
    });
    <?php endif ?>

    <?php if (hdev_data::service('employee_reject')): ?> 
    $(document).on('click','.ld_reject',function(e) {
      var employee_name=$(this).attr("name");
      var employee_post=$(this).attr("post");
      var employee_nid=$(this).attr("nid");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-reject #employee_name').html(employee_name);
      $('.modal-reject #employee_post').html(employee_post);
      $('.modal-reject #employee_nid').html(employee_nid);
      $('.modal-reject #employee_reject').attr("data","");
      $('.modal-reject #employee_reject').attr("hash","");      
      $('.modal-reject #employee_reject').attr("data",dt);
      $('.modal-reject #employee_reject').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#employee_reject',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#employee_reject').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#employee_reject').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#employee_reject').show();
            }
          });
        return false; 
    });
    <?php endif ?>
  <?php if (hdev_data::service('service_reg')): ?> 
    $(document).on('click','#reg_service',function(e) {
      e.preventDefault();
      var formData = jQuery('#service_reg').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#reg_service').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#reg_service').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#reg_service').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>
    <?php if (hdev_data::service('service_edit')): ?> 
    $(document).on('click','.service_edit',function(e) {
      var s_id=$(this).attr("s_id");
      var s_name=$(this).attr("s_name");
      var s_desc=$(this).attr("s_desc");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-edit #s_id').val(s_id);
      $('.modal-edit #s_name').val(s_name);
      $('.modal-edit #s_desc').val(s_desc);
      $('.modal-edit #employee_delete').attr("data","");
      $('.modal-edit #employee_delete').attr("hash","");      
      $('.modal-edit #employee_delete').attr("data",dt);
      $('.modal-edit #employee_delete').attr("hash",hs);
      //alert(dt);
    });  
    $(document).on('click','#edit_service',function(e) {
      e.preventDefault();
      var formData = jQuery('#service_edit').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#edit_service').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#edit_service').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#edit_service').show();
            }
          });
        return false; 
    });    
    <?php endif ?>   
    <?php if (hdev_data::service('service_delete')): ?> 
    $(document).on('click','.service_delete',function(e) {
      var s_name=$(this).attr("s_name");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-delete #s_name').html(s_name);
      $('.modal-delete #service_delete').attr("data","");
      $('.modal-delete #service_delete').attr("hash","");      
      $('.modal-delete #service_delete').attr("data",dt);
      $('.modal-delete #service_delete').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#service_delete',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#service_delete').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#service_delete').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#service_delete').show();
            }
          });
        return false; 
    });
    <?php endif ?>
    $(document).on('click','.view_ct',function(e) {
      var v_c_name=$(this).attr("v_c_name");
      var v_c_nid=$(this).attr("v_c_nid");
      var v_c_post=$(this).attr("v_c_post");
      var v_c_email=$(this).attr("v_c_email");
      var v_c_tell=$(this).attr("v_c_tell");
      var v_c_location=$(this).attr("v_c_location");    
      $('.modal-view #v_c_name').html(': '+v_c_name);
      $('.modal-view #v_c_nid').html(': '+v_c_nid);
      $('.modal-view #v_c_post').html(': '+v_c_post);
      $('.modal-view #v_c_email').html(': '+v_c_email);
      $('.modal-view #v_c_tell').html(': '+v_c_tell);
      $('.modal-view #v_c_location').html(': '+v_c_location);
      //alert(dt);
    });     
    <?php if (hdev_data::service('transaction_reg')): ?> 
    $(document).on('click','.transaction_reg',function(e) {
      var c_name=$(this).attr("c_name");
      var s_name=$(this).attr("s_name");
      var s_desc=$(this).attr("s_desc");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-reg #c_name').html(c_name);
      $('.modal-reg #s_name').html(s_name);
      $('.modal-reg #s_desc').html(s_desc);
      $('.modal-reg #transaction_reg').attr("data","");
      $('.modal-reg #transaction_reg').attr("hash","");      
      $('.modal-reg #transaction_reg').attr("data",dt);
      $('.modal-reg #transaction_reg').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#transaction_reg',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#transaction_approve').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#transaction_reg').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#transaction_reg').show();
            }
          });
        return false; 
    });
    <?php endif ?>  
    <?php if (hdev_data::service('transaction_approve')): ?> 
    $(document).on('click','.transaction_approve',function(e) {
      var t_reg_date=$(this).attr("t_reg_date");
      var c_name=$(this).attr("c_name");
      var s_name=$(this).attr("s_name");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-approve #t_reg_date').html(t_reg_date);
      $('.modal-approve #c_name').html(c_name);
      $('.modal-approve #s_name').html(s_name);
      $('.modal-approve #transaction_approve').attr("data","");
      $('.modal-approve #transaction_approve').attr("hash","");      
      $('.modal-approve #transaction_approve').attr("data",dt);
      $('.modal-approve #transaction_approve').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#transaction_approve',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#transaction_approve').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#transaction_approve').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#transaction_approve').show();
            }
          });
        return false; 
    });
    <?php endif ?>  
    <?php if (hdev_data::service('transaction_reject')): ?> 
    $(document).on('click','.transaction_reject',function(e) {
      var t_reg_date=$(this).attr("t_reg_date");
      var c_name=$(this).attr("c_name");
      var s_name=$(this).attr("s_name");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-reject #t_reg_date').html(t_reg_date);
      $('.modal-reject #c_name').html(c_name);
      $('.modal-reject #s_name').html(s_name);
      $('.modal-reject #transaction_reject').attr("data","");
      $('.modal-reject #transaction_reject').attr("hash","");      
      $('.modal-reject #transaction_reject').attr("data",dt);
      $('.modal-reject #transaction_reject').attr("hash",hs);
      //alert(dt);
    }); 
    $(document).on('click','#transaction_reject',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#transaction_reject').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#transaction_reject').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#transaction_reject').show();
            }
          });
        return false; 
    });
    <?php endif ?>
  <?php if (hdev_data::service('provider_edit')): ?> 
    $(document).on('click','.ld_edit',function(e) {
      var l_id=$(this).attr("l_id");
      var l_l_name=$(this).attr("l_l_name");
      var sex=$(this).attr("sex");
      var e_s_s_qualification=$(this).attr("l_l_username");
      var tel=$(this).attr("tel");
      var email=$(this).attr("email");     
      $('.modal-edit #e_s_sd').val(l_id);
      $('.modal-edit #e_s_s_name').val(l_l_name);
      $('.modal-edit #e_sex').val(sex);
      $('.modal-edit #e_s_s_qualification').val(e_s_s_qualification);
      $('.modal-edit #e_tel').val(tel);
      $('.modal-edit #e_email').val(email); 
    }); 
    $(document).on('click','#edit_provider',function(e) {
      e.preventDefault();
      var formData = jQuery('#provider_edit').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#edit_provider').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#edit_provider').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#edit_provider').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>
    //////////////////////////////post////////////////////////
    <?php if (hdev_data::service('post_approve')): ?> 
    $(document).on('click','.ld_approve',function(e) {
      var post_title=$(this).attr("name");
      var post_short_desc=$(this).attr("username");
      var post_email=$(this).attr("email");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-approve #post_title').html(post_title);
      $('.modal-approve #post_short_desc').html(post_short_desc);
      $('.modal-approve #post_email').html(post_email);
      $('.modal-approve #post_approve').attr("data","");
      $('.modal-approve #post_approve').attr("hash","");      
      $('.modal-approve #post_approve').attr("data",dt);
      $('.modal-approve #post_approve').attr("hash",hs);
    }); 
    $(document).on('click','#post_approve',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#post_approve').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#post_approve').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#post_approve').show();
            }
          });
        return false; 
    });
    <?php endif ?>
    <?php if (hdev_data::service('post_reject')): ?> 
    $(document).on('click','.ld_reject',function(e) {
      var post_title=$(this).attr("name");
      var post_short_desc=$(this).attr("username");
      var post_email=$(this).attr("email");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      $('.modal-reject #post_title').html(post_title);
      $('.modal-reject #post_short_desc').html(post_short_desc);
      $('.modal-reject #post_email').html(post_email);
      $('.modal-reject #post_reject').attr("data","");
      $('.modal-reject #post_reject').attr("hash","");      
      $('.modal-reject #post_reject').attr("data",dt);
      $('.modal-reject #post_reject').attr("hash",hs);
    }); 
    $(document).on('click','#post_reject',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#post_reject').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#post_reject').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#post_reject').show();
            }
          });
        return false; 
    });
    <?php endif ?>
  <?php if (hdev_data::service('post_reg')): ?> 


    $(document).on('submit','#post_reg',function(e) {
      if($('#reg_post_pic').val() || $('#edit_loader').val()) {
        e.preventDefault();

        $(this).ajaxSubmit({  
          target:   '.wait',  
          beforeSubmit: function() {
            $("#progress-bar").width('0%');
            $('.wait').html($load_status);
            $('#reg_post').hide();
          },
          uploadProgress: function (event, position, total, percentComplete){ 
            $("#progress-bar").width(percentComplete + '%');
            $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>');

          },
          success:function (datas){
            //alert(datas);
              $('#reg_post').show();

            setTimeout(function(){
              $('.wait').html('');
            }, 9000);
          },
          resetForm: false 
        }); 
        return false; 
      }else{ 
        a = '<span class="text-danger">Choose what to upload first</span>';
        $('.wait').html(a);
        setTimeout(function(){
          $('.wait').html('');
        }, 3000);
        return false;
      }
    });
    <?php endif ?>
    <?php if (hdev_data::service('post_delete')): ?> 
    $(document).on('click','.pst_delete',function(e) {
      var post_title=$(this).attr("p_title");
      var post_short_desc=$(this).attr("p_short_desc");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      alert 
      $('.modal-delete #p_title').html(post_title);
      $('.modal-delete #p_short_desc').html(post_short_desc);
      $('.modal-delete #post_delete').attr("data","");
      $('.modal-delete #post_delete').attr("hash","");      
      $('.modal-delete #post_delete').attr("data",dt);
      $('.modal-delete #post_delete').attr("hash",hs);
      //alert(dt);
    }); 
    <?php if (hdev_data::service('post_approve')): ?> 
    $(document).on('click','.pst_approve',function(e) {
      var post_title=$(this).attr("p_title");
      var post_short_desc=$(this).attr("p_short_desc");
      var dt = $(this).attr("data");
      var hs = $(this).attr("hash");
      alert 
      $('.modal-approve #p_title').html(post_title);
      $('.modal-approve #p_short_desc').html(post_short_desc);
      $('.modal-approve #post_approve').attr("data","");
      $('.modal-approve #post_approve').attr("hash","");      
      $('.modal-approve #post_approve').attr("data",dt);
      $('.modal-approve #post_approve').attr("hash",hs);
      //alert(dt);
    });   
    <?php endif ?>
    $(document).on('click','#post_delete',function(e) {
      e.preventDefault();
      var dtt = $(this).attr("data");
      var hss = $(this).attr("hash");
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('app/setting');?>/"+hss+"/"+dtt,
            data: {req:'ajax'},
             beforeSend: function(){
              $('.wait').html($load_status);
              $('#post_delete').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#post_delete').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#post_delete').show();
            }
          });
        return false; 
    });
    <?php endif ?>
  <?php if (hdev_data::service('post_edit')): ?> 
    $(document).on('click','.ld_edit',function(e) {
      var l_id=$(this).attr("l_id");
      var l_l_name=$(this).attr("l_l_name");
      var sex=$(this).attr("sex");
      var e_s_s_qualification=$(this).attr("l_l_username");
      var tel=$(this).attr("tel");
      var email=$(this).attr("email");     
      $('.modal-edit #e_s_sd').val(l_id);
      $('.modal-edit #e_s_s_name').val(l_l_name);
      $('.modal-edit #e_sex').val(sex);
      $('.modal-edit #e_s_s_qualification').val(e_s_s_qualification);
      $('.modal-edit #e_tel').val(tel);
      $('.modal-edit #e_email').val(email); 
    }); 
    $(document).on('click','#edit_post',function(e) {
      e.preventDefault();
      var formData = jQuery('#post_edit').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#edit_post').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#edit_post').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#edit_post').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>
    //init assess worker
    $(document).on('click','#assess_init_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#assess_init').serialize();
      //var me = $.toJSON(formData);
      var pp_id_v = $("#assess_init input[name='pp_id']:checked").val();
      var c_id_v = $("#assess_init input[name='c_id']:checked").val();
      //alert(pp_id_v+' '+c_id_v);
    if (pp_id_v != "" && c_id_v != "" && pp_id_v != 'undefined' && c_id_v != 'undefined') {
      //alert('full me');
      var returr = '{"c_id":"'+c_id_v+'","pp_id":"'+pp_id_v+'"}';
      var gen_ret = encodeURIComponent(returr);
      var gen_lnk = '<?php echo hdev_url::menu('assess/set/init/'); ?>'+gen_ret+'/max_assess';
      $('#assess_init_linker').attr('href',gen_lnk);
      $('#assess_init_linker').click();
    }else{
      alert('select both employee and promotion period');
    }
    ///    return false;
    });   
    $(document).on('click','#assess_result_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#assess_result').serialize();
      //var me = $.toJSON(formData);
      var pp_id_v = $("#assess_init input[name='pp_id']:checked").val();
      //alert(pp_id_v+' '+c_id_v);
    if (pp_id_v != "" && pp_id_v != 'undefined') {
      //alert('full me');
      var returr = '{"c_id":"'+''+'","pp_id":"'+pp_id_v+'"}';
      var gen_ret = encodeURIComponent(returr);
      var gen_lnk = '<?php echo hdev_url::menu('assess/result/init/'); ?>'+gen_ret+'/max_assess';
      $('#assess_result_linker').attr('href',gen_lnk);
      $('#assess_result_linker').click();
    }else{
      alert('select both employee and promotion period');
    }
    ///    return false;
    });  
    $(document).on('click','#assess_promoted_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#assess_promoted').serialize();
      //var me = $.toJSON(formData);
      var pp_id_v = $("#assess_promoted input[name='pp_id']:checked").val();
      //alert(pp_id_v+' '+c_id_v);
    if (pp_id_v != "" && pp_id_v != 'undefined') {
      //alert('full me');
      var returr = '{"c_id":"'+''+'","pp_id":"'+pp_id_v+'"}';
      var gen_ret = encodeURIComponent(returr);
      var gen_lnk = '<?php echo hdev_url::menu('assess/promoted/init/'); ?>'+gen_ret+'/max_assess';
      $('#assess_promoted_linker').attr('href',gen_lnk);
      $('#assess_promoted_linker').click();
    }else{
      alert('select both employee and promotion period');
    }
    ///    return false;
    });          
    /////////////////////post/////////////////////////
    $(document).on('click','#assess_save_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#assess_save').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#assess_save_btn').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#assess_save_btn').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#assess_save_btn').show();
            }
          });
        return false; 
    }); 
    $(document).on('click','#promo_init_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#promo_init').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#promo_init_btn').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#promo_init_btn').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#promo_init_btn').show();
            }
          });
        return false; 
    }); 
    $(document).on('click','#promo_save_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#promo_save').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#promo_save_btn').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#promo_save_btn').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#promo_save_btn').show();
            }
          });
        return false; 
    }); 
    <?php if (hdev_data::service('user_edit')): ?> 
    $(document).on('click','#edit_user_btn',function(e) {
      e.preventDefault();
      var formData = jQuery('#user_edit').serialize();
      $.ajax({ 
            type: "POST",
            url: "<?php echo hdev_url::menu('up');?>",
            data: formData,
            beforeSend: function(){
              $('.wait').html($load_status);
              $('#edit_user_btn').hide();
             },
            success:function(html){
                a = '<span class="text-danger">'+html+'</span>';
                $('.wait').html(a);
                setTimeout(function(){
                  $('.wait').html('');
                  $('#edit_user_btn').show();
                }, 4000);
            },
            error: function(){
              $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
              $('#edit_user_btn').show();
            }
          });
        return false; 
    }); 
    <?php endif ?>        
<?php if (hdev_data::service('self_change_user_pwd')): ?> 
$(document).on('click','#self_sec_p_btn',function(e) {
    e.preventDefault();
    var formData = jQuery('#self_sec_p').serialize();
    $.ajax({ 
          type: "POST",
          url: "<?php echo hdev_url::menu('up');?>",
          data: formData,
          beforeSend: function(){
            $('.wait').html($load_status);
            $('#self_sec_p_btn').hide();
           },
          success:function(html){
            a = '<span class="text-danger">'+html+'</span>';
            $('.wait').html(a);
            setTimeout(function(){
              $('.wait').html('');
              $('#self_sec_p_btn').show();
            }, 4000);
          },
          error: function(){
            $('.wait').html('<span class"text-warning"><?php echo hdev_lang::on("validation","check_conn"); ?></span>');
            $('#self_sec_p_btn').show();
          }
        });
    });
<?php endif ?>
  });

  /*$(function () {
    $("#rasms_all_tables").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#rasms_all_tables_wrapper .col-md-6:eq(0)');
  });*/
</script>
<script src="<?php echo hdev_url::menu('script-1'); ?>"></script>

</body>
</html>