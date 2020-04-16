<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Jarek Krysztofiński">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
	<title>Głosowanie</title>
</head>
<body>

<div id="AlertDiv">
<div class="alert alert-primary" role="alert"> NULL </div> <!-- this invisible alert prevent ugly resizing-->
</div> <!--alert will be placed inside this-->

<div class="container-sm" id="VoteContainer">

<label> Głosowanie samorządowe 2020 </label> 

<div class="form-group">

    <input type="radio" name="person" value="1" class="form-check-input">1 - Konrad Kosiński<br>
    <input type="radio" name="person" value="2" class="form-check-input">2 - Marta Kowalska<br>
    <input type="radio" name="person" value="3" class="form-check-input">3 - Julia Krupa<br>
    <input type="radio" name="person" value="4" class="form-check-input">4 - Apolonia Wójcik<br>
    <input type="radio" name="person" value="5" class="form-check-input">5 - Barbara Piotrowska<br>

</div>

<form>
  <div class="form-group">   
    <input type="text" class="form-control-center" id="KeyCodeInput" placeholder="Kod jednorazowy" maxlength="20" > <!-- Unique code max lenght = 20 -->
  </div>
</form>

<div id="VoteForm">
    <button type="submit" class="btn btn-primary" onclick="SubmitVote()">Zagłosuj</button> 
    <label class="VoteWarning">Uwaga: Oddanie głosu jest nieodwracalne.</label> 
</div>

</div>

<?php
      $Good = '<div class="alert alert-success"><strong>Sukces!</strong> Udało ci sie oddać głos.</div>';
      $Bad = '<div class="alert alert-danger"><strong>Błąd</strong> Użyty kod jest niepoprawny lub został już wykorzystany.</div>';

      if($_GET)
      {
        echo("get:" + $_GET);
      }
      else
      {
        echo("noget");
      }

?>

<footer>Wykonał: Jarek Krysztofiński</footer>
<script src="./script.js"></script>
<script>SlowlyApperVoteContainer(0,0);</script> <!--slowly show VoteContainer-->
</body>
</html>