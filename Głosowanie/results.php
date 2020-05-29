<?php
    $conn = @mysqli_connect("localhost","root","","jkrysztofinski_VoteTEB") or die("Błąd połączenia z bazą danych");

    function GetUnusedVotes()
    {
      $stmt = mysqli_prepare($GLOBALS['conn'],"SELECT COUNT(CandidateID) FROM votecodes WHERE CandidateID = 0");  

      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$outVotes);
      mysqli_stmt_fetch($stmt);

      return $outVotes;
    }
?>
<html>
  <head>

    <meta charset="UTF-8">
    <meta name="author" content="Jarek Krysztofiński">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="./script.js"></script>
    <title>Głosowanie</title>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.arrayToDataTable([

            ['Name', 'Votes']
      <?php
        
        $stmt = mysqli_prepare($GLOBALS['conn'],"SELECT candidates.PersonName, COUNT(votecodes.CandidateID) Votes FROM candidates LEFT JOIN votecodes ON candidates.ID = votecodes.CandidateID GROUP BY candidates.PersonName ORDER BY Votes DESC");  

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$outName,$outVotes);

        $usedVotes = 0;
        while(mysqli_stmt_fetch($stmt))
        {
        echo(",['".$outName."',".$outVotes."]");  
        $usedVotes += $outVotes;       
        }
        mysqli_stmt_close($stmt); 

        $x = GetUnusedVotes()-$outVotes;
        echo(",[' - Pozostałe głosy - ',".$x."]");
      ?>

        ]);
        var options = {'title':'Wyniki głosowania', is3D: true, sliceVisibilityThreshold:0};

        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>

    <div class="container-sm" id="VoteContainer" style="max-width:800;" >
    <div id="chart" style="width: 780px; height: 500px;"> </div>
    <button onclick="goToPage('index.php')" class="btn btn-primary"> Wróć </button>
    </div>

    <script>SlowlyApperVoteContainer(0.5,5);</script>
  </body>
</html>