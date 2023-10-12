const menuBtn = document.getElementById("menuBtn");
const sideBar = document.getElementById("sidebar");

menuBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  sideBar.classList.toggle("-translate-x-full");
  //   sideBar.classList.add("translate-x-0");
});

document.body.addEventListener("click", () => {
  sideBar.classList.add("-translate-x-full");
});
