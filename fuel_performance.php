<?php 

include("consts.php");
include("valuesFromInputs.php");
include("func/XmAndCmFinal.php");

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Расчёт вредных выбросов в атмосферу от котельных работающих на газообразном топливе</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
  <!-- <script src="main.js"></script> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>

   <div class="container">
      <div class="table-responsive">
         <table class="table table-bordered"  cellpadding="10">
           <h3>Характеристика топлива</h3>
           <thead>
                  <tr>
                     <th rowspan="2">Вид топлива</th>
                     <th colspan="3">Расход топлива В</th>
                     <th colspan="2">Теплота сгорания Q</th>
                     <th>удел. расх. воздуха V</th>
                  </tr>
                  <tr>
                     
                     <th>л/с</th>
                     <th>м<sup>3</sup>/ч</th>
                     <th>тыс. м<sup>3</sup> / год</th>
                     <th>Ккал/м<sup>3</sup></th>
                     <th>МДж/м<sup>3</sup></th>
                     <th>м<sup>3</sup>/м<sup>3</sup></th>
                  </tr>
            </thead>
            <tbody>
                  <tr>
                     <td>Природный газ</td>
                     <td><?php echo $FuelConsumption_ThousandM3_Year; ?></td>
                     <td><?php echo $FuelConsumption_M3_Hour; ?></td>
                     <td><?php echo $FuelConsumption_Litrs_Second; ?></td>
                     <td><?php echo Q_KKAL; ?></td>
                     <td><?php echo $HeatOfCombustion_MDj_M3; ?></td>
                     <td><?php echo AIR_V; ?></td>
                  </tr>
            </tbody>
         </table>
      </div>

<div class="table-responsive">
         <table class="table table-bordered"  cellpadding="10">
           <h3>Значения некоторых коэффициентов</h3>
           <thead>
                  <tr>
                     <th>&alpha;</th>
                     <th>q<sub>4</sub></th>
                     <th>КСО</th>
                     <th>KNO<sub>2</sub></th>
                     <th>&beta;</th>
                  </tr>
            </thead>
            <tbody>
                  <tr>
                     <td><?php echo ALPHA; ?></td>
                     <td><?php echo Q4; ?></td>
                     <td><?php echo K_CO; ?></td>
                     <td><?php echo K_NO2; ?></td>
                     <td><?php echo BETA; ?></td>
                  </tr>
            </tbody>
         </table>
      </div>

<div class="table-responsive">
         <table class="table table-bordered"  cellpadding="10">
           <h3>Таблица 4</h3>
           <thead>
                  <tr>
                     <th>Q<br>м<sup>3</sup>/ч</th>
                     <th>D<br>м</th>
                     <th>S<br>м<sup>2</sup></th>
                     <th>V<sub>1</sub><br>м<sup>3</sup>/c</th>
                     <th>A<br></th>
                     <th>H<br>м</th>
                     <th>&#916; T,<br> град.</th>
                     <th>F<br></th>
                     <th>C<br>мг/м<sup>3</sup></th>
                     <th>М<br>г/с</th>
                     <th>ПДК<br>мг/м<sup>3</sup></th>
                     <th>код<br></th>
                     <th>название<br></th>
                  </tr>
            </thead>
            <tbody>
                  <tr>
                     <td><?php echo ALPHA; ?></td>
                     <td><?php echo $D; ?></td>
                     <td><?php echo $S; ?></td>
                     <td><?php echo $L_metr_sec; ?></td>
                     <td><?php echo A; ?></td>
                     <td><?php echo $H; ?></td>
                     <td><?php echo $delta_T; ?></td>
                     <td><?php echo F; ?></td>
                     <td><?php echo ($Cco . '<br>' . $Cno2); ?></td>
                     <td><?php echo ($Mco_gramm_sec . '<br>' . $Mno2_gramm_sec); ?></td>
                     <td><?php echo ($PDK_CO . '<br>' . $PDK_NO2); ?></td>
                     <td>0301<br>0309</td>
                     <td>CO<br>NO<sub>2</sub></td>
                  </tr>
            </tbody>
         </table>
      </div>

<div class="table-responsive">
         <table class="table table-bordered"  cellpadding="10">
           <h3>Экологическая оценка источника выброса вредных веществ в атмосферу на ЭВМ</h3>
           <thead>
                  <tr>
                     <th>f</th>
                     <th>W<sub>0</sub></th>
                     <th>V<sub>m</sub></th>
                     <th>V'<sub>m</sub></th>
                     <th>f<sub>e</sub></th>
                  </tr>
            </thead>
            <tbody>
                  <tr>
                     <td><?php echo $f; ?></td>
                     <td><?php echo $W0; ?></td>
                     <td><?php echo $Vm; ?></td>
                     <td><?php echo $V__m; ?></td>
                     <td><?php echo $f_e; ?></td>
                  </tr>
            </tbody>
         </table>
      </div>

<div class="table-responsive">
         <table class="table table-bordered"  cellpadding="10">
           <h3>Расчёт рассеивания загрязняющих веществ в атмосферном воздухе для 
           <?php if (($f <= 100) && ($Vm > 0.5)) {echo 'нагретых выбросов'; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo 'холодных выбросов';}  ?></h3>
           <thead>
                  <tr>
                     <th><?php if (($f <= 100) && ($Vm > 0.5)) {echo 'm'; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo 'K';}  ?></th>
                     <th><?php if (($f <= 100) && ($Vm > 0.5)) {echo 'n'; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo "n'";}  ?></th>
                     <th><?php if (($f <= 100) && ($Vm > 0.5)) {echo 'd'; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo "d'";} ?> </th>
                     <th>U<sub>m</sub></th>
                     <th>C CO</th>
                     <th>C NO<sub>2</sub></th>
                     <th>X<sub>m</sub></th>
                     <th><?php if ($C_co > $PDK_CO) {echo 'C CO / ПДК'; } 
                        else  {echo 'ПДК / С СО';}  ?></th>
                     <th><?php if ($C_no2 > $PDK_CO) {echo 'C NO<sub>2</sub> / ПДК'; } 
                        else  {echo 'ПДК / C NO<sub>2</sub>';}  ?></th>
                     <th>ПДВ СО</th>
                     <th>С пдв СО</th>
                     <th>ПДВ NO<sub>2</sub></th>
                     <th>С пдв NO<sub>2</sub></th>
                  </tr>
            </thead>
            <tbody>
                  <tr>
                     <td><?php if (($f <= 100) && ($Vm > 0.5)) {echo $m; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo $K;}  ?></td>
                     <td><?php if (($f <= 100) && ($Vm > 0.5)) {echo $n; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo $n__;}  ?></td>
                     <td><?php if (($f <= 100) && ($Vm > 0.5)) {echo $d; } 
           else if (($f >= 100) && ($V__m > 0.5)) {echo $d__;}  ?></td>
                     <td><?php echo $Um; ?></td>
                     <td><?php echo $C_co; ?></td>
                     <td><?php echo $C_no2; ?></td>
                     <td><?php echo $Xm; ?></td>
                     <td><?php echo $variable_co; ?></td>
                     <td><?php echo $variable; ?></td>
                     <td><?php echo $PDV_co; ?></td>
                     <td><?php echo $C_PDV_co; ?></td>
                     <td><?php echo $PDV_no2; ?></td>
                     <td><?php echo $C_PDV_no2; ?></td>                    
                  </tr>
            </tbody>
         </table>
      </div>


<div class="table-responsive">
         <table class="table table-bordered"  cellpadding="10">
           <h3>Концентрация вредности на любом растоянии от источника</h3>
           <thead>
                  <tr>
                     <th>Элемент</th>
                     <th><?php echo $x_array[0]; ?></th>
                     <th><?php echo $x_array[1]; ?></th>
                     <th><?php echo $x_array[2]; ?></th>
                     <th><?php echo $x_array[3]; ?></th>
                     <th><?php echo $x_array[4]; ?></th>
                     <th><?php echo $x_array[5]; ?></th>
                     <th><?php echo $x_array[6]; ?></th>
                     <th><?php echo $x_array[7]; ?></th>
                     <th><?php echo $x_array[8]; ?></th>
                  </tr>
            </thead>
            <tbody>
            
                  <tr>
                     <td>CO</td>
                     <td><?php echo $result_cco[0]; ?></td> <?php //echo ('C CO :' $C_value_co_array[0] . '<br>' . 'C NO<sub>2</sub> :' . $C_value_no2_array[0]); ?>
                     <td><?php echo $result_cco[1]; ?></td>
                     <td><?php echo $result_cco[2]; ?></td>
                     <td><?php echo $result_cco[3]; ?></td>
                     <td><?php echo $result_cco[4]; ?></td>
                     <td><?php echo $result_cco[5]; ?></td>
                     <td><?php echo $result_cco[6]; ?></td>
                     <td><?php echo $result_cco[7]; ?></td>
                     <td><?php echo $result_cco[8]; ?></td>
                  </tr>

                  <tr>
                     <td>NO<sub>2</sub></td>
                     <td><?php echo $result_cno2[0]; ?></td> <?php //echo ('C CO :' $C_value_co_array[0] . '<br>' . 'C NO<sub>2</sub> :' . $C_value_no2_array[0]); ?>
                     <td><?php echo $result_cno2[1]; ?></td>
                     <td><?php echo $result_cno2[2]; ?></td>
                     <td><?php echo $result_cno2[3]; ?></td>
                     <td><?php echo $result_cno2[4]; ?></td>
                     <td><?php echo $result_cno2[5]; ?></td>
                     <td><?php echo $result_cno2[6]; ?></td>
                     <td><?php echo $result_cno2[7]; ?></td>
                     <td><?php echo $result_cno2[8]; ?></td>
                  </tr>
                  
            </tbody>
         </table>
      </div>


   </div>



</body>
</html>