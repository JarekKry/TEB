<?php
    function VerifyCode($code) //check if code exist and can be used
    {
        if(strlen($code)==15)
        {
            // need to be verified here
            return true;
        }
        return false;
    }
    function VerifyPerson($person) //check if person exist 
    {
        if(is_numeric($person))
        {
            // need to be verified here
            return true;
        }
        return false;
    }

    function HandleVote($person,$code) 
    {
        if(VerifyCode($code) and VerifyPerson($person))
        {
            //files including codes and vote count need to be edited here
            return true;
        }
        return false;
    }
 

    if( isset($_POST["person"]) and isset($_POST["UniqueCode"]))
    {   
        $code = $_POST["UniqueCode"];
        $person = $_POST["person"];

        $voted = HandleVote($person,$code);

    }else{$voted = false;}

?>

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

<?php
    if($voted)
    {
       echo('<p style="color:green; text-align: center;"> Dziękujemy za oddanie głosu! </p>');
       echo('<script>ShowVoteAlert(true,false);</script>');
    }else{echo('<p style="color:red; text-align: center;"> Coś poszło nie tak :( </p>');}
?>




</div>

<script>SlowlyApperVoteContainer(1,5);</script>



<footer>Wykonał: Jarek Krysztofiński</footer>
</body>
</html>