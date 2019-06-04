
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
        sliceVisibilityThreshold: 0.02
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
        async: false
      }).responseText;

      var options = {
        title: 'Inimeste vanus',
        sliceVisibilityThreshold: 0.01
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
        sliceVisibilityThreshold: 0.01
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
        title: 'Projekti hind, kui müüks tarbijale (€)'
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('price'));
      chart.draw(data, options);
    }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var jsonData = $.ajax({
        url: "chart5.php",
        dataType: "json",
        async: false,
      }).responseText;

        var options = {
          region: 'world',
          displayMode: 'regions'
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>

  </head>

  <body>

    <select name="country" id="blabla">
      <?php getCountry(); ?> <!--  Genereerib dropdown menüü liikmed -->
    </select> 
    <div id="user_stats"></div>
    <br>
    <div id="users_age"></div>
    <br>
    <div id="engine"></div>
    <br>
    <select id="select_engine" name="gameengine">
      <option value="" selected="selected">Kõik koos</option>
      <?php getGameengine(); ?> <!--  Genereerib dropdown menüü liikmed -->
    </select>
    <div id="price"></div>
    <div id='regions_div'></div>

    <script type="text/javascript"> 
        
      $("#blabla").on('change', function() { 
        drawChartUsers(); 
      }); 
      
      $("#select_engine").on('change', function() { 
        drawChartPrice(); 
      }); 
    </script> 

  </body>

</html>