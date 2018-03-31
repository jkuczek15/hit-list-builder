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
  <title>Hit-List Builder</title>
</head>

<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">HL Builder</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
  </ul>

<?php
  if($logged_in){
?>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li><a href="#">Logout</a></li>
    </ul>
    <!-- Left Nav Section -->
    <ul class="left">
      <li class="<?= current_page() == 'index.php' ? 'active' : ''?>"><a href="index.php">Home</a></li>
      <li class="<?= current_page() == 'search.php' ? 'active' : ''?>"><a href="search.php">Search</a></li>
    </ul>
  </section>
<?php
  }else{
?>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li><a href="#">Login</a></li>
    </ul>
    <!-- Left Nav Section -->
    <ul class="left">
      <li class="<?= current_page() == 'index.php' ? 'active' : ''?>"><a href="index.php">Home</a></li>
      <li class="<?= current_page() == 'pricing.php' ? 'active' : ''?>"><a href="pricing.php">Pricing</a></li>
    </ul>
  </section>
<?php
  }// end if logged in
?>
</nav>

