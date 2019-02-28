(function(){
    jQuery(document).ready(function(){
        jQuery('.compare-similar-items').click(function(e){
            var jump = $(this).attr('href');
            var new_position = $(jump).offset();
            $('html, body').stop().animate({ scrollTop: new_position.top }, 500);
            e.preventDefault();
        });
        
        });
    
});
