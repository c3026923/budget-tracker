var table = document.getElementsByClassName('tableSection')[0];
var tbody = table.getElementsByTagName("tbody")[0]; //Concept of using tbody to determine on click from https://stackoverflow.com/questions/47170952/javascript-can-get-row-index-and-get-cell-data-at-same-time
var rows = tbody.getElementsByTagName("tr");

var selectedTransactionId = null;

function selectTransaction(row) 
{
    var transactionId = row.getAttribute('data-transaction_id');

    if (transactionId) 
    {
        selectedTransactionId = transactionId;

        for (i = 0; i < rows.length; i++)
        {
            rows[i].className = "unclicked"; //Select each row and remove their class, to set back to default white/unselected appearance.
            console.log("ran!");
        }

        rows[selectedTransactionId].className = "clicked"; //Set the slected row to the blue/'selected' appearance via changing class.
    }
}

function editTransaction()
{

}