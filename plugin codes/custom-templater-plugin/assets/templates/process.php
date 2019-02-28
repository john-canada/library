jQuery(document).ready(function($){

    //  passdata();
   
    var newHTML;
    var i;
    var x;
    var d1,d2,d3;

   function showData(){   

        var all = new Array();
           i=0;
          
        $(':checkbox').each(function() {
          if(this.checked ){
                    
                             
                      all[i]=this.value;   
                      i=i+1;  
                   
                   
          } 

       }); 

     
       if(i==0){$('.select_product_plate').hide();}
       if(i==1){ id1=x
         
        $('.select_product_plate').html("Select 1 more product to compare");
        $('.select_product_plate').show();
		}
            if(i==1){
             d1=x;
            
            }    

       if(i==2){  d2=x;
               var data1 = all[0];
               var data2 = all[1];  
          sessionStorage.clear();
         sessionStorage.setItem("mdata1",all[0]);
         sessionStorage.setItem("mdata2",all[1]);
         

        $('.select_product_plate').html("<a href='http://staging.firmanpowerequipment.com/product-table/'>Compare 2 products</a>");  
        $('.select_product_plate').show();       
		}  

       if(i==3){  d3=x;
           
           var data1 = all[0];
           var data2 = all[1]; 	
           var data3 = all[1]; 	

           sessionStorage.clear();
           sessionStorage.setItem("mdata1",all[0]);
           sessionStorage.setItem("mdata2",all[1]);
           sessionStorage.setItem("mdata3",all[2]);


        $('.select_product_plate').html("<a href='http://staging.firmanpowerequipment.com/product-table/'>Compare 3 products</a>");
        $('.select_product_plate').show();
         }
 
     } 

      $(':checkbox').on("change",function(){      
       showData();    
    });


  });
