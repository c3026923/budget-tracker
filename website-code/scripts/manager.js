const table = document.getElementsByClassName('tableSection')[0];
const tbody = table.getElementsByTagName("tbody")[0]; //Concept of using tbody to determine on click from https://stackoverflow.com/questions/47170952/javascript-can-get-row-index-and-get-cell-data-at-same-time
const rows = tbody.getElementsByTagName("tr");

const selectusertext = document.getElementsByClassName('select-user-text')[0];
const employeelistcontainer = document.getElementsByClassName('employee-list-container')[0];

var selectedUserId = null;

deselect();

function selectUser(row) 
{
    var userId = row.getAttribute('data-userid');

    //#region Visually de-selecting all rows, selecting current one to blue then activating the other table.
    if (userId) 
    {
        selectedUserId = userId;

        for (i = 0; i < rows.length; i++) 
        {
            rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
        }

        rows[selectedUserId].className = "clicked"; //Set the slected row to the blue/'selected' appearance via changing class.
    }

    showEmployeeList();
    //#endregion

    //#region Passing USERID via AJAX to save it as a S_SESSION value.
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
    request.send("userID=" + userId);
    //#endregion
}

function showEmployeeList()
{
    selectusertext.hidden = true;
    employeelistcontainer.hidden = false;
}


function hideEmployeeList()
{
    selectusertext.hidden = false;
    employeelistcontainer.hidden = true;
}

function deselect()
{
    for (i = 0; i < rows.length; i++) 
    {
        rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
    }

    hideEmployeeList();
}