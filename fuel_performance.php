<?php 

include("consts.php");
include("valuesFromInputs.php");

//1 кубометр = 1000 литров ; 1 час = 3600 секунд
$FuelConsumption_ThousandM3_Year = $first_quarter + $second_quarter + $third_quarter + $fourth_quarter;
print_r('Тыс. М3/год: ' . $FuelConsumption_ThousandM3_Year . '<br>');

// max из 4-х кварталов, переводим из тыс.м3 в м3
$unknown = 2160;
$FuelConsumption_M3_Hour = round(((max($first_quarter, $second_quarter, $third_quarter, $fourth_quarter) * 1000) / (double)$unknown), 3);
print_r('М3/час: ' . $FuelConsumption_M3_Hour . '<br>');

// Переводим из м3/час на литры в секунду
$FuelConsumption_Litrs_Second = round(($FuelConsumption_M3_Hour * 1000 / 3600), 3);
print_r('Литры/секунду: ' . $FuelConsumption_Litrs_Second . '<br>');

//В 1 калории = 4.18 Дж
$HeatOfCombustion_MDj_M3 = round(((Q_KKAL * 1000 * 4.18) / 1000000), 3);
print_r('МегаДжоули/метр кубический (М3): ' . $HeatOfCombustion_MDj_M3 . '<br>');

echo '<hr>';
echo '<br>Таблица по 1-4 формулам<br>' . '<br>';
//Расчёт выброса окиси углерода
echo 'Первая формула: <br>' ;

$Mco = round((0.001 * $FuelConsumption_ThousandM3_Year * $HeatOfCombustion_MDj_M3 * K_CO * (1 - Q4/100)), 3);
print_r('Mco :  ' . $Mco . '<br>');

//1 литр = 1 грамм; 1 квадратный метр = 1 кг; 1000 М^2  =  1000 кг;
$Mco_gramm_sec = round((0.001 * $FuelConsumption_Litrs_Second * $HeatOfCombustion_MDj_M3 * K_CO * (1 - Q4/100)), 3);
print_r('Mco_gramm_sec :  ' . $Mco_gramm_sec . '<br>');

//Расчёт выброса диоксида азота
echo  '<br>' . 'Вторая формула: <br>' ;
$Mco = round((0.001 * $FuelConsumption_ThousandM3_Year * $HeatOfCombustion_MDj_M3 * K_NO2 * (1 - BETA)), 3);
print_r('Mco :  ' . $Mco . '<br>');
$Mno2_gramm_sec = round((0.001 * $FuelConsumption_Litrs_Second * $HeatOfCombustion_MDj_M3 * K_NO2 * (1 - BETA)), 3);
print_r('Mno2_gramm_sec :  ' . $Mno2_gramm_sec . '<br>');

//Количество отходячих газов
echo  '<br>' . 'Третья формула: <br>' ;
$L = round(($FuelConsumption_M3_Hour * AIR_V * ALPHA),3);
$L_metr_sec = round(($L / 3600),3);
print_r('Количество отходячих газов - L :  ' . $L . '<br>');
print_r('Количество отходячих газов - L_metr_sec :  ' . $L_metr_sec . '<br>');

//Концентрация вредных веществ в отходящих газах
echo  '<br>' . 'Четвёртая формула: <br>' ;
$Cco = round((($Mco_gramm_sec * 1000) / $L_metr_sec),3);
print_r('Концентрация вредных веществ - C_CO :  ' . $Cco . '<br>');
$Cno2 = round((($Mno2_gramm_sec * 1000) / $L_metr_sec),3);
print_r('Концентрация вредных веществ - C_NO2 :  ' . $Cno2 . '<br>');

// Для четвертой таблицу осталось расчитать площадь
$S = round(((M_PI * $D**2) / 4),3);
print_r('Площадь - S :  ' . $S . '<br>');
echo '<hr>';

echo  '<br>' . '10-ая формула: <br>' ;
$W0 = round(((4 * $L_metr_sec) / (M_PI * $D**2)),3);
print_r('W0 :  ' . $W0 . '<br>');
$f = round(1000 * (($W0**2 * $D) / ($H**2 * $delta_T)), 3);
print_r('f :  ' . $f . '<br>');

echo  '<br>' . '11-ая формула: <br>' ;
$Vm = round((0.65 * pow((($L_metr_sec * $delta_T) / $H), 1/3)),3);
print_r('Vm :  ' . $Vm . '<br>');

echo  '<br>' . '12-ая формула: <br>' ;
$V__m = round((1.3 * (($W0 * $D) / $H)),3);
print_r('V__m (Vm со штрихом) :  ' . $V__m . '<br>');

echo  '<br>' . '13-ая формула: <br>' ;
$f_e = round((800 * $V__m**3),3);
print_r('f_e :  ' . $f_e . '<br>');

echo '<hr>';

//Алгортим расчета рассеивания загрязняющих веществ в атмосферном воздухе для:
if (($f <= 100) && ($Vm > 0.5)) { // нагретых выбросов
   if ($f_e >= $f) {
      $m = round((1 / (0.67 + (0.1*sqrt($f)) + 0.34*pow($f, 1/3))),3);
      print_r('m из первой версии:  ' . $m . '<br>');
      if (($Vm >= 0.5) && ($Vm < 2)) {
         $n = round((0.532 * ($Vm**2) - 2.13 * $Vm + 3.13), 3);
         print_r('n из первой версии:  ' . $n . '<br>');
         $d = round(4.95 * $Vm * (1 + 0.28 * pow($f, 1/3)),3);
         print_r('d из первой версии:  ' . $d . '<br>');
         $Um = $Vm;
         print_r('Um из первой версии:  ' . $Um . '<br>');
         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         print_r('C_co из первой версии:  ' . $C_co . '<br>');
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         print_r('C_no2 из первой версии:  ' . $C_no2 . '<br>');
         $Xm = round((((5 - F) / 4) * $d * $H),3);
         print_r('Xm из первой версии:  ' . $Xm . '<br>');
         if ($C_co > $PDK_CO) {
            $variable = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_CO / $C_co),3);
            print_r('ПДК/Сm  C_co из первой версии:  ' . $variable . '<br>');
            $PDV_co = $Mco_gramm_sec;
            $C_PDV_co = round(($Mco_gramm_sec / ($L_metr_sec * 1000)),5);
            print_r('C_PDV_co из первой версии:  ' . $C_PDV_co . '<br>');
         }

         if ($C_no2 > $PDK_NO2) {
            $variable = round(($C_no2 / $PDK_NO2),3);
            
            $PDV_no2 = round(((($PDK_NO2 * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_no2 = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_NO2 / $C_no2),3);
            print_r('ПДК/Сm  C_no2 из первой версии:  ' . $variable . '<br>');
            $PDV_no2 = $Mno2_gramm_sec;
            $C_PDV_no2 = round(($Mno2_gramm_sec / ($L_metr_sec * 1000)),5);
            print_r('C_PDV_no2 из первой версии:  ' . $C_PDV_no2 . '<br>');
         }

      } else if ($Vm > 2) {
         $n = 1;
         $d = round((7 * sqrt($Vm) * (1 + 0.28 * pow($f, 1/3))),3);
         $Um = round(($Vm * (1 + 0.12 * sqrt($f))),3);


         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $Xm = round((((5 - F) / 4) * $d * $H),3);
         if ($C_co > $PDK_CO) {
            $variable = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_CO / $C_co),3);
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
      $m = round((1 / (0.67 + (0.1*sqrt($f_e)) + 0.34*pow($f_e, 1/3))),3);

      if (($Vm >= 0.5) && ($Vm < 2)) {
         $n = round((0.532 * ($Vm**2) - 2.13 * $Vm + 3.13), 3);
         $d = round(4.95 * $Vm * (1 + 0.28 * pow($f, 1/3)),3);
         $Um = $Vm;
         $C_co = round(((A * $Mco_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $C_no2 = round(((A * $Mno2_gramm_sec * F * $m * $n) / ($H**2 * pow($L_metr_sec * $delta_T, 1/3))),3);
         $Xm = round((((5 - F) / 4) * $d * $H),3);
         if ($C_co > $PDK_CO) {
            $variable = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_CO / $C_co),3);
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
            $variable = round(($C_co / $PDK_CO),3);
            $PDV_co = round(((($PDK_CO * $H**2) / (A * F * $m * $n)) * pow($L_metr_sec * $delta_T, 1/3)),3);
            $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
         } else {
            $variable = round(($PDK_CO / $C_co),3);
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
         $variable = round(($C_co / $PDK_CO),3);
         $PDV_co = round(((($PDK_CO * pow($H, 4/3)) / (A * F * $n__ * $K)) ),3);
         $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
      } else {
         $variable = round(($PDK_CO / $C_co),3);
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
         $variable = round(($C_co / $PDK_CO),3);
         $PDV_co = round(((($PDK_CO * pow($H, 4/3)) / (A * F * $n__ * $K)) ),3);
         $C_PDV_co = round(($PDV_co / ($L_metr_sec * 1000)),5);
      } else {
         $variable = round(($PDK_CO / $C_co),3);
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

//Нужно превратить всё хотя бы в функции
// А то читать и понимать - становится тяжко
echo '<hr>';

//Концентрация вредности на любом растоянии от источника
$x_array = array($Xm - 80, $Xm - 60, $Xm - 40, $Xm - 20, $Xm, $Xm + 20, $Xm + 40, $Xm + 60, $Xm + 80);

foreach ($x_array as $x_value) {
   #echo $x_value . '<br>';
   if (($x_value/$Xm) <= 1) {
      $S_value = round((3 * (($x_value/$Xm)**4) - 8 * (($x_value/$Xm)**3) + 6 * ($x_value/$Xm)**2),3);
      print_r('Si для формулы:  ' . $S_value . '<br>');
   }
   else if ((($x_value/$Xm) > 1) && (($x_value/$Xm) <= 8)) {
      $S_value = round((1.13 / (0.13 * (($x_value/$Xm)**2) + 1 )),3);
      print_r('Si для формулы:  ' . $S_value . '<br>');
   }
   else {
      echo 'Невозможно посчитать!';
   }
   
   $C_value_co = round(($S_value * $C_co),3);
   print_r('C_value_co (окончательный ответ для СО:  ' . $C_value_co . '<br>');
   $C_value_no2 = round(($S_value * $C_no2),3);
   print_r('C_value_no2 (окончательный ответ для NO2:  ' . $C_value_no2 . '<br>');
}

?>