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
    <h1 class="title col-lg-12">Расчёт вредных выбросов в атмосферу от котельных работающих на газообразном топливе</h1>

    <form action="fuel_performance.php" method="GET" id="my_form">
    
    <div class="table-responsive">
      <table class="table table-bordered">
      <thead>
        <tr>
          <h3>Расход топлива по кварталам, м<sup>3</sup></h3>
         <!-- <th scope="col" colspan="2">Расход топлива по кварталам, м<sup>3</sup></th> -->
          <th scope="col">1-ый</th>
          <th scope="col">2-ой</th>
          <th scope="col">3-ий</th>
          <th scope="col">4-ый</th>
        </tr>
      </thead>
      <tbody>
        <tr>
         <!-- <td colspan="2"></td> -->
          <td><input type="text" name="first" form="my_form" placeholder="710"/></td>
          <td><input type="text" name="second" form="my_form" placeholder="9"/></td>
          <td><input type="text" name="third" form="my_form" placeholder="0"/></td>
          <td><input type="text" name="fourth" form="my_form" placeholder="657"/></td>
        </tr>
      </tbody>
      </table>
    </div>

    <div class="table-responsive ">
      <table class="table table-bordered">
      <thead>
        <tr>
        <h3>Введите данные по кварталам и данные следующих значений:</h3>
         <!-- <th scope="col" colspan="2">Расход топлива по кварталам, м<sup>3</sup></th> -->
          <th scope="col">D, м</th>
          <th scope="col">H, м</th>
          <th scope="col">&#916; T, град.</th>
          <th scope="col">ПДК CO</th>
          <th scope="col">ПДК NO<sub>2</sub></th>
        </tr>
      </thead>
      <tbody>
        <tr>
         <!-- <td colspan="2"></td> -->
          <td><input type="text" name="D" form="my_form" placeholder="0.3"/></td>
          <td><input type="text" name="H" form="my_form" placeholder="10"/></td>
          <td><input type="text" name="T" form="my_form" placeholder="200"/></td>
          <td><input type="text" name="PDK_CO" form="my_form" placeholder="5"/></td>
          <td><input type="text" name="PDK_NO2" form="my_form" placeholder="0.085"/></td>
        </tr>
      </tbody>
      </table>
    </div>

    .<div class="row text-center">
      <div class="col-lg-12">
      <input type="submit" value="Получить значение">
       <!-- <button type="button" class="btn btn-primary col-lg-3 lg-offset-3" form="my_form">Рассчитать</button>    -->
      </div>
    </div>
 
    </form>
   
  </div>

</body>
</html>