<?php 
  $new = new hdev_pager("r/home/page");
  hdev_session::set("pager_url","r/home/page"); 
  hdev_session::set("search","");
  hdev_session::set("cat","");
  $search = "off";
  if ($_GET) {
    if (isset($_GET['src']) && isset($_GET['cat'])) {
      $src = $_GET['src'];
      $cat = $_GET['cat'];
      if (!empty($src) && !empty($cat)) {
        $_SESSION['src'] = $src;
        $_SESSION['cat'] = $cat;
      }
    }elseif (isset($_GET['all_data'])) {
      $_SESSION['src'] = "";
      $_SESSION['cat'] = "";
    }
  }
  $src = (isset($_SESSION['src'])) ? $_SESSION['src'] : "" ;
  $cat = (isset($_SESSION['cat'])) ? $_SESSION['cat'] : "" ;
  $cate = $cat;
  if (!empty($src) && !empty($cat)) {
    $search = "on";
    hdev_session::set("search",addslashes($src));
    hdev_session::set("cat",$cat);    
  }
  $cat = array();
  $new->set(hdev_session::get("page"),6);//(current page,limit records)
  //$all_rec = hdev_data::houses('',['count']);
  //$products_by_date = hdev_data::houses();
  //$products_by_available = hdev_data::houses();
  //var_dump($products_by_available);
 
 ?>
<div id="app_data" align="center">
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
<div class="content">
      <div class="" style="padding: ;">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-indicators">
      <?php
          $m_data = hdev_data::load_view("slide");
          $num = count($m_data); 
           for ($i=0; $i < $num; $i++) { 
        $now2 = $i+1;
        if ($i == 0) {
          $indic = 'class="active" aria-current="true" aria-label="Slide 1"';
        }else{
          $indic = 'aria-label="Slide '.$now2.'"';
        }

      ?>
        <button type="button" data-bs-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $indic; ?>></button>
      <?php
      } ?>
      </div>
      <div class="carousel-inner">
        <?php 
          $ct = 0;
          foreach ($m_data as $slide) {
            //var_dump($ct);
            $ct++;
            if ($ct == 1) {
              $start1 = "active";
              $start2 = "text-start";
            }elseif ($ct == $num) {
              $start1 = "";
              $start2 = "text-end";
            }else{
              $start1 = "";
              $start2 = "";
            }
        ?>
        <div class="carousel-item <?php echo $start1 ?>">
          <img class="bd-placeholder-img" src="<?php echo hdev_url::menu('dist/img/upload/'.$slide['p_pic']); ?>" aria-hidden="true">

          <div class="container">
            <div class="carousel-caption <?php echo $start2 ?>" style="background-color: rgba(71, 104, 107, 0.4)!important;">
              <h1><?php echo $slide['p_title']; ?></h1>
              <p><?php echo $slide['p_desc'] ?></p>
            </div>
          </div>
        </div>
        <?php
          }
         ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-slide="prev" style="background: transparent;border: none;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">.</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-slide="next" style="background: transparent;border: none;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">.</span>
      </button>
    </div>
    <hr>

    <hr>
    <div style="width: 100%;text-align: center; color: white;" id="services">
      <h2 class="text-dark">
        - Recent Posts -
      </h2>
    </div>  
      <hr>
          <div class="card-group mb-30">
            <?php 
              $var = hdev_data::post('',['recent']);
              $counter = 0;
              $counter_group = 1;
              $maxer = (is_array($var)) ? count($var) : 0 ;
              $maxer_rec = ($maxer%3);
              $countt = 1;
              foreach ($var as $post) {
                $countt++;
                $counter++;
             ?>
              <div class="border-secondary border-top border-right border-left border-bottom card">
                
                    <div class="ribbon-wrapper">
                      <div class="ribbon bg-gradient-secondary" style="font-size: 10px;">
                        <?php echo $post['c_id']; ?>
                      </div>
                    </div> 
                      <img class="card-img-top" src="<?php echo hdev_url::menu('dist/img/doc/'.$post['p_pic']); ?>" alt="image" style="height: 300px !important;">
                    <div class="card-body">
                      <i style="text-align: center;" class="card-text">
                        <h5 class="" style="text-align: center;">
                          <?php echo $post['p_title'] ?>
                        </h5>
                      </i>
                      <p class="card-text btn btn-block btn-outline-secondary btn-flat" align="center">
                        <?php echo $post['p_short_desc']; ?>
                      </p>
                      <p class="card-text btn btn-block btn-outline-secondary btn-flat" align="center">
                        <?php echo hdev_data::time_ago($post['p_reg_date']); ?>
                      </p>
                        <div align="btn-group btn-block"> 
                          
                      <div class="card-footer" align="center">
                        <a href="<?php echo hdev_url::menu('view/'.$post['p_id'].'/post') ?>">
                        <button class="btn btn-secondary" type="button"><i class="fa fa-cubes"></i> View full post</button></a>
                      </div>                  
                        </div> 
                    </div> 
                  </div>
        <?php
            if (($counter%3) == 0) {
              echo '</div><div class="card-group mb-30">';
              $counter_group++;
            }
          }
         ?>
        <?php 
          if ($counter == $maxer) {
            //echo $maxer_rec;
            if ($maxer_rec == 1) {
              echo '<div class="card card-box"></div>';
              echo '<div class="card card-box"></div>';
            }elseif ($maxer_rec == 2) {
              echo '<div class="card card-box"></div>';
            }
          }
         ?>
        </div>
                <hr>

    </div>
</div>
</div>
