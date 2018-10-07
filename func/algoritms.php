<?php

include("consts.php");
include("valuesFromInputs.php");
include("func/from10to14formula.php");

function Variable_M ($variable) {
   return $result = round((1 / (0.67 + (0.1*sqrt($variable)) + 0.34*pow($variable, 1/3))),3); 
 }


//Алгортим расчета рассеивания загрязняющих веществ в атмосферном воздухе для:
if (($f <= 100) && ($Vm > 0.5)) { // нагретых выбросов
   if ($f_e >= $f) {
      //$m = round((1 / (0.67 + (0.1*sqrt($f)) + 0.34*pow($f, 1/3))),3);
      $m = Variable_M($f);
      #print_r('m из первой версии:  ' . $m . '<br>');
      if (($Vm >= 0.5) && ($Vm < 2)) {
         $n = round((0.532 * ($Vm**2) - 2.13 * $Vm + 3.13), 3);
        # print_r('n из первой версии:  ' . $n . '<br>');
         $d = round(4.95 * $Vm * (1 + 0.28 * pow($f, 1/3)),3);
       #  print_r('d из первой версии:  ' . $d . '<br>');
         $Um = $Vm;
       #  print_r('Um из первой версии:  ' . $Um . '<br>');
         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
       #  print_r('C_co из первой версии:  ' . $C_co . '<br>');
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
        # print_r('C_no2 из первой версии:  ' . $C_no2 . '<br>');
         $Xm = round((((5 - F) / 4) * $d * $H),3);
       #  print_r('Xm из первой версии:  ' . $Xm . '<br>');
         if ($C_co > $PDK_CO) {
            $variable_co = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable_co = round(($PDK_CO / $C_co),3);
          #  print_r('ПДК/Сm  C_co из первой версии:  ' . $variable_co . '<br>');
            $PDV_co = $Mco_gramm_sec;
            $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
            #$C_PDV_co = Variable_C_PDV($Mco_gramm_sec);
         #   print_r('C_PDV_co из первой версии:  ' . $C_PDV_co . '<br>');
         }

         if ($C_no2 > $PDK_NO2) {
            $variable = round(($C_no2 / $PDK_NO2),3);
            
            $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_NO2 / $C_no2),3);
          #  print_r('ПДК/Сm  C_no2 из первой версии:  ' . $variable . '<br>');
            $PDV_no2 = $Mno2_gramm_sec;
            $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
            #$C_PDV_no2 = Variable_C_PDV($Mno2_gramm_sec);
          #  print_r('C_PDV_no2 из первой версии:  ' . $C_PDV_no2 . '<br>');
         }

      } else if ($Vm > 2) {
         $n = 1;
         $d = round((7 * sqrt($Vm) * (1 + 0.28 * pow($f, 1/3))),3);
         $Um = round(($Vm * (1 + 0.12 * sqrt($f))),3);


         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $Xm = round((((5 - F) / 4) * $d * $H),3);
         if ($C_co > $PDK_CO) {
            $variable_co = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable_co = round(($PDK_CO / $C_co),3);
            $PDV_co = $Mco_gramm_sec;
            $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
         }

         if ($C_no2 > $PDK_NO2) {
            $variable = round(($C_no2 / $PDK_NO2),3);
            $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_NO2 / $C_no2),3);
            $PDV_no2 = $Mno2_gramm_sec;
            $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
         }


      } 
   } else {
      //$m = round((1 / (0.67 + (0.1*sqrt($f_e)) + 0.34*pow($f_e, 1/3))),3);
      $m = Variable_M($f);

      if (($Vm >= 0.5) && ($Vm < 2)) {
         $n = round((0.532 * ($Vm**2) - 2.13 * $Vm + 3.13), 3);
         $d = round(4.95 * $Vm * (1 + 0.28 * pow($f, 1/3)),3);
         $Um = $Vm;
         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $Xm = round((((5 - F) / 4) * $d * $H),3);
         if ($C_co > $PDK_CO) {
            $variable_co = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable_co = round(($PDK_CO / $C_co),3);
            $PDV_co = $Mco_gramm_sec;
            $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
         }

         if ($C_no2 > $PDK_NO2) {
            $variable = round(($C_no2 / $PDK_NO2),3);
            $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_NO2 / $C_no2),3);
            $PDV_no2 = $Mno2_gramm_sec;
            $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
         }

      } else if ($Vm > 2) {
         $n = 1;
         $d = round((7 * sqrt($Vm) * (1 + 0.28 * pow($f, 1/3))),3);
         $Um = round(($Vm * (1 + 0.12 * sqrt($f))),3);


         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $Xm = round((((5 - F) / 4) * $d * $H),3);
         if ($C_co > $PDK_CO) {
            $variable_co = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable_co = round(($PDK_CO / $C_co),3);
            $PDV_co = $Mco_gramm_sec;
            $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
         }

         if ($C_no2 > $PDK_NO2) {
            $variable = round(($C_no2 / $PDK_NO2),3);
            $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_NO2 / $C_no2),3);
            $PDV_no2 = $Mno2_gramm_sec;
            $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
         }


      }       



   }
} else if (($f >= 100) && ($V__m > 0.5)) { // холодных выбросов

   $K = round(($D / (8 * $L_metr_sec)),3);

   if ($V__m >= 2) {
      $n__ = 1;
      $d__ = round((16 * sqrt($V__m)),3);
      $Um = round((2.2 * $Vm),3);
      
      $C_co = round(((A * $Mco_gramm_sec * F * $n__ *  $K) / pow($H, 4/3)),3);
      $C_no2 = round(((A * $Mno2_gramm_sec * F * $n__ *  $K) / pow($H, 4/3)),3);
      $Xm = round((((5 - F) / 4) * $d__ * $H),3);

      if ($C_co > $PDK_CO) {
         $variable_co = round(($C_co / $PDK_CO),3);
         $PDV_co = round(((($PDK_CO * pow($H, 4/3)) / (A * F * $n__ * $K)) ),3);
         $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
      } else {
         $variable_co = round(($PDK_CO / $C_co),3);
         $PDV_co = $Mco_gramm_sec;
         $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
      }

      if ($C_no2 > $PDK_NO2) {
         $variable = round(($C_no2 / $PDK_NO2),3);
         $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
         $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
      } else {
         $variable = round(($PDK_NO2 / $C_no2),3);
         $PDV_no2 = $Mno2_gramm_sec;
         $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
      }

   }

   else if (($V__m > 0.5) && ($V__m < 2)) {
      $n__ = round((0.532 * $V__m**2 - 2.13 * $V__m + 3.13),3);
      $d__ = round((11.4 * $V__m),3);
      $Um = $V__m;

      $C_co = round(((A * $Mco_gramm_sec * F * $n__ *  $K) / pow($H, 4/3)),3);
      $C_no2 = round(((A * $Mno2_gramm_sec * F * $n__ *  $K) / pow($H, 4/3)),3);
      $Xm = round((((5 - F) / 4) * $d__ * $H),3);

      if ($C_co > $PDK_CO) {
         $variable_co = round(($C_co / $PDK_CO),3);
         $PDV_co = round(((($PDK_CO * pow($H, 4/3)) / (A * F * $n__ * $K)) ),3);
         $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
      } else {
         $variable_co = round(($PDK_CO / $C_co),3);
         $PDV_co = $Mco_gramm_sec;
         $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
      }

      if ($C_no2 > $PDK_NO2) {
         $variable = round(($C_no2 / $PDK_NO2),3);
         $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
         $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
      } else {
         $variable = round(($PDK_NO2 / $C_no2),3);
         $PDV_no2 = $Mno2_gramm_sec;
         $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
      }


   }
} else {
   echo 'Невозможно вычеслить! Не совпадает с условиями! Попробуйте в другой раз! ';
} // Для третей версии пока не делается, а там - посмотрим

?>