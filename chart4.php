<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responses";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn,"utf8");

$engine = filter_input(INPUT_GET, 'engine', FILTER_SANITIZE_STRING); 

if (empty($engine)) {
    $sth = mysqli_query($conn,"select price, count(price) as price_count from responses group by price;");
} else {
    $sth = mysqli_query($conn,"select distinct price, count(price) as price_count from responses where gameengine = '".$engine."' group by price;");
}

$rows = [];
while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
    #$r = json_encode($r);
    $rows[] = $r;
}

$json = '{ 
    "cols": [
        { "id":"price", "label": "Projekti hind", "type": "string"},
        { "id":"price_count", "label": "Projekte hinnavahemikus", "type": "number"}
        ], 
    "rows": ['; 
  
    $temp = []; 
    if (!empty($rows)) { 
        foreach ($rows as $key => $array) { 
             $temp[] = '{"c":[{"v":"' . $array['price'] . '"},{"v":' . $array['price_count'] . '}]}'; 
        } 
    } 
  
    $json.= join(",", $temp); 
  
  $json .= '] 
}'; 
#file_put_contents('chart1.json', $json);
#echo json_encode($rows);
#$rows = json_encode($rows);
#print_r($rows);
#foreach ($rows as $value) {
#}
echo $json;

mysqli_close($conn);
?>
