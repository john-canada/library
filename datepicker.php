<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
		$(document).ready(function(){

            $.datepicker.setDefaults({ dateFormat:'mm-dd-yy'});
            
            $('#filter').click(function(){
                var from_date=$('#date_from').val();
                var to_date=$('#date_to').val();
               // var d=to_date.getDate()-from_date.getDate();
                var from_date=new Date(from_date);
                var to_date=new Date(to_date);
                
                var timeDiff = Math.abs(to_date.getTime() - from_date.getTime());
                var hours=Math.ceil(timeDiff / (1000 * 60 * 60));
                var minutes=Math.ceil(timeDiff / (1000 * 60 ));
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                
                  if(from_date !='' && to_date !=''){
                       alert("Days  :" +"  "+ diffDays);
                       alert("Hours  :" +"  "+ hours);
                       alert("minutes  :" +"  "+ minutes);                       
                   }else{
                   alert('not');
                  }
            });
      
            $(function(){
		      	$('#date_from').datepicker();
		        $('#date_to').datepicker();
		    	});
			});

	</script>

    <style>

    .wrapper{
        display:grid;
        /*grid-template-columns:1fr 1fr; 
        grid-template-columns:repeat(2,3fr);*/
        grid-template-columns:repeat(4,2fr);
        grid-gap:1em;
        padding:10px;
        border-radius:10px;
        grid-auto-rows:minmax(100px,auto);
    }
      
    .wrapper > div{
        background:#eee;
    }

    .wrapper > div:nth-child(odd){
        background:#f4f4f4;
    }

    </style>
    </head>	

  <body>         
             <div class="container">
               <div class="row">
                 <div class="form-group">
                 <div>      
                  <form method="post" action="">  
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" ></div>
                   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" > 
                  <input class="form-control" type="text" name="date_from" id="date_from">
                   </div>
                   </div>

				   <div>
                   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" ></div>
                   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" > 
                   <input class="form-control" type="text" name="date_to" id="date_to" >
                   </div>
                   </div>

                   <div>
				   <input type="submit" class="btn btn-primary" name="filter" id="filter" value="Filter" >
                   </div>
                  </form>
                  </div>
                  </div>
               </div>
              </body>
			</html>