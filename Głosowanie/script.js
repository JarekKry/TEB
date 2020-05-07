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
    if(personID<0 || SumbitedCode.length != 15){ ShowVoteAlert(false); return;}

    window.location.href = "?Id=" + personID + '&' + "VoteCode=" + SumbitedCode;
}
function ShowVoteAlert(succes,ReloadAfter)
{
    var Good = '<div class="alert alert-success"><strong>Sukces!</strong> Udało ci sie oddać głos.</div>';
    var Bad = '<div class="alert alert-danger"><strong>Błąd</strong> Użyty kod jest niepoprawny lub został już wykorzystany. Pamiętaj że nie można oddać pustego głosu.</div>';
    var toUse ="";
    if(succes) {toUse = Good} else {toUse = Bad};
    var target = document.getElementById("AlertDiv");
    target.innerHTML = toUse;
    target.style.opacity = 1;
    setTimeout(function() {HideVoteAlert(ReloadAfter);}, 5000); //will hide alert after specific amout of time
}
function HideVoteAlert(ReloadAfter)
{
    if(ReloadAfter){window.location.href="?";}
    document.getElementById("AlertDiv").style.opacity = 0;
}

function SlowlyApperVoteContainer(opacity,marginTop) 
{
    if(opacity<1) { opacity += 0.0075; }
    else { opacity=1; }

    if(marginTop<10) { marginTop += 0.075; }
    else { marginTop=10; }

    document.getElementById("VoteContainer").style.opacity = opacity;
    document.getElementById("VoteContainer").style.marginTop = marginTop + '%';

    setTimeout(function() {SlowlyApperVoteContainer(opacity,marginTop);}, 10);
}