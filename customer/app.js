<<<<<<< HEAD
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
=======

//FOR MENU FILTER AND RECOMMENDATION
var stop = 100;
var stopFilter = 60;

$(".back").bind("click", function(e) {
    e.preventDefault();
    $(".highlight-wrapper").animate({
        scrollLeft: "-=" + stopFilter + "px"
    });
});

$(".next").bind("click", function(e) {
    e.preventDefault();
    $(".highlight-wrapper").animate({
        scrollLeft: "+=" + stopFilter + "px"
    });
});

$(".back-menu").bind("click", function(e) {
    e.preventDefault();
    $(".filter-wrapper").animate({
        scrollLeft: "-=" + stopFilter + "px"
    });
});

$(".next-menu").bind("click", function(e) {
    e.preventDefault();
    $(".filter-wrapper").animate({
        scrollLeft: "+=" + stopFilter + "px"
    });
});

//when the add to cart is clicked
let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let shoppingCart = document.querySelector('.card');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');



openShopping.addEventListener('click', () => {
    shoppingCart.classList.add('active'); // Add the 'active' class to show the shopping cart
    body.classList.add('active'); // Add the 'active' class to prevent scrolling the background
});

closeShopping.addEventListener('click', () => {
    shoppingCart.classList.remove('active'); // Remove the 'active' class to hide the shopping cart
    body.classList.remove('active'); // Remove the 'active' class to allow scrolling the background
});

let listCards  = [];
function initApp(){
    products.forEach((value, key) =>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="image/${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key){
    if(listCards[key] == null){
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key)=>{
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="image/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
                listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = products[key].price;
    }
    reloadCard();
}

>>>>>>> bc0e471d32708425cfc835f1936bf2e1d9b3d9a5
