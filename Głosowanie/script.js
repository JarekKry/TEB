var VoteCodes = 
[
    "3G0XjpKCDpOWg3XnYYQv",
    "ZE57GJqI51O5BGiSKtyc",
    "A6F8fKN99yIhEpj1wU7Q",
    "TAD2MD3g8aQjU9fIeA8I",
    "GFt3iPPamWR1BBfCd2dL",
    "sswsDdAcqwjodkWYx2DB",
    "5awaUHBaBkfm3zq1OVOK",
    "cykpKApS4SJl5k7dAwVP",
    "A6KCz2k78MXwmWJz7LJ5",
    "YxOt0Y4EMNk26Th3dQ2f",
]

function SubmitVote()
{
    var SumbitedCode = document.getElementById("KeyCodeInput").value;
    var succes = false;
    
    for(var i=0;i<VoteCodes.length;i++)
    {
        if(SumbitedCode === VoteCodes[i] && SumbitedCode != ""  ) //also check if code is not used
        {
            succes = true;
            VoteCodes[i] = ""; //remove used code from array
            break;
        }
    }
    ShowVoteAlert(succes);
}
function ShowVoteAlert(succes)
{
    var Good = '<div class="alert alert-success"><strong>Sukces!</strong> Udało ci sie oddać głos.</div>';
    var Bad = '<div class="alert alert-danger"><strong>Błąd</strong> Użyty kod jest niepoprawny lub został już wykorzystany.</div>';
    var toUse ="";
    if(succes) {toUse = Good} else {toUse = Bad};
    var target = document.getElementById("AlertDiv");
    target.innerHTML = toUse;
    target.style.opacity = 1;
    setTimeout(function() {HideVoteAlert();}, 5000); //will hide alert after specific amout of time
}
function HideVoteAlert()
{
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