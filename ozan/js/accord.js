const tabsBtn = document.querySelectorAll(".tab__btn");
const tabsItems = document.querySelectorAll(".event");
tabsBtn.forEach((e) => {
  onTabClick(tabsBtn, tabsItems, e);
});
function onTabClick(tabBtns, tabItems, item) {
  item.addEventListener("click", function (e) {
    let currentBtn = item;
    let tabId = currentBtn.getAttribute("data-tab");
    let currentTab = document.querySelector(tabId);
    if (e.srcElement.classList.contains("active")) {
      e.srcElement.classList.remove("active");
      e.srcElement.parentElement
        .querySelector(".sidebar__content")
        .classList.remove("active");
    } else if (!currentBtn.classList.contains("active")) {
      tabBtns.forEach(function (item) {
        item.classList.remove("active");
      });
      tabItems.forEach(function (item) {
        item.classList.remove("active");
      });
      currentBtn.classList.toggle("active");
      currentTab.classList.toggle("active");
    }
  });
}

const tabsBtn_2 = document.querySelectorAll(".tab_btn");
const tabsItems_2 = document.querySelectorAll(".tab_event");
tabsBtn_2.forEach((e) => {
    onTabClick(tabsBtn_2, tabsItems_2, e);
});
function onTabClick(tabBtns_2, tabItems_2, item) {
    item.addEventListener("click", function (e) {
      console.log("dfwfwfre");
        let currentBtn_2 = item;
        let tabId = currentBtn_2.getAttribute("data-tab");
        let currentTab_2 = document.querySelector(tabId);
        if (e.srcElement.classList.contains("active")) {
            // e.srcElement.classList.remove("active");
            // e.srcElement.parentElement
            //     .querySelector(".tab__btn")
            //     .classList.remove("active");
            // console.log(e.srcElement.parentElement.querySelector(".event"));
            // e.srcElement.parentElement
            //     .querySelector(".event")
            //     .classList.remove("active");
        } else if (!currentBtn_2.classList.contains("active")) {
            tabBtns_2.forEach(function (item) {
                item.classList.remove("active");
            });
            tabItems_2.forEach(function (item) {
                item.classList.remove("active");
            });
            currentBtn_2.classList.add("active");
            currentTab_2.classList.add("active");
        }
    });
}
