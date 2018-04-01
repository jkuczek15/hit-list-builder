<?php
##################################
/*********************************
 *  header.php - Website Header 
 *********************************/
##################################

##################################
##################################
# INCLUDES                       #
##################################
##################################
include_once('includes/utils.php');

if(!is_array($template_config)){
  $template_config = array();
}// end if template config array not created

$logged_in = get_val('logged_in', $template_config);
##################################
##################################
# CONTENT                        #
##################################
##################################
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/foundation.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png"/>
  <script src="assets/js/vendor/modernizr.js"></script>
  <script src="assets/js/vendor/jquery.js"></script>
  <title>Hit-List Builder</title>
</head>
<!-- Navigation bar -->
<div class="contain-to-grid sticky">
  <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">
    <ul class="title-area">
      <li class="name">
        <h1><a href="#">HL</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>
    <!-- Nav Items -->
    <section class="top-bar-section">
      <ul class="right">
<?php
      if($logged_in){
?>
        <li><a href="#">Logout</a></li>
<?php
      }else{
?>
        <li><a href="#">Login</a></li>
<?php
      }// end if logged in
?>
      </ul>
      <ul class="left">
        <li class="<?= current_page() == 'index' ? 'active' : ''?>"><a href="index.php">Home</a></li>
<?php
      if($logged_in){
?>
        <li class="<?= current_page() == 'search' ? 'active' : ''?>"><a href="search.php">Search</a></li>
<?php
      }// end if logged in
?>
      </ul>
      <!-- / Nav Items -->
    </section>
  </nav>
</div>
<!-- / Navigation bar -->

