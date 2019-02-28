
  jQuery(document).ready(function($){
         
    var newHTML;
    var i;
    var x;
 
   function showData(){   
       
           i=0;
          
        $(':checkbox').each(function() {
          if(this.checked ){
          i=i+1;  
         x=this.value;
          } 
       }); 
     
       if(i==0){$('.select_product_plate').hide();}
       if(i==1){
        $('.select_product_plate').html("Select 1 more product to compare");
        $('.select_product_plate').show();
		}
    
       if(i==2){  
        $('.select_product_plate').html("<a href='#'>Compare 2 products</a>");
        $('.select_product_plate').show();
    
		}  

       if(i==3){  	
       $('.select_product_plate').html("<a href='#'>Compare 3 products</a>");
       $('.select_product_plate').show();
         }
    }
 

      $(':checkbox').on("change",function(){      
       showData();    
    });
    

  });
