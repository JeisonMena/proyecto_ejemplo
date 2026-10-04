const btnSidebar = document.getElementById("btnSidebar");
const sidebarOverlay = document.getElementById("sidebarOverlay");

btnSidebar.addEventListener("click", function () {
  if (window.innerWidth < 992) {
    document.body.classList.toggle("mobile-sidebar-open");
  } else {
    document.body.classList.toggle("sidebar-collapsed");
  }
});

sidebarOverlay.addEventListener("click", function () {
  document.body.classList.remove("mobile-sidebar-open");
});

window.addEventListener("resize", function () {
  if (window.innerWidth >= 992) {
    document.body.classList.remove("mobile-sidebar-open");
  }
});

document.getElementById("currentYear").textContent = new Date().getFullYear();
