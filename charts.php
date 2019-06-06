
<?php
// HTML elementide genereerimiseks loodud PHP faili sidumine  
include 'scripts.php';
?>

<html>
  
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <!-- Google API registreerimine  -->

    <script type="text/javascript">
    // Load the Visualization API and the piechart package.
    // Lae graafikute joonistamiseks vajalikud liidesed
    google.charts.load('current', {'packages': ['corechart']});

    google.charts.load('current', {'packages': ['table']});

    // Set a callback to run when the Google Visualization API is loaded.
    // Chart1
    google.charts.setOnLoadCallback(drawChartUsers);

    function drawChartUsers() {
      var jsonData = $.ajax({
        url: "chart1.php",
        dataType: "json",
        async: false,
        data: {
          koer: $("#blabla").val() 
        }
      }).responseText;

      var options = {
        title: 'Mängumootori kasutajate arv',
        sliceVisibilityThreshold: 0.02,
        height: 500,
        weight: 300
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('user_stats'));
      chart.draw(data, options);
    }
    
    // Chart2
    google.charts.setOnLoadCallback(drawChartAge);

    function drawChartAge() {
      var jsonData = $.ajax({
        url: "chart2.php",
        dataType: "json",
        async: false,
      }).responseText;

      var options = {
        title: 'Inimeste vanus',
        sliceVisibilityThreshold: 0.01,
        height: 500,
        weight: 500
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('users_age'));
      chart.draw(data, options);
    }

    // Chart3
    google.charts.setOnLoadCallback(drawChartEngine);

    function drawChartEngine() {
      var jsonData = $.ajax({
        url: "chart3.php",
        dataType: "json",
        async: false
      }).responseText;

      var options = {
        title: 'Rahulolu mängumootori valikuga',
        sliceVisibilityThreshold: 0.01,
        height: 500,
        legend: {
          position: 'top'
        }
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('engine'));
      chart.draw(data, options);
    }

    // Chart4

    google.charts.setOnLoadCallback(drawChartPrice);

    function drawChartPrice() {
      var jsonData = $.ajax({
        url: "chart4.php",
        dataType: "json",
        async: false,
        data: {
          engine: $("#select_engine").val() 
        }
      }).responseText;

      var options = {
        title: 'Projekti hind, kui müüks tarbijale (€)',
        height: 500,
        weight: 300,
        legend: {
          position: 'bottom'
        }
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('price'));
      chart.draw(data, options);
    }


    // Chart4
    google.charts.setOnLoadCallback(drawChartAvarage);

    function drawChartAvarage() {
      var jsonData = $.ajax({
        url: "chart5.php",
        dataType: "json",
        async: false,
        data: {
          age: $("#age").val() 
        }
      }).responseText;

      var options = {
        title: 'Pooleli oleva projektile kulunud aeg ja sellele kulutatud summa',
        height: 600,
        legend: {
          position: 'bottom'
        }
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.BarChart(document.getElementById('ice_age'));
      chart.draw(data, options);
    }
    
    </script>



  </head>

  <body class="body">
  	<br>
    <br>
    <div>
      <h1>Mängumootorite ja käsiloleva projekti uuring</h1>
      <h2>Sander Aru ja Egle Puppart TA18</h2>
      <br>
      <p>Tahtsime uuringuga teada saada erinevates riikides elavate inimeste eelistatud mängumootorit ja rahulolu sellega ning infot nende käimas olevatest projektidest. Vajalike andmete kogumiseks viidi läbi küsitlus lehel reddit.com subredditis r/gamedev.</p>
      
      <p>Uurisime küsitletute käest infot nende eelisatud mängumootori osas, rahuolu, päritolu, vanust, oma projekti panustatud ajast ja kuludest.
      </p>
      <p>Kõige rohkem oli vastanuid Ameerika Ühendriikidest, Suurbritanniast ja Kanadast ning keskmine vanus jäi 20 – 29 eluaasta vahemikku. Kokku oli uuringule vastajaid 88.
      </p>
      <p>Vaieldamatult on kõige populaarsem mängumootor Unity või on neil arendajatel oma lahendus. Enamus inimesi, kes küsitlusele vastasid on ilmselt algajad ja asjaarmastajad, kes on oma projektide algus faasis, sest kulutatud aeg käesolevale projektile on väga väike.
      </p>
    </div>
    <br> 
    <br> 
    <!--Div that will hold the pie chart-->
    Vali riik:
    <br>
    <select name="country" id="blabla">
    <option value="">Kõik</option>
      <?php getCountry(); ?> <!--  Genereerib dropdown menüü liikmed -->
    </select> 
    <div id="user_stats"></div>
    <br>
    <div id="users_age"></div>
    <br>
    <div id="engine"></div>
    <br>
    Vali mängumootor:
    <br>
    <select id="select_engine" name="gameengine">
      <option value="" selected="selected">Kõik koos</option>
      <?php getGameengine(); ?> <!--  Genereerib dropdown menüü liikmed -->
    </select>
    <div id="price"></div>
    Vali vanusegrupp:
    <br>
    <select id="age" name="age">
      <option value="">Kõik</option>
      <option value="10-19">10-19</option>
      <option value="20-29">20-29</option>
      <option value="30-39">30-39</option>
      <option value="40-49">40-49</option>      
    </select>
    <div id='ice_age'></div>

    <script type="text/javascript"> 
        
      $("#blabla").on('change', function() { 
        drawChartUsers(); 
      }); 
      
      $("#select_engine").on('change', function() { 
        drawChartPrice();
        console.log("Mis toimub!!"); 
      }); 

      $("#age").on('change', function() { 
        drawChartAvarage();
        console.log("Mis toimub!!");
      }); 
    </script> 
    
  </body>

</html>

<style>
.body {
  padding-left:20%;
  padding-right:20%;
}
</style>





