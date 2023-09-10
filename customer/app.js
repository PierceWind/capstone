const mobile = document.querySelector('.menu-toggle');
const mobileLink = document.querySelector('.sidebar');

mobile,addEventListener("click", function(){
    mobile.classList.toggle("is-active");
    mobileLink.classList.toggle("active");
});

//close menu when clicked 

mobileLink.addEventListener("click", function(){
    const menuBars = document.querySelector("is-active");
    if(window.innerWidth<=768 && menuBars){
        mobile.classList.toggle("is-active");
        mobileLink.classList.toggle("active");
    }
});

//move the menu bar

var stop = 100;
var stopfilter = 60;
var scrolling =true;

$(".back").bind("click", function(e){
    e.preventDefault();
    $(".highlight-wrapper").animate({
        scrollLeft: "-=" + stop + "px"
    });
});

$("next").bind("click", function(){
    $(".highlight-wrapper").animate({
        scrollLeft: "+=" + stop + "px"
    });
})

let minus = document.querySelector('.minus');
let add = document.querySelector('.add');
let input = document.querySelector('.value');

let format = (num) => num > 9 ? num : num;

minus.onclick = () =>{
    let number = parseInt(input.value);
    if(number == 0){
        input.value = '0';
    } 
    else{
        input.value = format (number - 1);
    }
}

add.onclick = () =>{
    input.value = format(parseInt(input.value) + 1);
}

input.addEventListener('keyup', () =>{
    let number = parseInt(input.value);
    if(isNaN(number)){
        input.value = '0';
    }
    else {
        input.value = format(number);
    }
})