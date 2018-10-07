<?php

include("consts.php");
include("valuesFromInputs.php");
include("func/algoritms.php");

#echo '<hr>';

//Концентрация вредности на любом растоянии от источника
$x_array = array($Xm - 80, $Xm - 60, $Xm - 40, $Xm - 20, $Xm, $Xm + 20, $Xm + 40, $Xm + 60, $Xm + 80);
$result_cco = [];
$result_cno2 = [];

foreach ($x_array as $x_value) {
   #echo $x_value . '<br>';
   if (($x_value/$Xm) <= 1) {
      $S_value = round((3 * (($x_value/$Xm)**4) - 8 * (($x_value/$Xm)**3) + 6 * ($x_value/$Xm)**2),3);
      #print_r('Si для формулы:  ' . $S_value . '<br>');
   }
   else if ((($x_value/$Xm) > 1) && (($x_value/$Xm) <= 8)) {
      $S_value = round((1.13 / (0.13 * (($x_value/$Xm)**2) + 1 )),3);
      #print_r('Si для формулы:  ' . $S_value . '<br>');
   }
   else {
      echo 'Невозможно посчитать!';
   }
   
   $C_value_co = round(($S_value * $C_co),3);
   $result_cco[] = $C_value_co;
   #print_r('C_value_co (окончательный ответ для СО:  ' . $C_value_co . '<br>');
   
   $C_value_no2 = round(($S_value * $C_no2),3);
   $result_cno2[] = $C_value_no2;
   #print_r('C_value_no2 (окончательный ответ для NO2:  ' . $C_value_no2 . '<br>');




}

?>