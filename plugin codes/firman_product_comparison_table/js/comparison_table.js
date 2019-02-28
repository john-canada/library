 
jQuery(document).ready(function(){

 setTimeout(function(){
   jQuery('.abcd123').show();
},1000);

jQuery('.compare-similar-items').click(function(e){
    var jump = $(this).attr('href');
    var new_position = $(jump).offset();
    $('html, body').stop().animate({ scrollTop: new_position.top }, 500);
    e.preventDefault();
});


jQuery('#compare_similar_items').click(function(e){
    var jump = $(this).attr('href');
    var new_position = $(jump).offset();
  $('html, body').stop().animate({ scrollTop: new_position.top }, 800);
    e.preventDefault();
});

});

