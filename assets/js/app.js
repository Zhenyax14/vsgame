document.addEventListener("DOMContentLoaded", () => {

    const showLogin = document.getElementById("showLogin");
    const showRegister = document.getElementById("showRegister");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    //Cambiar entre formularios
    showRegister.addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    });

    showLogin.addEventListener("click", (e) => {
        e.preventDefault();
        registerForm.style.display = "none";
        loginForm.style.display = "block";
    });

    //Validar registro
    registerForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const user = document.querySelector("#registerForm input[name='user']").value.trim();
        const email = document.querySelector("#registerForm input[name='email']").value.trim();
        const password = document.querySelector("#registerForm input[name='password']").value;
        const confirmPass = document.querySelector("#registerForm input[name='confirmPass']").value;

        if (!user || !email || !password || !confirmPass) {
            alert("Todos los campos son obligatorios");
            return;
        }

        if (password !== confirmPass) {
            alert("Las contraseñas no coindicen");
            return;
        }

        const emailRegex = /\S+@\S+\.\S+/;
        if(!emailRegex.test(email)) {
            alert("El email no tiene un formato válido");
            return;
        }

        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordRegex.test(password)) {
            alert("La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas, números y un carácter especial");
            return;
        }

    //Hacer fetch de registro
        const response = await fetch("/api/register.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({email, user, password})
        });

        const result = await response.json();

        if(result.success) {
            alert("Registro correcto, inicia sesión");
            registerForm.style.display = "none";
            loginForm.style.display = "block";
        } else {
            alert(result.message)
        }
    });

    //Login
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const user = document.querySelector("#loginForm input[name='user']").value.trim();
        const password = document.querySelector("#loginForm input[name='password']").value;
        
        if(!user || !password) {
            alert("Introduce usuario y contraseña");
            return;
        }
        //fetch de login
        const response = await fetch("/api/login.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({user, password})
        });

        const result = await response.json();
        if(result.success) {
            window.location.href = "show.php"; 
        } else { 
            alert(result.message); }
    });

});