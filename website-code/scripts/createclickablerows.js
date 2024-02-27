var table = document.getElementsByClassName("tableSection");
var firsttable = table[0];
var rows = firsttable.getElementsByTagName("tr");

for (i = 0; i < rows.length; i++) 
{
    rows[i].onclick = function () 
    {
        return function () 
        {
            for (i = 0; i < rows.length; i++) 
            {
                rows[i].className = "";
            }
            var id = this.cells[0].innerHTML;
            alert("id:" + id);
        };
    } (rows[i]);
}
window.onload = addRowHandlers();