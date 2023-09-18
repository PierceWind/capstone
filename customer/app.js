
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
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}
 
