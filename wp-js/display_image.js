
//var btnjupiter = document.getElementById("ban-magical");
var postholder = document.getElementById("post-container");
var btnpost = document.getElementById("btn-quick-post");

//if(btnjupiter){
   // btnjupiter.addEventListener("click",function(){
        var ourrequest = new XMLHttpRequest();
          ourrequest.open('GET', megadata.siteURL + '/wp-json/wp/v2/posts?per_page=2');
          ourrequest.onload=function(){
          if(ourrequest.status>=200 && ourrequest.status < 400){ 
          var data = JSON.parse(ourrequest.responseText);
              createHTML(data);
             // btnjupiter.remove();
          }else{
          alert("Request error");
        }
       };
    ourrequest.onerror=function(){
       alert("Request error");
    }
 ourrequest.send();
 // });
//}

function createHTML(postdata){
 var ourstring="";
  for(i=0; i<postdata.length; i++){
     ourstring += '<h4 class="posttitle"> Post Title :' + postdata[i].title.rendered + '</h4>'; 
     ourstring += '<p class="postdata"> Post Date :' + postdata[i].date + '</p>' ;
     ourstring += '<p> Post content :' + postdata[i].content.rendered + '</p>' ;
   } 
 postholder.innerHTML = ourstring
}

if(btnpost){

       btnpost.addEventListener("click",function(){

         var postdata={
          'title':document.querySelector(".status [name='title']").value,
          'content':document.querySelector(".status [name='content']").value,
          'status':"publish"
         }

         var createpost=new XMLHttpRequest();
             createpost.open("post", megadata.siteURL + '/wp-json/wp/v2/posts');
             createpost.setRequestHeader("X-WP-nonce",megadata.nonce);
             createpost.setRequestHeader('content-type','application/json;charset=UFT-8');
             createpost.send(JSON.stringify(postdata));
             createpost.onreadystatechange=function(){
              if(createpost.readyState==4){
                if(createpost.status==201){
                   document.querySelector(".status [name='title']").value="";
                   document.querySelector(".status [name='content']").value="";
                }else{

                  alert("Error try again");
                }
                
              }
             }      
  });
}

$(document).ready(function(){
	
	var windowheight=$(window).height();
	var windowscrollpostop=$(window).scrollTop();
	var windowpostbottom=windowscrollpostop + windowheight;
		
	$.fn.revealonscroll=function(){
    
    return this.each(function(direction){
		var objectoffset=$(this).offset();
		var objectoffsettop=objectoffset.top;
		
		if(!$(this).hasClass("hidden")){
       
      //if(direction=="right"){
        //   $(this).css({
          //  "opacity": .1,
            // "right ": "10%"
          // });

        // }else{

         // $(this).css({
          //  "opacity": .1,
           //  "right ": "-10%"
          // });

     // }

      $(this).css("opacity",.1).addClass("hidden");
     // $(this).addClass("hidden");
		}
		
		if(!$(this).hasClass("animation-complete")){
			if(windowpostbottom > objectoffsettop){
      
         $(this).animate({"opacity": 1},4000).addClass("animation-complete");
        //$(this).animate({"opacity": 1,"right":.1},4000).addClass("animation-complete");
			}
			
		}
			
		});
	}// end of function

$(window).scroll(function(){
    windowheight=$(window).height();
    windowscrollpostop=$(window).scrollTop();
    windowpostbottom=windowheight + windowscrollpostop;

    $('.square-image1').revealonscroll();  
    $('.square-image2').revealonscroll();
    $('.square-image3').revealonscroll();
    $('.rectangle').revealonscroll();
    $('.circle').revealonscroll();
    $('.couple-image').revealonscroll();
    $('.status').revealonscroll(); 
  });

});


========================


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
      sessionStorage.clear();
     sessionStorage.setItem("mdata1", all[0]);
     sessionStorage.setItem("mdata2", all[1]);
     // window.location = "http://staging.firmanpowerequipment.com/product-table/?mynum=" + all[0];
     // window.location = "plugins_url('assets/js/compare_table_index.js')?mynum=" + all[1];
      // localStorage.clear();
     //localStorage.setItem("cdotribe", JSON.stringify(all[i]));


    $('.select_product_plate').html("<a href='http://staging.firmanpowerequipment.com/product-table/'>Compare 2 products</a>");
     //doAjax();
 
    $('.select_product_plate').show();       
}  

   if(i==3){  d3=x;	
       sessionStorage.clear();
       sessionStorage.setItem("mdata1", all[0]);
       sessionStorage.setItem("mdata2", all[1]);
       sessionStorage.setItem("mdata3", all[2]);

    // localStorage.clear();
   //  sessionStorage.setItem("cdotribe",JSON.stringify(all[i]));

    $('.select_product_plate').html("<a href='http://staging.firmanpowerequipment.com/product-table/'>Compare 3 products</a>");
    $('.select_product_plate').show();
     }

 } 

  $(':checkbox').on("change",function(){      
   showData();    
});


/*
var int_val=111;
url="assets/templates/custom-template.php";
    function doAjax()
      {
       var xmlhttp;
             xmlhttp=new XMLHttpRequest();
              xmlhttp.open("GET","url?v="+int_val,true);
             xmlhttp.send();
      }
*/  

});

