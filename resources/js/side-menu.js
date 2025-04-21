const toggleMenuBtns = document.querySelectorAll(".toggle-menu-btn")
const sideMenuContainer = document.querySelector('.side-menu-container')

const toggleMenu = (e) => {
    sideMenuContainer.classList.toggle("side-menu-toggle")
}

for(const toggleMenuBtn of toggleMenuBtns){
    toggleMenuBtn.addEventListener("click", toggleMenu)
}