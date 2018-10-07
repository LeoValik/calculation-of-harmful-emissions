<?php

include("consts.php");
include("valuesFromInputs.php");
include("func/firstTable.php");
include("func/from1to4formula.php");


#echo  '<br>' . '10-ая формула: <br>' ;
$W0 = round(((4 * $L_metr_sec) / (M_PI * $D**2)),3);
#print_r('W0 :  ' . $W0 . '<br>');
$f = round(1000 * (($W0**2 * $D) / ($H**2 * $delta_T)), 3);
#print_r('f :  ' . $f . '<br>');

#echo  '<br>' . '11-ая формула: <br>' ;
$Vm = round((0.65 * pow((($L_metr_sec * $delta_T) / $H), 1/3)),3);
#print_r('Vm :  ' . $Vm . '<br>');

#echo  '<br>' . '12-ая формула: <br>' ;
$V__m = round((1.3 * (($W0 * $D) / $H)),3);
#print_r('V__m (Vm со штрихом) :  ' . $V__m . '<br>');

#echo  '<br>' . '13-ая формула: <br>' ;
$f_e = round((800 * $V__m**3),3);
#print_r('f_e :  ' . $f_e . '<br>');

#echo '<hr>';
?>