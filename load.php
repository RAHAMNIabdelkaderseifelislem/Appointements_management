<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=dental_corner', 'root', '');

$data = array();

$query = "SELECT * FROM appointements ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{

 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["first_name"]." ".$row['last_name'].":".$row['atype'],
  'start'   => $row["adate"],
  'end'   => $row["tdate"]
 );
}

echo json_encode($data);

?>
