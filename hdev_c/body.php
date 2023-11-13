<?php if (!isset($_GET) || !isset($_GET['tb']) || $_GET['tb'] != "ok"): ?>
  <!-- Content Wrapper. Contains page content -->
  <main id="main" class="main content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="pagetitle">
      <h1><?php echo $_SESSION['act_url'][0]; ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo hdev_url::menu(""); ?>"><?php echo hdev_lang::on("menu",'home') ?></a></li>
          <li class="breadcrumb-item active"><?php echo $_SESSION['act_url'][0]; ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <hr>

    <!-- Main content -->
    <section class="content section" id="main2">
      <div class="container-fluid" id="hdev_app_reference">
        <?php 
          if (!empty($_SESSION['act_url'])) {
            if (!empty($_SESSION['act_url'][0]) && !empty($_SESSION['act_url'][1])) {
              if (file_exists($_SESSION['act_url'][1].".php")) {
                if (hdev_menu_url::url_req($_SESSION['act_url'][0],"user") == "y") {
                  include $_SESSION['act_url'][1].".php";
                }else{
                  //exit("1");
                  include 'error.php';
                }
              }else{
                //exit("2");
                include 'error.php';
              }
            }else{
              /*var_dump($_SESSION);
              exit("3");*/
              include 'error.php';
            }
          }else{
            //exit("4");
            include 'error.php';
          }
        ?>
      </div>
    </section>

    <!-- /.content -->
  </main>
  <!-- /.content-wrapper -->
<?php endif ?>