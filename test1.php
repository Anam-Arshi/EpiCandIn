<table id="myTable">
    <tr>
        <td>
            <select>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <!-- Add more options as needed -->
            </select>
        </td>
        <td>
            <!-- Add more cells as needed -->
        </td>
    </tr>
</table>

<button onclick="addRow()">Add Row</button>
<script>
function addRow() {
    var table = document.getElementById("myTable");
    var lastRow = table.rows[table.rows.length - 1];
    var newRow = lastRow.cloneNode(true);

    // Clear the selected options in the new row
    var select = newRow.getElementsByTagName("select")[0];
    select.selectedIndex = 0;

    // You can modify other elements in the new row if needed

    table.appendChild(newRow);
}
</script>