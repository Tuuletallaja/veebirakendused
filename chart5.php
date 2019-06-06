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

$input = filter_input(INPUT_GET, 'age', FILTER_SANITIZE_STRING); 

mysqli_set_charset($conn,"utf8");

if (empty($input)) {
    $sth = mysqli_query($conn,"select gameengine, avg(hours) as avg_hours, avg(assets) as avg_assets from responses where hours < 10000 and assets < 10000 group by gameengine;");
} else {
    $sth = mysqli_query($conn,"select gameengine, avg(hours) as avg_hours, avg(assets) as avg_assets from responses where hours < 10000 and assets < 10000 and age = '".$input."' group by gameengine;");
}

$rows = [];
while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
    #$r = json_encode($r);
    $rows[] = $r;
}

$json = '{ 
    "cols": [
        { "id":"gameengine", "label": "Vanus", "type": "string"},
        { "id":"avg_hours", "label": "Keskmine töötundide arv", "type": "number"},
        { "id":"avg_assets", "label": "Keskmine projektile kulutatud summa", "type": "number"}
        ], 
    "rows": ['; 
  
    $temp = []; 
    if (!empty($rows)) { 
        foreach ($rows as $key => $array) { 
             $temp[] = '{"c":[{"v":"' . $array['gameengine'] . '"},{"v":' . $array['avg_hours'] . '},{"v":' . $array['avg_assets'] . '}]}'; 
        } 
    } 
  
    $json.= join(",", $temp); 
  
  $json .= '] 
}'; 

echo $json;

mysqli_close($conn);
?>
