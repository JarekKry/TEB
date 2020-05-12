<?php

    $folderName =  getcwd()."\data-214Sr1sSXepR_Je23Cs9oEQMaJt_EGb1J0KFuJ3g_kdZzbvLRfBRmAmypDSqpK_7";
    $personsFile = $folderName."\personsID.txt";
    $votesFile = $folderName.'\votes.txt';
    $codesFile = $folderName."\codes.txt";

    function isInFile($search,$filename)
    {        
        $file = file($filename);

        for($i=0;$i<count($file);$i++) 
        {
            $line = trim($file[$i]);
            if($line == $search) 
            {
                return true;
            }
        }

        return false;
    }
    function replaceInFile($text,$newText,$filename)
    {
        $file = file($filename);

        for($i=0;$i<count($file);$i++) 
        {
            $line = trim($file[$i]);
            if($line == $text) 
            {
                $file[$i]=$newText."\n";
            }
        }

        file_put_contents($filename,$file);
    }
    function iterateVote($voteNumber)
    {
        $file = file($GLOBALS['votesFile']);

            $line = trim($file[$voteNumber]);
            $line++;

            $file[$voteNumber]=$line."\n";

        file_put_contents($GLOBALS['votesFile'],$file);
    }


    function VerifyCode($code) //check if code exist and can be used
    {
        if(strlen($code)==15 and isInFile($code,$GLOBALS['codesFile']))
        {
            return true;
        }
        return false;
    }
    function VerifyPerson($person) //check if person exist 
    {
        if(is_numeric($person) and isInFile($person,$GLOBALS['personsFile']))
        {
            return true;
        }
        return false;
    }

    function HandleVote($person,$code) 
    {
        if(VerifyCode($code) and VerifyPerson($person))
        {
            replaceInFile($code,"USED",$GLOBALS['codesFile']); //make code unussable
            iterateVote($person); //iterate vote
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
       echo('<script>goBackHistory(3000);</script>');
    }else
    {
        echo('<p style="color:red; text-align: center;"> Coś poszło nie tak :( </p>');
        echo('<p style="color:#9c2727; text-align: center;"> Kod może być już wykorzystany </p>');
        echo('<script>goBackHistory(3000);</script>');
    }
?>




</div>

<script>SlowlyApperVoteContainer(1,5);</script>



<footer>Wykonał: Jarek Krysztofiński</footer>
</body>
</html>