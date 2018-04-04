$(document).ready(() => {
  $('#search').click((e) => {
    let product = $('#product').val();
    getProducts(product);
    e.preventDefault();
  });
});

$('#product').keyup((e) => {
  let product = $('#product').val();
  if(product != ''){
    $('#product_error').hide();
    $('#product_label').removeClass('error');
    $('#product').removeClass('error');
  }// end if product is not null
});

let getProducts = (product) => {
  if(product == ''){
    $('#product_error').show();
    $('#product_label').addClass('error');
    $('#product').addClass('error');
    $('#build_all').hide();
    return;
  }// end if product is null

  $.getJSON(`api/search.php?product=${product}`, (data) => {
    let items = data.Items.Item;

    if(!items){
      $('#build_all').hide();
      alert("Could not find any products related to the search query.");
      search.items = [];
      return;
    }// end if no items

    for(let i = 0; i < items.length; i++) {
      if(items[i].LargeImage == undefined) {
        items.splice(i, 1);
      }// end if image undefined
    }// end for loop over items
    
    $('#build_all').show();
    search.items = items;
  });
};

let search = new Vue({
  el: '#results',
  data: {
    items: []
  },
  methods: {
    buildList: (items) => {
      console.log(items);
    }// end function buildList
  }
});