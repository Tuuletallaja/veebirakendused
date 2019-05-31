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


$sth = mysqli_query($conn,"SELECT 
age, COUNT(age) AS arv
FROM
responses.responses
WHERE
CHAR_LENGTH(age) > 0
GROUP BY age;");

$rows = [];
while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
    #$r = json_encode($r);
    $rows[] = $r;
}

$json = '{ 
    "cols": [
        { "id":"age", "label": "Vanus", "type": "string"},
        { "id":"arv", "label": "Arv", "type": "number"}
        ], 
    "rows": ['; 
  
    $temp = []; 
    if (!empty($rows)) { 
        foreach ($rows as $key => $array) { 
             $temp[] = '{"c":[{"v":"' . $array['age'] . '"},{"v":' . $array['arv'] . '}]}'; 
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
