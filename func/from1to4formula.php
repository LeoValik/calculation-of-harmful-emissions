<?php

include("consts.php");
include("valuesFromInputs.php");

#echo '<hr>';
#echo '<br>Таблица по 1-4 формулам<br>' . '<br>';
//Расчёт выброса окиси углерода
#echo 'Первая формула: <br>' ;

$Mco = round((0.001 * $FuelConsumption_ThousandM3_Year * $HeatOfCombustion_MDj_M3 * K_CO * (1 - Q4/100)), 3);
#print_r('Mco :  ' . $Mco . '<br>');

//1 литр = 1 грамм; 1 квадратный метр = 1 кг; 1000 М^2  =  1000 кг;
$Mco_gramm_sec = round((0.001 * $FuelConsumption_Litrs_Second * $HeatOfCombustion_MDj_M3 * K_CO * (1 - Q4/100)), 3);
#print_r('Mco_gramm_sec :  ' . $Mco_gramm_sec . '<br>');

//Расчёт выброса диоксида азота
#echo  '<br>' . 'Вторая формула: <br>' ;
$Mco = round((0.001 * $FuelConsumption_ThousandM3_Year * $HeatOfCombustion_MDj_M3 * K_NO2 * (1 - BETA)), 3);
#print_r('Mco :  ' . $Mco . '<br>');
$Mno2_gramm_sec = round((0.001 * $FuelConsumption_Litrs_Second * $HeatOfCombustion_MDj_M3 * K_NO2 * (1 - BETA)), 3);
#print_r('Mno2_gramm_sec :  ' . $Mno2_gramm_sec . '<br>');

//Количество отходячих газов
#echo  '<br>' . 'Третья формула: <br>' ;
$L = round(($FuelConsumption_M3_Hour * AIR_V * ALPHA),3);
$L_metr_sec = round(($L / 3600),3);
#print_r('Количество отходячих газов - L :  ' . $L . '<br>');
#print_r('Количество отходячих газов - L_metr_sec :  ' . $L_metr_sec . '<br>');

//Концентрация вредных веществ в отходящих газах
#echo  '<br>' . 'Четвёртая формула: <br>' ;
$Cco = round((($Mco_gramm_sec * 1000) / $L_metr_sec),3);
#print_r('Концентрация вредных веществ - C_CO :  ' . $Cco . '<br>');
$Cno2 = round((($Mno2_gramm_sec * 1000) / $L_metr_sec),3);
#print_r('Концентрация вредных веществ - C_NO2 :  ' . $Cno2 . '<br>');

// Для четвертой таблицу осталось расчитать площадь
$S = round(((M_PI * $D**2) / 4),3);
#print_r('Площадь - S :  ' . $S . '<br>');
#echo '<hr>';


?>