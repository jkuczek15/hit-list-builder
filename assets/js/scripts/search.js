$(document).ready(() => {
  $('#build_list').click((e) => {
    let product = $('#product').val();
    buildHitList(product);
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

let buildHitList = (product) => {
  if(product == ''){
    $('#product_error').show();
    $('#product_label').addClass('error');
    $('#product').addClass('error');
    return;
  }// end if product is null

  $.get(`api/search.php?product=${product}`, (data) => {
    console.log(data);
  });
};