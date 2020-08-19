let stpbl1 = document.getElementById('stepbl1')
let stpbrdr1 = document.getElementById('stepbrdr1')

let stpbl2 = document.getElementById('stepbl2')
let stpbrdr2 = document.getElementById('stepbrdr2')

let stpbl3 = document.getElementById('stepbl3')
let stpbrdr3 = document.getElementById('stepbrdr3')

stpbl1.onmouseover = function(){
    stpbrdr1.style.borderBottom = "3px solid white";
}
stpbl1.onmouseout = function(){
    stpbrdr1.style.borderBottom = "3px solid black";
}

stpbl2.onmouseover = function(){
    stpbrdr2.style.borderBottom = "3px solid white";
}
stpbl2.onmouseout = function(){
    stpbrdr2.style.borderBottom = "3px solid black";
}

stpbl3.onmouseover = function(){
    stpbrdr3.style.borderBottom = "3px solid white";
}
stpbl3.onmouseout = function(){
    stpbrdr3.style.borderBottom = "3px solid black";
}