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
    
    for(var i=0;i<VoteCodes.length;i++)
    {
        if(SumbitedCode === VoteCodes[i] && SumbitedCode != ""  ) //also check if code is not used
        {
            alert("Kod poprawny");
            VoteCodes[i] = ""; //remove used code from array
            return;
        }
    }
    alert("Niepoprawny kod");
}