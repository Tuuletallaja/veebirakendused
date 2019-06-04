
<?php 
include 'scripts.php';
?>

<html>
  
  <head>
    <meta charset="UTF-8">
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
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
        width: 800,
        height: 400
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
        sliceVisibilityThreshold: 0.01,
        width: 800,
        height: 400
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
        width: 800,
        height: 400
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
        title: 'Projekti hind',
        width: 800,
        height: 400
      };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('price'));
      chart.draw(data, options);
    }
    </script>
  </head>

  <body>
  	<br>
    <br>
    <h1>Mängumootorite ja käsiloleva projekti uuring</h1>
    <h2>Sander Aru ja Egle Puppart
      TA18</h2>
    <br>
    Tahtsime uuringuga teada saada erinevates riikides elavate inimeste eelistatud mängumootorit ja rahulolu sellega ning infot nende käimas olevatest projektidest.
    <br>
    Uurisime küsitletute käest infot nende eelisatud mängumootori osas, rahuolu, päritolu, vanust, oma projektidesse panustatud ajast jms.
    <br>
    Kõige rohkem oli vastanuid Ameerika Ühendriikidest, Suurbritanniast ja Kanadast ning keskmine vanus jäi 20 – 29 eluaasta vahemikku. Kokku oli uuringule vastajaid 91.
    <br> 
    <!--Div that will hold the pie chart-->
    <select name="country" id="blabla">
      <?php getCountry(); ?>
    </select> 
    <div id="user_stats"></div>
    <br>
    <div id="users_age"></div>
    <br>
    <div id="engine"></div>
    <br>
    <select id="select_engine" name="gameengine">
      <option value="" selected="selected">Kõik koos</option>
      <?php getGameengine(); ?>
    </select>
    <div id="price"></div>

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