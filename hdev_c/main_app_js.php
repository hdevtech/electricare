<?php header('Content-type: text/javascript');//for homepage links validator ?>
<?php //<script type="text/javascript">?>

 $(window).on("popstate", function(e) {
        //check and compare current state
        //alert();
        //alert(e[0]);
        if (window.history.state['pg_rf'] == 'hdev_ajax1') {  // throws an exception
            //alert('detected browser url change');
            //location.reload();//reload enabled by default
                var rf = window.history.state['url_c'];
                /* Make an HTTP request using the attribute value as the file name: */
                if (rf != "#") {
                $("a[hist_id='"+window.history.state['id']+"']").attr("cur","1");
                var hash1 = $("a[hist_id='"+window.history.state['id']+"']").attr("btn_destination");

                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  $('#menu_loader').html('<div class="process-loader"></div>');
                  if (this.readyState == 4) {
                    
                    if (this.status == 200) {
                      //alert(tit);
                      $('#menu_loader').html('<!--loader-->');
                      $("aside li").removeClass("menu-open");
                      $("aside li").removeClass("menu-is-opening");
                      $("li .nav-treeview").hide();
                      $("aside a").removeClass("active");
                      
                      $("li[btn_destination_parent_1='"+hash1+"']").addClass("menu-open");
                      $("a[btn_destination_parent_2='"+hash1+"']").addClass("active");
                      $("li[btn_destination_parent_1='"+hash1+"'] .nav-treeview").show();
                      $("a[cur='1']").addClass("active");
                      $('body #app_body').html(this.responseText);
                      update_datatable();
                      $("aside a").attr("cur",false);
                    }
                    if (this.status == 404) {
                      //alert(tit);
                      $('#menu_loader').html('<!--loader-->');
                      $("aside li").removeClass("menu-open");
                      $("aside li").removeClass("menu-is-opening");
                      $("li .nav-treeview").hide();
                      $("aside a").removeClass("active");
                      
                      $("li[btn_destination_parent_1='"+hash1+"']").addClass("menu-open");
                      $("a[btn_destination_parent_2='"+hash1+"']").addClass("active");
                      $("li[btn_destination_parent_1='"+hash1+"'] .nav-treeview").show();
                      $("a[cur='1']").addClass("active");

                      $('body #app_body').html("PAGE NOT FOUND!");
                      alert("not found");
                      $("aside a").attr("cur",false);
                    }
                    /* Remove the attribute, and call this function once more: */
                    //elmnt.removeAttribute("w3-include-html");
                    //includeHTML();
                  }
                }
                xhttp.open("GET", rf+"/a/b/c", true);
                xhttp.send();
                /* Exit the function: */ 
                }
        }  else { //no previous state
            //*do something*
            alert('no back');
        }
    });

          /*$('#nbtn').click(function(){
          
        });*/
        /*
        $( document ).delegate( "#nbtn", "click", function() {
          alert( "Goodbye!" ); // jQuery 1.4.3+
        });*/

    $(document).on('click','a',function(e) {
      e.preventDefault();
      //var mod_code=$(this).attr("mod_code");

      //$('#mod_edit #mod_code').val(mod_code);
      //$('#mod_edit #mod_name').val(mod_name);
      $('.sp-thumbs a').attr("ext_link","okk");
      var rf = $(this).attr("href");
      var tit = $(this).attr("title");
      var rd_id = 'hdev_url'+Math.floor(Math.random() * 1000);
      var ext_linkk = $(this).attr("ext_link");
      $(this).attr("hist_id",rd_id);
      var ik = "me";
      if (ext_linkk == "ok") {
        window.location.href = ""+rf;
        var ik = "ok";
      }
      if (ext_linkk == "okk") {
        var ik = "ok";
      }
      if (rf == "javascript:void(0)") {
        var ik = 'no';
      }
      //alert(rf);
      /* Make an HTTP request using the attribute value as the file name: */
      if (rf != "#" && ik == "me") {
      $(this).attr("cur","1");
      var hash1 = $(this).attr("btn_destination");

      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        $('#menu_loader').html('<div class="process-loader"></div>');
        if (this.readyState == 4) {
          
          if (this.status == 200) {
            //alert(tit);
            $('#menu_loader').html('<!--loader-->');
            $("aside li").removeClass("menu-open");
            $("aside li").removeClass("menu-is-opening");
            $("li .nav-treeview").hide();
            $("aside a").removeClass("active");
            
            $("li[btn_destination_parent_1='"+hash1+"']").addClass("menu-open");
            $("a[btn_destination_parent_2='"+hash1+"']").addClass("active");
            $("li[btn_destination_parent_1='"+hash1+"'] .nav-treeview").show();
            $("a[cur='1']").addClass("active");

            $('body #app_body').html(this.responseText);
            $("aside a").attr("cur",false);
            update_datatable();
            //sm_nt();
            //var rf = '<?php echo hdev_url::menu(''); ?>';
            if (window.location.href == rf) {
              //nothing to do
            }else{
              history.pushState({pg_rf: 'hdev_ajax1',id: rd_id,url_c: rf}, tit, rf);
            }
            
          }
          if (this.status == 404) {
            //alert(tit);
            $('#menu_loader').html('<!--loader-->');
            $("aside li").removeClass("menu-open");
            $("aside li").removeClass("menu-is-opening");
            $("li .nav-treeview").hide();
            $("aside a").removeClass("active");
            
            $("li[btn_destination_parent_1='"+hash1+"']").addClass("menu-open");
            $("a[btn_destination_parent_2='"+hash1+"']").addClass("active");
            $("li[btn_destination_parent_1='"+hash1+"'] .nav-treeview").show();
            $("a[cur='1']").addClass("active");

            $('body #app_body').html("PAGE NOT FOUND!");
            alert("page not found");
            $("aside a").attr("cur",false);
            history.pushState({pg_rf: 'hdev_ajax1',id: rd_id,url_c: rf}, tit, rf);
          }
          /* Remove the attribute, and call this function once more: */
          //elmnt.removeAttribute("w3-include-html");
          //includeHTML();
        }
      }
      xhttp.open("GET", rf+"/a/b/c", true);
      xhttp.send();
      /* Exit the function: */ 
      }
      
    });
  $(window).ready(function() { 
    /*var rf = '<?php echo hdev_url::menu('app'); ?>';
    var rf2 = '<?php echo hdev_url::menu(''); ?>';
    if (window.location.href == rf) {
      window.location.href = rf2;
    }else{
      var rd_id = 'hdev_url'+Math.floor(Math.random() * 1000);
      history.pushState({pg_rf: 'hdev_ajax1',id: rd_id,url_c: rf}, '<?php echo APP_NAME; ?>', rf);
    }*/
  });
<?php //</script>?>