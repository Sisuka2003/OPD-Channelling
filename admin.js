var table = document.getElementById('tb-user'), rIndex;

for (var i = 1; i < table.rows.length; i++) {
    table.rows[i].onclick = function () {
        rIndex = this.rowIndex;
        document.getElementById("id-1").value = this.cells[0].innerHTML;
        document.getElementById("password").value = this.cells[1].innerHTML;
        document.getElementById("job").value = this.cells[2].innerHTML;
    };
}
