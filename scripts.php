<?php

// Valib kõik unikaalsed mängumootorid andmebaasis
function getGameengine() {
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
    $sth = mysqli_query($conn,"select distinct gameengine from responses group by gameengine having count(gameengine) > 1;");

    $rows = [];
    while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
        $rows[] = $r;
    }

    if (!empty($rows)) { 
        foreach ($rows as $key => $array) { 
            $temp[] = '<option value="'.$array['gameengine'].'">'.$array['gameengine'].'</option>'; 
        }
        
        foreach($temp as $x) {
            echo $x;
        }
    } 
}


// Toob andmebaasis riikide nimekirja ja valmisteb need ette select menüü jaoks
function getCountry() {
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
    $sth = mysqli_query($conn,"select distinct responses.residency from responses where CHAR_LENGTH(responses.residency) > 0;");

    $rows = [];
    while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
        $rows[] = $r;
    }

    if (!empty($rows)) { 
        foreach ($rows as $key => $array) { 
            $temp[] = '<option value="'.$array['residency'].'">'.$array['residency'].'</option>'; 
        }
        
        foreach($temp as $x) {
            echo $x;
        }
    } 
}


?>