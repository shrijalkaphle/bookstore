let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let home = document.querySelector(".home-section");

if (screen.width > 1000) {
    sidebar.classList.toggle("open");
    menuBtnChange();
    homewidthChange();
}
closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();
    homewidthChange();
});

function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("fa-bars", "fa-times"); //replacing the icons class
    } else {
        closeBtn.classList.replace("fa-times", "fa-bars"); //replacing the icons class
    }
}

function homewidthChange() {
    if (sidebar.classList.contains("open")) {
        home.setAttribute('style', 'left: 250px;width: calc(100% - 250px);')
    } else {
        home.setAttribute('style', 'left: 78px;width: calc(100% - 78px);')
    }
}