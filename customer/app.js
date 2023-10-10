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


let quantity = document.querySelector('.quantity');




function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = products[key].price;
    }
    reloadCard();
}

