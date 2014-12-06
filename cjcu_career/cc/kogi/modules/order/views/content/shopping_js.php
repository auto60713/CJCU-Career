$('#order-detail').html('<div class=\"notification attention\"><?php echo lang('order_no_records'); ?></div>');
$('.step-2').hide();
$('.step-3').hide();
$('.item').change(function(){
	var id=$('input[name="item"]:checked').val();
  $('input[name="item"]:checked').parent().append('已選取').css('color','green');
  $('input[name="item"]:checked').hide();
  $('input[name="item"]:checked').removeAttr('checked');
  console.log(id);
	if(id!=0){
  $('.step-2').show();
	$.ajax({
        type:'POST',
        dataType:'json',
        url: "<?php echo site_url(SITE_AREA .'/content/order/query_item_detail'); ?>/"+ id,
        cache: false,
        success: function(data)
          {
                  var lidm=$("#lidm").val();
                  console.log(data);
                  if($('#order-detail').children().hasClass('notification attention')){
                    $('#order-detail').children().removeClass("notification attention").empty();
                  }
                	$('#order-detail').append("<tr id=\"item-"+data.id+"\"><td>"+data.name+"</td><td id=\"price-"+data.id+"\">"+data.price+"</td><td>需要"+data.working_day+"個工作天製作</td><td><a href=\"#\"><img id=\"minus-"+data.id+"\" src=\"<?php echo Template::theme_url()?>images/minus.png\" /></a>&nbsp;<input type=\"hidden\" readonly=\"readonly\" name=\"order["+data.id+"][item_id]\" id=\"item-"+data.id+"\" value=\""+data.id+"\" class=\"tiny\"><input type=\"hidden\" readonly=\"readonly\" name=\"order["+data.id+"][lidm]\" id=\"lidm-"+data.id+"\" value=\""+lidm+"\" class=\"tiny\"><input type=\"text\" readonly=\"readonly\" name=\"order["+data.id+"][qty]\" id=\"qty-"+data.id+"\" value=\"1\" class=\"tiny\">&nbsp;<a href=\"#\"><img id=\"plus-"+data.id+"\" src=\"<?php echo Template::theme_url()?>images/plus.png\" /></a></td><td id=\"item-total-"+data.id+"\">"+data.price+"</td><!--<td><img width=\"16px\" id=\"del-"+data.id+"\" src=\"<?php echo Template::theme_url()?>images/cross.png\" /></td>--></tr>");
                  var result=Number($('#total_price').html());
                  var result=Number(result)+Number(data.price);
                  $('#total_price').html(Number(result));
                  $('#total_price_with_shipping').html(Number(result));
                  $('input[name=total_price_with_shipping]').val(Number(result));
                  $('#del-'+data.id).click(function(){
                    $(this).parent().parent().hide();
                    var sub_total_id=$(this).parent().prev().attr('id');
                    var sub_total=$('#'+sub_total_id).html();
                    var result=Number($('#total_price').html());
                    console.log('小記'+sub_total);
                    console.log('總金額註記'+result);
                    $('#total_price').html(Number(result-sub_total));
                  });
                  $('#qty-'+data.id).change(function(){
                    var test=$(this).val();
                    $('#item-total-'+data.id).text(data.price*test);
                    
                    console.log(test);
                  });
                  $('#minus-'+data.id).click(function(){
                    var value=Number($('#qty-'+data.id).val());
                    if((/^(\+|-)?\d+$/.test( value ))&&value>0){
                      var value_minus=value-1;
                      $('#qty-'+data.id).val(value_minus);
                      console.log(value_minus);
                      $('#item-total-'+data.id).text(Number(data.price*value_minus));                      
                      var result=Number($('#total_price').html());
                      $('#total_price').html(result-data.price);
                      $('#total_price_with_shipping').html(result-Number(data.price));
                      console.log('項目QTY-'+data.id+'扣一');
                    }
                  });
                  $('#plus-'+data.id).click(function(){
                    var value=Number($('#qty-'+data.id).val());
                    if((/^(\+|-)?\d+$/.test( value ))&&value>=0){
                      var value_plus=value+1;
                      $('#qty-'+data.id).val(value_plus);
                      console.log(value_plus);
                      $('#item-total-'+data.id).text(Number(data.price*value_plus));
                      var result=Number($('#total_price').html());
                      $('#total_price').html(result+Number(data.price));
                      $('#total_price_with_shipping').html(result+Number(data.price));
                      console.log('項目QTY-'+data.id+'加一');
                    }
                  });
                  $('input[name=shipment]').change(function(){
                    var select_shipment_method=$('input[name=shipment]:checked').val();
                    $('#shippment_fee').html(select_shipment_method);
                    $('input[name=shippment_fee]').val(select_shipment_method);
                    var total=Number($('#total_price').html())+Number(select_shipment_method);
                    $('#total_price_with_shipping').html(total);
                    console.log(select_shipment_method);
                  });
                
          },
});
}else{
	$('#order-detail').text('您尚未選擇申請項目');
}
});
