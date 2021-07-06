// $(".hero__slider").slick({
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     dots: false,
//     nextArrow: ".next",
//     prevArrow: ".prev",
//     adaptiveHeight: true,
// });

// $(".banner_box").slick({
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     dots: false,
//     speed: 1000,
//     autoplay: true,
//     arrows: true,
//     autoplaySpeed: 2000,
//     // nextArrow: ".next_s",
//     // prevArrow: ".prev_s",
//     adaptiveHeight: true,
// });


$(".sale__slider").slick({
    dots: false,
    infinite: false,
    speed: 1000,
    autoplay: false,
    autoplaySpeed: 2000,
    slidesToShow: 3,
    slidesToScroll: 1,
    nextArrow: ".next__s",
    prevArrow: ".prev__s",
    responsive: [
        {
            breakpoint: 1340,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ],
});
$(".brand__slider").slick({
    dots: false,
    infinite: true,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 1000,
    slidesToShow: 6,
    slidesToScroll: 1,
    nextArrow: ".next__b",
    prevArrow: ".prev__b",
    responsive: [
        {
            breakpoint: 1640,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 1240,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 940,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 700,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 420,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ],
});

var modal = document.getElementById("modal");
var modalBtn = document.getElementById("modalBtn");
var modalClose = document.getElementById("modalClose");
modalBtn ? modalBtn.onclick = function () {
    modal.style.display = "block";
} : null;
modalClose ? modalClose.onclick = function () {
    modal.style.display = "none";
} : null;
function showProfile() {
    document.getElementById("myDropdown").classList.toggle("show");
    document.getElementById("dropbtn").classList.toggle("active");
}
function showMenu() {
    document.getElementById("menuDropdown").classList.toggle("show");
    document.getElementById("menuBtn").classList.toggle("active");
}
function closeMenu() {
    document.getElementById("menuDropdown").classList.remove("show");
    document.getElementById("menuBtn").classList.remove("active");
}
function logIn() {
    document.getElementById("logInBtn").classList.add("active");
    document.getElementById("signUpBtn").classList.remove("active");
    document.getElementById("logInForm").classList.add("active");
    document.getElementById("signUpForm").classList.remove("active");
}
function signUp() {
    document.getElementById("logInBtn").classList.remove("active");
    document.getElementById("signUpBtn").classList.add("active");
    document.getElementById("logInForm").classList.remove("active");
    document.getElementById("signUpForm").classList.add("active");
}
window.onclick = function (event) {
    if (
        !event.target.matches(".dropdown__btn") &
        !event.target.matches(".menu__btn")
    ) {
        var dropdowns = document.getElementsByClassName("dropdown__content");
        var menus = document.getElementsByClassName("menu__content");

        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
                document.getElementById("dropbtn").classList.remove("active");
            }
        }
        var x;
        for (x = 0; x < menus.length; x++) {
            var openMenus = menus[x];
            if (openMenus.classList.contains("show")) {
                openMenus.classList.remove("show");
                document.getElementById("menuBtn").classList.remove("active");
            }
        }
    }
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function increment() {
    document.getElementById("demoInput").stepUp();
}
function decrement() {
    document.getElementById("demoInput").stepDown();
}

$(".detail__slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    fade: true,
    asNavFor: ".detail__slider-nav",
});

$(".detail__slider-nav").slick({
    slidesToShow: 4,
    infinite: true,
    arrows: false,
    slidesToScroll: 1,
    asNavFor: ".detail__slider",
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    vertical: true,
});
