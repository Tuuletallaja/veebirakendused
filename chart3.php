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
gameengine, round(avg(satisfaction),1) as avg_satisfaction, round(avg(new_engine),1) as avg_new_engine
FROM
responses.responses
GROUP BY gameengine;");

$rows = [];
while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
    #$r = json_encode($r);
    $rows[] = $r;
}

$json = '{ 
    "cols": [
        { "id":"gameengine", "label": "Mängumootor", "type": "string"},
        { "id":"avg_satisfaction", "label": "Rahulolu", "type": "number"}
        { "id":"avg_new_engine", "label": "Võimalus uue mängumootori valikuks", "type": "number"}
        ], 
    "rows": ['; 
  
    $temp = []; 
    if (!empty($rows)) { 
        foreach ($rows as $key => $array) { 
             $temp[] = '{"c":[{"v":"' . $array['gameengine'] . '"},{"v":' . $array['avg_satisfaction'] . '},{"v":' . $array['avg_new_engine'] . '}]}'; 
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
