const rows = document.getElementsByClassName('tableSection')[0].getElementsByTagName("tbody")[0].getElementsByTagName("tr");
var selectedUserId = null;
var selectusertext = null;
var employeelistcontainer = null;
var unlockbuttons = null;
var lockbuttons = null;
var deletebuttons = null;

//#region Finding elements in page if they exist
if(document.getElementsByClassName('select-user-text')[0])
{
    selectusertext = document.getElementsByClassName('select-user-text')[0];
}

if(document.getElementsByClassName('employee-list-container')[0])
{
     employeelistcontainer = document.getElementsByClassName('employee-list-container')[0];
}

if(document.getElementsByClassName('button-unlock'))
{
    unlockbuttons = document.getElementsByClassName('button-unlock');
}

if(document.getElementsByClassName('button-lock'))
{
    lockbuttons = document.getElementsByClassName('button-lock');
}

if(document.getElementsByClassName('button-delete'))
{
    deletebuttons = document.getElementsByClassName('button-delete');
}
//#endregion

deselect();

function selectRow(tr, initiator)
{
    selectedUserId = tr.getAttribute('data-userid');
    var string = tr.getElementsByTagName('td')[0].innerHTML;
    var rowNo = string.replace(/\D/g,'');
    updateSelectedRow(rowNo);

    switch (initiator) 
    {
        case 1://Manager initiated, so need to save the ID of the employee they selected.
            showEmployeeList();
            saveSelectedEmployee();
            break;
        case 2://Administrator initiated, so need to show the buttons.
            showAdminButtons(tr);
            break;
        default:
            break;
    }
}

function updateSelectedRow(rownumber)
{
    for (i = 0; i < rows.length; i++) 
    {
        rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
    }

    rows[rownumber].className = "clicked"; //Set the slected row to the blue/'selected' appearance via changing class.
}

function saveSelectedEmployee()
{
    var request = new XMLHttpRequest(); //Idea to use AJAX from https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
    request.open("POST", "../data/saveemployeeid.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() 
    {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) // https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState and codes  from https://www.w3schools.com/xml/ajax_xmlhttprequest_response.asp
        {
            console.log(request.responseText);
        }
    };
    request.send("userID=" + selectedUserId);
}

function showEmployeeList()
{
    if(selectusertext != null && employeelistcontainer != null)
    {
        selectusertext.hidden = true;
        employeelistcontainer.hidden = false;
    }
}

function hideEmployeeList()
{
    if(selectusertext != null && employeelistcontainer != null)
    {
        selectusertext.hidden = false;
        employeelistcontainer.hidden = true;
    }
}

function deselect()
{
    for (i = 0; i < rows.length; i++) 
    {
        rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
    }

    hideEmployeeList();
    hideAdminButtons();
}

function showAdminButtons(rownumber)
{
    if(unlockbuttons != null && lockbuttons != null && deletebuttons != null)
    {
        for (i = 0; i < lockbuttons.length; i++) //Hide every button within the table (each row's buttons).
        {        
            unlockbuttons[i].hidden = true;
            lockbuttons[i].hidden = true;
            deletebuttons[i].hidden = true;
        }

        const tds = rownumber.getElementsByTagName("td");

        for (i = 0; i < tds.length; i++) //Unhide the buttons which belong to the selected row.
        {
            if (i != 0) 
            {
                tds[i].childNodes[0].hidden = false;
            }
        }
    }
}

function hideAdminButtons()
{
    if(unlockbuttons != null && lockbuttons != null && deletebuttons != null)
    {
        for (i = 0; i < lockbuttons.length; i++) 
        {
            unlockbuttons[i].hidden = true;
            lockbuttons[i].hidden = true;
            deletebuttons[i].hidden = true;
        }
    }
}

function confirmAdminAction(action)
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