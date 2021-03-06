<?php
    $conn = @mysqli_connect("localhost","root","","jkrysztofinski_VoteTEB") or die("Błąd połączenia z bazą danych");

    function GetUnusedVotes()
    {
      $stmt = mysqli_prepare($GLOBALS['conn'],"SELECT COUNT(CandidateID) FROM VoteCodes WHERE CandidateID = 0");  

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
        
        $stmt = mysqli_prepare($GLOBALS['conn'],"SELECT Candidates.PersonName, COUNT(VoteCodes.CandidateID) Votes FROM Candidates LEFT JOIN VoteCodes ON Candidates.ID = VoteCodes.CandidateID GROUP BY Candidates.PersonName ORDER BY Votes DESC");  

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
        var options = {title:'Wyniki głosowania', is3D: true, sliceVisibilityThreshold:0, fontSize: 15, chartArea:{right:0,left:0,top:20,width:'90%',height:'90%'}
        ,legend:{position: 'right', textStyle: {color: 'black', fontSize: 16}}
      };

        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>

    <div class="container-sm" id="VoteContainer" style="max-width:800; text-align:center;" >
    <div id="chart" style="width:750px; height:300px; margin:auto"></div>
    <button onclick="goToPage('index.php')" class="btn btn-primary"> Wróć </button>
    </div>

    <script>SlowlyApperVoteContainer(0.5,5);</script>
    <footer> Wykonał: Jarek Krysztofiński</footer>
  </body>
</html>