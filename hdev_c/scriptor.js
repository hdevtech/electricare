        /*$('#nbtn').click(function(){
          
        });*/
        $('#nbtn').live("click", function() {
            alert('ok');
        });
    $(document).on('click','a',function(e) {
      e.preventDefault();
      //var mod_code=$(this).attr("mod_code");

      //$('#mod_edit #mod_code').val(mod_code);
      //$('#mod_edit #mod_name').val(mod_name);
      var rf = $(this).attr("href");
      var tit = $(this).attr("title");
      
      //alert(rf);
      /* Make an HTTP request using the attribute value as the file name: */
      if (rf != "#") {
      $(this).attr("cur","1");
      var hash1 = $(this).attr("btn_destination");

      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        $('#menu_loader').html('<div class="process-loader"></div>');
        if (this.readyState == 4) {
          
          if (this.status == 200) {
            //alert(tit);
            $('#menu_loader').html('<!--loader-->');
            $("nav li").removeClass("menu-open");
            $("nav li").removeClass("menu-is-opening");
            $("li .nav-treeview").hide();
            $("nav a").removeClass("active");
            
            $("li[btn_destination_parent_1='"+hash1+"']").addClass("menu-open");
            $("a[btn_destination_parent_2='"+hash1+"']").addClass("active");
            $("li[btn_destination_parent_1='"+hash1+"'] .nav-treeview").show();
            $("a[cur='1']").addClass("active");

            $('body #app_body').html(this.responseText);
            $("nav a").attr("cur",false);
            history.pushState({id:'hdev_url'+Math.floor(Math.random() * 1000)}, tit, rf);
          }
          if (this.status == 404) {
            //alert(tit);
            $('#menu_loader').html('<!--loader-->');
            $("nav li").removeClass("menu-open");
            $("nav li").removeClass("menu-is-opening");
            $("li .nav-treeview").hide();
            $("nav a").removeClass("active");
            
            $("li[btn_destination_parent_1='"+hash1+"']").addClass("menu-open");
            $("a[btn_destination_parent_2='"+hash1+"']").addClass("active");
            $("li[btn_destination_parent_1='"+hash1+"'] .nav-treeview").show();
            $("a[cur='1']").addClass("active");

            $('body #app_body').html("PAGE NOT FOUND!");
            $("nav a").attr("cur",false);
            history.pushState({id:'hdev_url'+Math.floor(Math.random() * 1000)}, tit, rf);
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