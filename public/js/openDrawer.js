let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

let isSidebarOpen = localStorage.getItem("isSidebarOpen");
if (isSidebarOpen === "true") {
    sidebar.classList.add("active");
    sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
}

sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        localStorage.setItem("isSidebarOpen", "true");
    } else {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        localStorage.removeItem("isSidebarOpen");
    }
}