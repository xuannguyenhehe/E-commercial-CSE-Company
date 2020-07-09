function searchPID() {
    // Declare variables
    var input, filter, table, tr, td, i, tbody, txtValue;
    input = document.getElementById("searchbox");
    filter = input.value.toUpperCase();
    box = document.getElementsByClassName("productSmallBox");
  
    for (i = 0; i < box.length; i++) {
            td = box[i].getElementsByClassName("titleProduct")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    box[i].style.display = "";
                    break;
                } else {
                    box[i].style.display = "none";
                }
            }
    }
}

function sortPID(index){
    if (index == 1){
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("smallBox");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.getElementsByClassName("productSmallBox");
            for (i = 0; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByClassName("priceProduct")[0];
                y = rows[i + 1].getElementsByClassName("priceProduct")[0];
            if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
                shouldSwitch = true;
                break;
            }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }    
    }
    else {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("smallBox");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.getElementsByClassName("productSmallBox");
            for (i = 0; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByClassName("priceProduct")[0];
                y = rows[i + 1].getElementsByClassName("priceProduct")[0];
            if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                shouldSwitch = true;
                break;
            }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
    
}

function filterPID(){
    from = parseFloat(document.getElementById("inputFrom").value);
    to = parseFloat(document.getElementById("inputTo").value);
    box = document.getElementsByClassName("productSmallBox");
    if (from > 0 && to > 0){
        // alert("OK");
        for (var i = 0; i < box.length; i++){
            box[i].style.display = "";
        }
        for (var i = 0; i < box.length; i++){
            var value = box[i].getElementsByClassName("priceProduct")[0];
            if (parseFloat(value.textContent) < from || parseFloat(value.textContent) > to){
                box[i].style.display = "none";
            }
        }
    }
    else if (from > 0){
        for (var i = 0; i < box.length; i++){
            box[i].style.display = "";
         
        }
        for (var i = 0; i < box.length; i++){
            var value = box[i].getElementsByClassName("priceProduct")[0];
            if (parseFloat(value.textContent) < from ){
                box[i].style.display = "none";
            }
        }
    }
    else if (to > 0){
        for (var i = 0; i < box.length; i++){
            box[i].style.display = "";
        }
        for (var i = 0; i < box.length; i++){
            var value = box[i].getElementsByClassName("priceProduct")[0];
            if (parseFloat(value.textContent) > to){
                box[i].style.display = "none";
            }
        }
    }
    else {
        for (var i = 0; i < box.length; i++){
            box[i].style.display = "";
        }
    }
}