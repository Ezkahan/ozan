
$(".hero__slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    nextArrow: ".next",
    prevArrow: ".prev",
    adaptiveHeight: true,
});
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

function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}


let add_address = document.querySelector(".add_address");
let add_btn = document.querySelector(".add_new_address");
let remove_btn = document.querySelector(".close_mail_btn");
let rework_check = document.querySelectorAll(".rework_check");
let account_table_btn = document.querySelectorAll(".account_table_btn");
let account_info = document.querySelectorAll(".account_info");
let account_link = document.querySelectorAll(".account_link");
let account_infos = document.querySelectorAll(".account_infos");
let tab_link = document.querySelector("#tab-3");
let account_tab = document.querySelector("#account_tab-3");

let menu_burger = document.querySelector(".menu_burger img");
let upheader = document.querySelector(".upheader");
let upheader__inner = document.querySelector(".upheader__inner");


// if (menu_burger != undefined) {
//     alert('rabotayet');
//     menu_burger.addEventListener('click', function () {
//         console.log("test");

//             upheader.classList.add('active');
//             upheader__inner.classList.add('active');
//     });
// }

function open_menu() {
    sleep(2).then(() => {
        document.getElementById('upheader').classList.add('active');
        document.getElementById('upheader_inner').classList.add('active');
    });
}


if (add_btn != undefined) {
    add_btn.addEventListener('click', function () {
        sleep(2).then(() => {
            add_address.classList.add('active');
        });
    });
}

if (remove_btn != undefined) {
    remove_btn.addEventListener('click', function () {
        sleep(2).then(() => {
            add_address.classList.remove('active');
        });
    });
}

if (account_table_btn != undefined) {
    account_table_btn.forEach(v => {
        v.addEventListener('click', function (e) {
            sleep(2).then(() => {
                account_info.forEach(o => {
                    o.classList.remove('active');
                })
            });
        });
    })
}

if (account_link != undefined) {
    account_link.forEach(v => {
        v.addEventListener('click', function (e) {
            sleep(2).then(() => {
                account_infos.forEach(o => {
                    o.classList.remove('active');
                })
            });
        });
    })
}

if (tab_link != undefined) {
    tab_link.addEventListener('click', function () {
        sleep(2).then(() => {
            account_tab.classList.add('active');
        });
    });
}


// if (rework_check != undefined) {

//   rework_check.forEach(x => {
//     x.addEventListener('click', function () {
//       console.log(rework_check);
//       console.log("rework_check");
//       x.classList.toggle('active');
//     });
//   })
// }

function showCat() {
    document.getElementById("cat_sidebar").classList.toggle("active");
}


let modal = document.getElementById("modal");
let modalBtn = document.getElementById("modalBtn");
let modalClose = document.getElementById("modalClose");
// modalBtn.onclick = function (e) {
//     modal.style.display = "block";
// };
// modalClose.onclick = function () {
//   modal.style.display = "none";
// };
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

let forget = document.querySelector(".forget");
let forget_mail = document.querySelector(".forget_mail");
let forget_pass = document.querySelector(".forget_pass");


window.onclick = function (event) {
    if (
        !event.target.matches(".dropdown__btn") &
        !event.target.matches(".menu__btn")
    ) {
        let dropdowns = document.getElementsByClassName("dropdown__content");
        let menus = document.getElementsByClassName("menu__content");

        let i;
        for (i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
                document.getElementById("dropbtn").classList.remove("active");
            }
        }
        let x;
        for (x = 0; x < menus.length; x++) {
            let openMenus = menus[x];
            if (openMenus.classList.contains("show")) {
                openMenus.classList.remove("show");
                document.getElementById("menuBtn").classList.remove("active");
            }
        }
    }
    if (event.target == modal) {
        modal.style.display = "none";
    }

    if (forget != undefined) {
        if (forget.classList.contains('active') && !event.target.closest('.forget_mail') && !event.target.closest('.forget_pass')) {
            forget.classList.remove('active');
        }
    }


    if (add_address != undefined) {
        if (add_address.classList.contains('active') && !event.target.closest('.forget_mail') && !event.target.closest('.forget_pass')) {
            add_address.classList.remove('active');
        }
    }

    if (document.getElementById('upheader').classList.contains('active') && !event.target.closest('.upheader_inner') && !event.target.closest('.upheader__nav-link') && !event.target.closest('.upheader__language')) {
        document.getElementById('upheader').classList.remove('active')
    }

    if (document.getElementById('upheader_inner').classList.contains('active') && !event.target.closest('.upheader_inner') && !event.target.closest('.upheader__nav-link') && !event.target.closest('.upheader__language')) {
        document.getElementById('upheader_inner').classList.remove('active')
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

// For check only once =======================


function onlyOne(checkbox) {
    let checkboxes = document.getElementsByName('check')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false

    })
}


function onlyCheck(check) {
    let checkbox = document.getElementsByName('pay-check')

    checkbox.forEach((items) => {
        if (items !== check) items.checked = false
    })

}
// For check only once =======================



