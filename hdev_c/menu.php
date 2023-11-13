 <?php
    $langg = $_SESSION['lang'];
    //$lang = $_SESSION['exp']; 
    $menutop = array(
      "1" => array(
        "name" => hdev_lang::on("menu","home"),
        "trees" => "1",
        "icon" => "fa fa-home",
        "link" => "r...home"
      ),
      "2" => array(
        "name" => hdev_lang::on("menu","contact"),
        "trees" => "1",
        "icon" => "fas fa-phone fa-3x",
        "link" => "r...contact"
      ),
      "3" => array(
        "name" => "All Providers",
        "trees" => "1",
        "icon" => "fas fa-users",
        "link" => "view...provider"
      ),
      "4" => array(
        "name" => "All Assessment Questions",
        "trees" => "1",
        "icon" => "fas fa-cubes",
        "link" => "get...service"
      ),
    );

  ?> 
<?php
    $menumask = array("hm", "prof","service","fault","appointment");
    $menumain = array(
      "hm" => array(
        "name" => hdev_lang::on("menu","home"), 
        "trees" => "1",
        "icon" => "fas fa-home",
        "link" => "r...home",
        "power" => ""
      ),
       "sld" => array(
        "name" => "Slides info", 
        "trees" => "1",
        "icon" => "fas fa-cubes",
        "link" => "modify...slide",
        "power" => ""
      ),
      "prof" => array(
        "name" => hdev_lang::on("menu","profile")."^^".hdev_lang::on("menu","my_profile"),
        "trees" => "2",
        "icon" => " fa fa-user-cog  ^^  fas fa-user",
        "link" => "# ^^  r...profile",
        "power" => "no"
      ),
      "driver" => array(
        "name" => "Drivers info"."^^"."Drivers Waiting for approval"."^^"."Approved Drivers"."^^"."Rejected Drivers"."^^"."Deleted Drivers", 
        "trees" => "2",
        "icon" => "fa fa-user-secret ^^ fa fa-tasks ^^ fa fa-check-circle ^^ fa fa-times-circle ^^ fa fa-trash",
        "link" => "# ^^ reg...driver ^^ approve...driver ^^ reject...driver ^^ delete...driver",
        "power"=> ""
      ),
      "service" => array(
        "name" => "Services info ^^ Service to be requested ^^ Requested Services ^^ Approved Services ^^ Rejected Services",
        "trees" => "2",
        "icon" => "fa fa-cubes ^^ fa fa-cubes ^^ fa fa-tasks ^^ fa fa-check-circle ^^ fa fa-times-circle",
        "link" => "# ^^ reg...service ^^ pending...service ^^ approve...service ^^ reject...service",
        "power"=> ""
      ), 
      "fault" => array(
        "name" => "Faults info ^^ Faults to be reported ^^ Reported Faults ^^ Approved Faults ^^ Rejected Faults",
        "trees" => "2",
        "icon" => "fa fa-cubes ^^ fa fa-cubes ^^ fa fa-tasks ^^ fa fa-check-circle ^^ fa fa-times-circle",
        "link" => "# ^^ reg...fault ^^ pending...fault ^^ approve...fault ^^ reject...fault",
        "power"=> ""
      ), 
      "appointment" => array(
        "name" => "Appointment info", 
        "trees" => "1",
        "icon" => "fa fa-tasks",
        "link" => "all...appoitmentssssss",
        "power"=> ""
      ),            
    );

  ?>


  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo hdev_url::menu('r/home'); ?>" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block"><?php echo hdev_data::abbr(constant("APP_NAME")); ?> </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">
              <?php
                if (hdev_log::loged()) {
              ?>
                <!--<a class="nav-link ind" rel="external" onclick="logout('<?php echo hdev_url::menu('r/home'); ?>?logout=ok')" href="#" ext_link="ok">
                  <i class="fas fa-power-off" title="logout"></i>&nbsp;-->
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!--<img src="<?php echo hdev_url::menu('assets/img/profile-img.jpg'); ?>" alt="Profile" class="rounded-circle">-->
            <span class="fa fa-user fa-5x"></span>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php hdev_data::active_user("username"); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php hdev_data::active_user("username"); ?></h6>
              <span><?php echo hdev_data::active_user("fid") ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo hdev_url::menu('r/profile'); ?>">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" onclick="logout('<?php echo hdev_url::menu('r/home'); ?>?logout=ok')">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->

              <?php
                }else{
              ?>
                  <a class="nav-link ind btn btn-secondary" style="color: white;" rel="external" href="<?php echo hdev_url::menu('login'); ?>" ext_link="ok" >
                    <i class="fas fa-power-off" title=""></i>&nbsp;
              <?php
                  echo hdev_lang::on("menu","login");
                  echo "</a>";
                }
              ?>
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <?php 
        for ($i=0; $i < count($menumask); $i++) { 
          $mmenu = $menumask;
          hdevmenu::mainmenu($menumain[$mmenu[$i]]['trees'],$menumain[$mmenu[$i]]['name'],$menumain[$mmenu[$i]]['link'],$menumain[$mmenu[$i]]['icon'],$menumain[$mmenu[$i]]['power']);
        }
      ?>
    </ul>

  </aside><!-- End Sidebar-->

  <div id="app_body"> <!-- app_body -->