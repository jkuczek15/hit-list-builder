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
          <input type="submit" class="button" id="search" value="Search" />
        </div>
      </div>
    </div>
  </form>
  <div id="results">
    <ul class="large-block-grid-3" style="margin: auto;">
      <li v-for="item in items">
        <div class="panel large-12 large-centered columns">
          <div class="row">
            <h5>{{ item.ItemAttributes.Title }}</h5>
            <hr />
            <div class="large-4 columns text-right"><img :src="item.LargeImage.URL" /></div>
            <div class="large-8 columns text-left">
              <ul>
                <li>Manufacturer: {{ item.ItemAttributes.Manufacturer }}</li>
                <li>Type: {{ item.ItemAttributes.ProductGroup }}</li>
                <li><a target="_blank" :href="item.DetailPageURL">View on Amazon</a></li>
              </ul>
            </div>
            <input type="submit" v-on:click="buildList(item)" class="button hit-list-button" value="Build Hit List" />
          </div>
        </div>
      </li>
    </ul>
  </div>
</section>

<script src="assets/js/scripts/search.js"></script>
<?php
##################################
##################################
# FOOTER                         #
##################################
##################################
include('assets/footer.php');