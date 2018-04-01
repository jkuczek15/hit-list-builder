<?php
##################################
/*********************************
 *  search.php - Main search page users
 *  will see once they successfully login 
 *********************************/
##################################

##################################
##################################
# HEADER                         #
##################################
##################################
$template_config['logged_in'] = true;
include('assets/header.php');

##################################
##################################
# BODY                           #
##################################
##################################
?>
<section class="main-content">
  <div class="panel clearfix">
    <h2 class="text-center">Search</h2>
  </div>
  <form>
    <div class="row text">
      <div class="large-12 columns">
        <div class="panel">
          <label id="product_label">Product:</label>
          <input id="product" type="text" placeholder="Enter product..." />
          <small id="product_error" class="error" style="display: none">Please enter a product name</small>
          <input type="submit" class="button" id="build_list" value="Build Hit List" />
        </div>
      </div>
    </div>
  </form>
</section>

<script src="assets/js/scripts/search.js"></script>
<?php
##################################
##################################
# FOOTER                         #
##################################
##################################
include('assets/footer.php');