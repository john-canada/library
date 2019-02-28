<!DOCTYPE html>
<html>
<body>

    <?php
        $cars = array("Volvo", "BMW", "Toyota");
        sort($cars);

        $clength = count($cars);
        for($x = 0; $x < $clength; $x++) {
            echo $cars[$x];
            echo "<br>";
        }



        $ar= array(1,7,3,6,5,4);
        sort($ar);
          $count=count($ar);
          for ($x=0; $x<$count;$x++){
         echo $ar[$x];
       }
   
  
      $ar2= array(1,7,3,6,5,4);
        rsort($ar2);
          $count=count($ar2);
          for ($y=0; $y<$count;$y++){
         echo $ar2[$y];
       }
  
       echo strrev("Hello world!"); // outputs !dlrow olleH
  
       echo strlen("Hello world!"); // outputs 12
  
      $replace = array("1: AAA","2: AAA","3: AAA");
  
      // Replace AAA in each string with BBB
      echo implode("<br>",substr_replace($replace,'BBB',3,3));
  
      echo strpos("Hello world!", "world"); // outputs 6 The PHP strpos() function searches for a specific text within a string.
  
      echo str_replace("world", "Dolly", "Hello world!"); // outputs Hello Dolly!

      $x = 5985;
var_dump($x);//return datatype and value

    ?>

</body>
</html>