<?php
require 'db.php';
require 'validCities.php';
$city = $_GET['city'];
$pdo->exec("SET NAMES = utf8_general_ci ");
if($city == null){
$sth = $pdo->prepare("SELECT * FROM `lids`");
$sth->execute();
$array = $sth->fetchAll();
$csv_str = '';
//print_r($array);
} else {
$sth = $pdo->prepare("SELECT * FROM `lids` WHERE city = ?");
$sth->execute(array($city));
$array = $sth->fetchAll();
$csv_str = '?city='.$city;
//print_r($array[1]);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <title></title>
  </head>
  <body>
    <button class="btn btn-primary px-3 rounded-3" onclick="window.open('/downloadcsv.php<?php echo $csv_str?>')">Экспорт CSV</button></br></br>
    <button class="btn btn-primary px-3 rounded-3" onclick="window.location = '/getlids.php'">Все города</button>
    <?php
    foreach ($cities as $city) {
    echo "<button class=\"btn btn-primary px-3 rounded-3\" onclick=\"window.location = '/getlids.php?city=".$city['key']."'\">".$city['val']."</button>\n";
    }
    ?>
    </br></br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Дата</th>
          <th scope="col">Email</th>
          <th scope="col">Имя</th>
          <th scope="col">Телефон</th>
          <th scope="col">Город</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        forEach($array as $lid){
        if($i % 2 == 1){
        $class = 'table-light';
        } else {
        $class = 'table-secondary';
        }
        echo '<tr class="'.$class.'"><th scope="row">'.$i.'</th>';
        echo '<td>'.$lid['date'].'</td>';
        echo '<td>'.$lid['email'].'</td>';
        echo '<td>'.$lid['name'].'</td>';
        echo '<td>'.$lid['phone'].'</td>';
        echo '<td>'.$lid['city'].'</td></tr>';
        $i++;
        }
        ?>
      </tbody>
    </table>
  </body>
</html>