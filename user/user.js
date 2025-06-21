function toggleDropdown(event) {
    event.stopPropagation();
    document.getElementById("dropdownProfil").classList.toggle("active");
}

window.onclick = function (event) {
    if (!event.target.closest(".dropdown")) {
        document.getElementById("dropdownProfil").classList.remove("active");
    }
};