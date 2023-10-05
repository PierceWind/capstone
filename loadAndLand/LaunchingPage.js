digInButton.addEventListener("click", function () {
   
    digInButton.classList.add("button-animation");

   
    digInButton.addEventListener("animationend", function () {
        digInButton.classList.remove("button-animation");
        digInButton.classList.add("button-close-animation");
    });

   
});

document.addEventListener("DOMContentLoaded", function () {
    const digInButton = document.getElementById("digInButton");
    const body = document.body;

    digInButton.addEventListener("click", function () {
      
        body.classList.add("fade-out-animation");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const digInButton = document.getElementById("digInButton");
    const body = document.body;

    digInButton.addEventListener("click", function () {
        
        body.classList.add("fade-out-animation");

        
        body.classList.add("fade-out-page-animation");
    });
});
