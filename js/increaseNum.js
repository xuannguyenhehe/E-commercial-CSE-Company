function increaseNumSize(){
    var num = document.getElementById("numInputSize").value;
    if (num == 100){
        document.getElementById("numInputSize").value = num;
    }
    else {
        num = Number(num) + 1;
        document.getElementById("numInputSize").value = num;
    }
}
function decreaseNumSize(){
    var num = document.getElementById("numInputSize").value;
    if (num == 80) {
        document.getElementById("numInputSize").value = num;
    }
    else {
        num = Number(num) - 1;
        document.getElementById("numInputSize").value = num;
    }
}
function increaseNumQuality(){
    var num = document.getElementById("numInputQuality").value;
    num = Number(num) + 1;
    document.getElementById("numInputQuality").value = num;
}
function decreaseNumQuality(){
    var num = document.getElementById("numInputQuality").value;
    if (num == 1){
        document.getElementById("numInputQuality").value = num;
    }
    else {
        num = Number(num) - 1;
        document.getElementById("numInputQuality").value = num;
    }
}