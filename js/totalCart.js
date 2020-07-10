function removePID(value){
    var btnRemove = document.getElementById(value);
    var pa = btnRemove.parentNode.parentNode.parentNode.parentNode;
        var quantity = pa.children[1].children[0].children[2].children[0].children[1];
    if (btnRemove.textContent == "Remove"){
        quantity.setAttribute("value", "0");
        quantity.style.display = "none";
        pa.style.opacity = "0.5";
        btnRemove.textContent = "Unremove";
    }
    else {
        quantity.style.display = "";
        pa.style.opacity = "1";
        btnRemove.textContent = "Remove";
    }
}

// function totalCart(){
    $(document).ready(function(){
        $(".numQuantity").change(function(){
            // alert($(".col-2").get(0).textContent);
            // alert($(".numQuantity").get(0).value);
            var total = 0;
            for (var i = 0; i < $(".col-2").length; i++){
                // alert($(".remove").get(i).textContent);
                if ($(".remove").get(i).textContent == "Remove"){
                    total = total + parseFloat($(".col-2").get(i).textContent)*parseFloat($(".numQuantity").get(i).value);
                }
            }
            // alert($(".resultCart").get(0).textContent);
            $(".resultCart").text(total);
            // return total;
        })
        
    })

// }