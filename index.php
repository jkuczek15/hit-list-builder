<?php
##################################
/*********************************
 *  index.php - Landing page users
 *  will first hit when they visit the site 
 *********************************/
##################################

##################################
##################################
# HEADER                         #
##################################
##################################
include('assets/header.php');

##################################
##################################
# BODY                           #
##################################
##################################
?>
<section class="main-content">
  <div class="panel clearfix">
    <h2 class="text-center">Hit List Builder</h2>
  </div>
  <div class="row">
    <div class="large-4 columns">&nbsp;</div>
    <div class="large-4 columns">
      <p>Some information about the product here</p>
      <ul class="pricing-table">
        <li class="title">Standard</li>
        <li class="price">$199.99</li>
        <li class="description">One-time payment</li>
        <li class="bullet-item">Utilize Amazon and Linkedin API's</li>
        <li class="bullet-item">Export to .CSV or Google Drive</li>
        <li class="bullet-item">Unlimited Exports</li>
        <li class="cta-button"><a class="button" href="search.php">Buy Now</a></li>
      </ul>
    </div>
    <div class="large-4 columns">&nbsp;</div>
  </div>
</section>

<?php
##################################
##################################
# FOOTER                         #
##################################
##################################
include('assets/footer.php');
