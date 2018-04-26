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
    $('.show_if_results').hide();
    return;
  }// end if product is null

  $('.show_when_loading').show();
  $('.show_if_results').hide();
  $.getJSON(`api/search.php?product=${product}`, (data) => {
    // map our response to grab the product data we need
    let items = data.map(request => request.Items.Item);

    // flatten the array of items
    // filter out undefined values from the array
    items = ([].concat.apply([], items)).filter(n => n);

    if(items.length == 0){
      $('.show_if_results').hide();
      $('.show_when_loading').hide();
      alert("Could not find any products related to the search query.");
      search.items = [];
      return;
    }// end if no items

    search.items = items;
    $('.show_when_loading').hide();
    $('.show_if_results').show();
  });
};

let getContact = (company) => {
  window.location = `http://${window.location.host}/api/contact.php?companies=${company}`;
};

let search = new Vue({
  el: '#results',
  data: {
    items: []
  },
  methods: {
    buildList: (items) => {
      items = items.map(item => item.ItemAttributes.Manufacturer);
      getContact(items.join(';'));
    }// end function buildList
  }
});