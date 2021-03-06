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

$min = filter_input(INPUT_GET, 'koer', FILTER_SANITIZE_STRING); 

if (empty($min)) { 
    $sth = mysqli_query($conn,"SELECT 
        gameengine, count(gameengine) as users
        FROM
        responses.responses
        WHERE
        CHAR_LENGTH(responses.residency) > 0 
        GROUP BY responses.gameengine;");
  } else { 
    $sth = mysqli_query($conn,"SELECT 
        gameengine, count(gameengine) as users
        FROM
        responses.responses
        WHERE
        responses.residency = '".$min."' 
        GROUP BY responses.gameengine;"); 
  } 


$rows = [];
while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
    $rows[] = $r;
}

$json = '{ 
    "cols": [
        { "id":"gameengine", "label": "Mängumootor", "type": "string"},
        { "id":"users", "label": "Kasutajaid", "type": "number"}
        ], 
    "rows": ['; 
  
$temp = []; 
if (!empty($rows)) { 
    foreach ($rows as $key => $array) { 
            $temp[] = '{"c":[{"v":"' . $array['gameengine'] . '"},{"v":' . $array['users'] . '}]}'; 
    } 
} 

$json.= join(",", $temp); 
$json .= ']}'; 

echo $json;

mysqli_close($conn);
?>
