var rows = null;
var selectedTransactionId = null;

if(document.getElementsByClassName('tableSection')[0].getElementsByTagName("tbody")[0].getElementsByTagName("tr"))
{
    rows = document.getElementsByClassName('tableSection')[0].getElementsByTagName("tbody")[0].getElementsByTagName("tr"); //Concept of using tbody to determine on click from https://stackoverflow.com/questions/47170952/javascript-can-get-row-index-and-get-cell-data-at-same-time
}

function confirmActionEmployee(td, action) 
{
    selectedTransactionId = td.getAttribute('data-transaction_id');
    console.log("Transaction ID = " + selectedTransactionId);

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
                window.location.href = "employee-edittransaction.php?expense_id=" + selectedTransactionId;
            break;
        }
    }
}

function confirmActionManager(td, action) 
{
    selectedTransactionId = td.getAttribute('data-transaction_id');
    console.log("Transaction ID = " + selectedTransactionId);

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
                window.location.href = "manager-edittransaction.php?income_id=" + selectedTransactionId;
            break;
        }
    }
} 