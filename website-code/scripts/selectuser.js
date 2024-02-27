function selectUser(selected) 
{
    var selectablebuttons = document.getElementsByClassName("button-fillcell");

    for (i = 0; i < selectablebuttons.length; i++) 
    {
        selectablebuttons[i].className = "button-fillcell";
    }

    selected.classList.add("button-fillcell-clicked");

    var table = document.getElementsByClassName('tableSection')[0]; 
    var tbody = table.getElementsByTagName("tbody")[0]; //Concept of using tbody to determine on click from https://stackoverflow.com/questions/47170952/javascript-can-get-row-index-and-get-cell-data-at-same-time
    tbody.onclick = function(f)
    {
        var string = f.target.innerHTML;
        var newString = string.replace(/\s+/g,""); //Concept of removing blank space from https://stackoverflow.com/questions/3893625/how-would-i-remove-blank-characters-from-a-string-in-javascript
        var int = newString.slice(0,1); 
        console.log(int);
    };

    /*
    $selectuserid = "SELECT user_id FROM user WHERE user_id = rownumber";
    $resultuserid = mysqli_query($connection, $selectuserid);

    */

    //window.location = 'http://localhost/budget-tracker/budget-tracker/website-code/accountcreate.php';
}