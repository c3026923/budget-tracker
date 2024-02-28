var lockbuttons = document.getElementsByClassName('button-lock');
var deletebuttons = document.getElementsByClassName('button-delete');

var confirmationboxtext = document.getElementsByClassName('confirmation-box-text')[0];
var confirmationboxyes = document.getElementsByClassName('confirmation-button-yes')[0];
var confirmationboxno = document.getElementsByClassName('confirmation-button-no')[0];
var selectusertext = document.getElementsByClassName('select-user-text')[0];

//var selectedRowInt = 0;

for (i = 0; i < lockbuttons.length; i++) 
{
    lockbuttons[i].hidden = true;
    deletebuttons[i].hidden = true;
}

confirmationboxtext.hidden = true;
confirmationboxyes.hidden = true;
confirmationboxno.hidden = true;

function toggleUnlock() 
{
    confirmationboxtext.hidden = false;
    confirmationboxyes.hidden = false;
    confirmationboxno.hidden = false;    
    selectusertext.hidden = true;
    confirmationboxtext.textContent = "By clicking 'Yes', you will be unlocking the user's account which allows them to accesss the system unless their account is later locked.";
}

function toggleLock() 
{
    confirmationboxtext.hidden = false;
    confirmationboxyes.hidden = false;
    confirmationboxno.hidden = false;
    selectusertext.hidden = true;
    confirmationboxtext.textContent = "By clicking 'Yes', you will be locking the user's account which prevents them from accessing the system unless their account is later unlocked.";
}

function toggleDelete() 
{
    confirmationboxtext.hidden = false;
    confirmationboxyes.hidden = false;
    confirmationboxno.hidden = false;
    selectusertext.hidden = true;
    confirmationboxtext.textContent = "By clicking 'Yes', the user's account will be deleted. This is an irreversible process - please ensure that you fully intend to delete the selected user account.";
}

function resetRight()
{
    confirmationboxtext.hidden = true;
    confirmationboxyes.hidden = true;
    confirmationboxno.hidden = true;
    selectusertext.hidden = false;
    confirmationboxtext.textContent = "Select any user from the list to view further information and options.";
}

function selectUser() 
{
    var table = document.getElementsByClassName('tableSection')[0];
    var tbody = table.getElementsByTagName("tbody")[0]; //Concept of using tbody to determine on click from https://stackoverflow.com/questions/47170952/javascript-can-get-row-index-and-get-cell-data-at-same-time

    tbody.onclick = function (f) 
    {
        var string = f.target.innerHTML;
        var newString = string.replace(/\s+/g, ""); //Concept of removing blank space from https://stackoverflow.com/questions/3893625/how-would-i-remove-blank-characters-from-a-string-in-javascript
        var int = newString.slice(0, 1);

        //selectedRowInt = int;


        //resetRight();

        /*
        if(rows[int].className = "clicked")//The selected row should be the same as it was last time, so deselect!
        {
            //do something here for deselecting everything
            //it'd need to run resetRight() BUT MAYBE HAVE THIS RUN EVEN IF NOT SAME ROW SELECTED!
        } 
        */

        var rows = tbody.getElementsByTagName("tr");
        const alltdsinselectedrow = rows[int].getElementsByTagName("td");

        for (i = 0; i < rows.length; i++) 
        {
            rows[i].className = ""; //Select each row and emove their class, to set back to default white/unselected appearance.
        }
        
        var lockbuttons = document.getElementsByClassName('button-lock');
        var deletebuttons = document.getElementsByClassName('button-delete');
        
        for (i = 0; i < lockbuttons.length; i++) //Hide every button (actually 'a') within the table (each row's buttons).
        {
            lockbuttons[i].hidden = true;
            deletebuttons[i].hidden = true;
        }

        for (i = 0; i < alltdsinselectedrow.length; i++) //Unhide the buttons (actually 'a') which belong to the selected row.
        {
            if(i != 0)
            {
                alltdsinselectedrow[i].childNodes[0].hidden = false;
            }
        }

        rows[int].className = "clicked"; //Set the slected row to the blue/'selected' appearance via changing class.

        /*
        switch (f.target.className) 
        {
            case "button-lock":
                break;
            case "button-delete":
                break;
        }
        */
    };
}