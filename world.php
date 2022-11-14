<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt;
if (!isset($_GET["country"])) {
  $stmt = $conn->query("SELECT * FROM countries");
} else {
   $country = $_GET["country"];
  if(isset($_GET['lookup']) && $_GET['lookup'] == 'cities'){
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code=countries.code WHERE countries.name like '%$country%';");
  }else {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  }
  
}


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<?php if(isset($_GET['lookup']) && $_GET['lookup'] == 'cities') { ?>
    <table>
      <thead>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </thead>
      <tbody>
        <?php foreach ($results as $row) : ?>
      <tr>

      <td><?= $row['name'] ?></td>
      <td><?= $row['district'] ?></td>
      <td><?= $row['population'] ?></td>
      </tr>
      
    <?php endforeach; ?>
      </tbody>
    </table>
<?php } else { ?>
    <table>
  <thead>
    <th>Name</th>
    <th>Continent</th>
    <th>Indepence</th>
    <th>Head of State</th>
  </thead>
  <tbody>
    <?php foreach ($results as $row) : ?>
      <tr>

      <td><?= $row['name'] ?></td>
      <td><?= $row['continent'] ?></td>
      <td><?= $row['independence_year'] ?></td>
      <td><?= $row['head_of_state'] ?></td>
      </tr>
      
    <?php endforeach; ?>

  </tbody>
</table>
<?php } ?>
