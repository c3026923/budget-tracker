var editbuttons = document.getElementsByClassName('button-edit');

var selectedExpenseId = null;

function selectTransaction(row) 
{
    var expenseid = row.getAttribute('data-expense_id');

    if (expenseid) 
    {
        selectedExpenseId = expenseid;

        for (i = 0; i < rows.length; i++) 
        {
            rows[i].className = ""; //Select each row and remove their class, to set back to default white/unselected appearance.
        }

        for (i = 0; i < editbuttons.length; i++) //Hide edit button within the table (each row's button).
        {        
            editbuttons[i].hidden = true;
        }

        const tds = row.getElementsByTagName("td");

        for (i = 0; i < tds.length; i++) //Unhide the button which belongs to the selected row, also should unhide the text information too even though it'd never be set to hidden.
        {
            tds[i].childNodes[0].hidden = false;
        }

        rows[selectedExpenseId].className = "clicked"; //Set the slected row to the blue/'selected' appearance via changing class.
    } 
}

function confirmActionEmployee(action) 
{
    if (selectedExpenseId) 
    {
        var confirmed = false;

        switch (action) 
        {
            case 0:
                confirmed = confirm("Are you sure that you wish to edit the selected transaction?");
                break;
        }

        if (confirmed) 
        {
            switch (action) 
            {
                case 0:
                    window.location.href = "processeditexpense.php?expense_id=" + selectedExpenseId;
                    break;
            }
        }
    }
}

