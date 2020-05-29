<?php

    $conn = @mysqli_connect("localhost","root","","jkrysztofinski_VoteTeb") or die("Błąd połączenia z bazą danych");

    //Użyte metody powinny uodpornić skrypt na ataki SQL injection... chyba 😐

    function Code_IsGood($code) //return true if code exist and can be used
    {       
        if(strlen($code) != 15) {return false;}
        $stmt = mysqli_prepare($GLOBALS['conn'],"SELECT Code,CandidateID FROM VoteCodes WHERE BINARY Code=?"); 

        mysqli_stmt_bind_param($stmt,"s",$code);       
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt,$outCode,$outId);
        mysqli_stmt_fetch($stmt);
    
        mysqli_stmt_close($stmt); 

        if($outCode == $code and $outId == 0) {return true;}

        return false;
    }

    function ID_IsGood($Id) //return true if id exist in database
    {
        if(!is_numeric($Id)) {return false;}
        $stmt = mysqli_prepare($GLOBALS['conn'],"SELECT ID FROM Candidates WHERE ID=?"); 

        mysqli_stmt_bind_param($stmt,"i",$Id);       
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt,$outId);
        mysqli_stmt_fetch($stmt);
    
        mysqli_stmt_close($stmt); 

        if($Id == $outId) {return true;}

        return false;
    }

    function UseCode($code,$Id)
    {
        $stmt = mysqli_prepare($GLOBALS['conn'],"UPDATE VoteCodes SET CandidateID=? WHERE BINARY Code=?"); 

        mysqli_stmt_bind_param($stmt,"is",$Id,$code);       
        mysqli_stmt_execute($stmt);
   
        mysqli_stmt_close($stmt); 
    }


    function HandleVote($code,$id) 
    {
        if(ID_IsGood($id) and Code_IsGood($code)) //  and VerifyPerson($person)
        {
            UseCode($code,$id);
            return true;
        }
        return false;
    }
 

    if( isset($_POST["person"]) and isset($_POST["UniqueCode"]))
    {   
        $code = $_POST["UniqueCode"];
        $person = $_POST["person"];

        $voted = HandleVote($code,$person);

    } else { $voted = false; }

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
    session_start();
    if($voted)
    {
       echo('<p style="color:green; text-align: center;"> Dziękujemy za oddanie głosu! </p>');
       echo('<script>ShowVoteAlert(true,false); goBackHistory(3000); </script>');
    }else
    {
        $_SESSION['VoteStatus']="Failed";
        header('Location:index.php');
    }
?>

</div>

<script>SlowlyApperVoteContainer(0.5,100);</script>

<footer>Wykonał: Jarek Krysztofiński</footer>
</body>
</html>