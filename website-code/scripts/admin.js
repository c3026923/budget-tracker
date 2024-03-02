var table = document.getElementsByClassName('tableSection')[0];
var tbody = table.getElementsByTagName("tbody")[0]; //Concept of using tbody to determine on click from https://stackoverflow.com/questions/47170952/javascript-can-get-row-index-and-get-cell-data-at-same-time
var rows = tbody.getElementsByTagName("tr");

var unlockbuttons = document.getElementsByClassName('button-unlock');
var lockbuttons = document.getElementsByClassName('button-lock');
var deletebuttons = document.getElementsByClassName('button-delete');

var selectusertext = document.getElementsByClassName('select-user-text')[0];

var selectedUserId = null;

deselect();

function selectUser(row) 
{
    //console.log(row);
    var userId = row.getAttribute('data-userid');

    if (userId) 
    {
        selectedUserId = userId;

        for (i = 0; i < rows.length; i++) 
        {
            rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
        }

        for (i = 0; i < lockbuttons.length; i++) //Hide every button within the table (each row's buttons).
        {        
            unlockbuttons[i].hidden = true;
            lockbuttons[i].hidden = true;
            deletebuttons[i].hidden = true;
        }

        const tds = row.getElementsByTagName("td");

        for (i = 0; i < tds.length; i++) //Unhide the buttons which belong to the selected row.
        {
            if (i != 0) 
            {
                tds[i].childNodes[0].hidden = false;
            }
        }

        rows[selectedUserId].className = "clicked"; //Set the slected row to the blue/'selected' appearance via changing class.
    }
    else
    {
        console.log("DIDNT FIND USER ID");
    }
}


function confirmActionAdmin(action) 
{
    if (selectedUserId) 
    {
        var confirmed = false;

        switch (action) 
        {
            case 0:
                confirmed = confirm("By clicking 'Ok', you will be unlocking the user's account which allows them to access the system unless their account is locked at a later date.");
                break;
            case 1:
                confirmed = confirm("By clicking 'Ok', you will be locking the user's account which prevents them from accessing the system unless their account is unlocked at a later date.");
                break;
            case 2:
                confirmed = confirm("By clicking 'Ok', the user's account will be deleted. This is an irreversible process - please ensure that you fully intend to delete the selected user account.");
                break;
        }

        if (confirmed) 
        {
            switch (action) 
            {
                case 0:
                    window.location.href = "../logic/processuserunlock.php?user_id=" + selectedUserId;
                    break;
                case 1:
                    window.location.href = "../logic/processuserlock.php?user_id=" + selectedUserId;
                    break;
                case 2:
                    window.location.href = "../logic/processuserdelete.php?user_id=" + selectedUserId;
                    break;
            }
        }
    }
}

function deselect() 
{
    for (i = 0; i < lockbuttons.length; i++) 
    {
        unlockbuttons[i].hidden = true;
        lockbuttons[i].hidden = true;
        deletebuttons[i].hidden = true;
    }

    for (i = 0; i < rows.length; i++) 
    {
        rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
    }
}

function resetRight()
{
    selectusertext.hidden = false;
}
