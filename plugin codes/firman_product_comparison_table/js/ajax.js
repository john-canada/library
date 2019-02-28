


<div ng-app="myApp" ng-controller="myCtrl">
Name: <input ng-model="name">
<h1>You entered: {{name}}</h1>
</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    $scope.name = "John Doe";
});
</script>



  jQuery(document).ready(function($){
    function showData(){
        var str = "";
         var i=0;
        $(':checkbox').each(function() {
          // str += this.checked ? "1," : "0,";
          if(this.checked ){
          i=i+1;  

        //  alert(this.value);
            
          } 
       }); 
      //  str = str.substr(0, str.length - 1); 
    //  console.log(str);

        if(i==1){
      alert("add more" + i);
      }
    
   if(i==2){
        alert("Total product " + i +  "  Compare product ");
     }  

    if(i==3){
        alert("Total product " + i +  "  Compare product" );
     }
      
     }

   
    $(':checkbox').on("change",function(){
     showData();
    });
     alert('this test 25'); 
  });

