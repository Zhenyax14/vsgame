document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("showRegister").addEventListener("click", (e) => {
        e.preventDefault();
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("registerForm").style.display = "block";
    });

    document.getElementById("showLogin").addEventListener("click", (e) => {
        e.preventDefault();
        document.getElementById("registerForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
    });

});