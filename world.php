<?php
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($lookup == 'cities') {
	$stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE 
							countries.name LIKE :country");
	$cities = "%$country%";
  $stmt->bindParam(':country', $cities);
  $stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table>
		<thead>
			<tr>
				<th>Name</th>
				<th>District</th>
				<th>Population</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $row): ?>
			<tr>
				<td><?= $row['name']; ?></td>
				<td><?= $row['district']; ?></td>
				<td><?= $row['population']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php
} else {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $search = "%$country%";
    $stmt->bindParam(':country', $search);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>	
<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Continent</th>
				<th>Independence</th>
				<th>Head of State</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $row): ?>
			<tr>
				<td><?= $row['name']; ?></td>
				<td><?= $row['continent']; ?></td>
				<td><?= $row['independence_year']; ?></td>
				<td><?= $row['head_of_state']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php }