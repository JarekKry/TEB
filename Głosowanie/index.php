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
      $Id = -1;
      $VoteCode = "";

      if(isset($_GET['Id'])) {$Id=$_GET['Id'];}
      if(isset($_GET['VoteCode'])) {$VoteCode=$_GET['VoteCode'];}

      $Good = true;

      if($Id<1 or $Id>5) {$Good=false;}
      if(strlen($VoteCode)!=20){$Good=false;}

      //tu kiedyś będzie weryfikacja czy kod został już wykorzystany
      $codes = array(
      "3G0XjpKCDpOWg3XnYYQv",
      "ZE57GJqI51O5BGiSKtyc",
      "A6F8fKN99yIhEpj1wU7Q",
      "TAD2MD3g8aQjU9fIeA8I",
      "GFt3iPPamWR1BBfCd2dL",
      "sswsDdAcqwjodkWYx2DB",
      "5awaUHBaBkfm3zq1OVOK",
      "cykpKApS4SJl5k7dAwVP",
      "A6KCz2k78MXwmWJz7LJ5",
      "YxOt0Y4EMNk26Th3dQ2f");

      if(in_array($VoteCode,$codes))
      {       
        // tu cza dodać usuwanie kodów po wykorzystaniu
      }else{$Good=false;}


      if($Good)
      {
        echo('<script> ShowVoteAlert(1,1) </script>');
        echo('<script>SlowlyApperVoteContainer(1,100);</script>');
      } 
      else if ($Id == -1 && $VoteCode =="" )
      {
        //echo('<script> ShowVoteAlert(0,0) </script>');;
        echo('<script>SlowlyApperVoteContainer(0,0);</script>');
      }
      if(!$Good && $Id != -1 && $VoteCode != "")
      {
        echo('<script> ShowVoteAlert(0,0) </script>');
        echo('<script>SlowlyApperVoteContainer(1,100);</script>');
      }
      
?>


<footer>Wykonał: Jarek Krysztofiński</footer>
</body>
</html>