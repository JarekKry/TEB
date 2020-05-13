<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Jarek Krysztofiński">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <script src="./script.js"></script>
	<title>Głosowanie</title>
</head>
<body>

<div id="AlertDiv">
<div class="alert alert-primary" role="alert"> NULL </div> <!-- this invisible alert prevent ugly resizing-->
</div> <!--alert will be placed inside this-->

<div class="container-sm" id="VoteContainer">

<label> Głosowanie samorządowe 2020 </label> 

<form id="VoteForm" class="form-group" action="vote.php" method="POST" onsubmit="return SubmitVote()">

    <input type="radio" name="person" value="1" class="form-check-input">1 - Konrad Kosiński<br>
    <input type="radio" name="person" value="2" class="form-check-input">2 - Marta Kowalska<br>
    <input type="radio" name="person" value="3" class="form-check-input">3 - Julia Krupa<br>
    <input type="radio" name="person" value="4" class="form-check-input">4 - Apolonia Wójcik<br>
    <input type="radio" name="person" value="5" class="form-check-input">5 - Barbara Piotrowska<br>

    <input type="text" name="UniqueCode" class="form-control-center" id="KeyCodeInput" placeholder="Kod jednorazowy" maxlength="15" > <!-- Unique code max lenght = 15 -->
      
    <br> <button type="submit" class="btn btn-primary">Zagłosuj </button>
    <label class="VoteWarning">Uwaga: Oddanie głosu jest nieodwracalne.</label>
</form>

</div>

<?php
  session_start();
  if(isset($_SESSION['VoteStatus']) and $_SESSION['VoteStatus']=='Failed' )
  {
    $_SESSION['VoteStatus']="Unknown";
    echo('<script>ShowVoteAlert(false,false);</script>');
    echo('<script>SlowlyApperVoteContainer(1,100);</script>');
  }
  else{echo('<script>SlowlyApperVoteContainer(0.5,5);</script>');}
?>

<!-- no idea why but this function need to be inside html to work onsubmit :/ -->
<script> 
      function SubmitVote()
      {
          var SumbitedCode = document.getElementById("KeyCodeInput").value;
          var succes = false;
          
          var radios = document.getElementsByName('person');
          var personID=-1;

          for (var i = 0, length = radios.length; i < length; i++) //szuka zaznaczonej osoby
          {
              if (radios[i].checked) 
              {
                  personID = radios[i].value;
                  break; //zatrzyma sie gdy znajdzie pierwszą zaznaczoną osobę
              }
          }
          if(personID<0 || SumbitedCode.length != 15){ ShowVoteAlert(false); return false;}
      }
</script>

<footer>Wykonał: Jarek Krysztofiński</footer>
</body>
</html>