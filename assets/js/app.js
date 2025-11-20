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

        const nickname = document.querySelector("#registerForm input[name='nickname']").value.trim();
        const email = document.querySelector("#registerForm input[name='email']").value.trim();
        const password = document.querySelector("#registerForm input[name='password']").value;
        const confirmPass = document.querySelector("#registerForm input[name='confirmPass']").value;

        if (!nickname || !email || !password || !confirmPass) {
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
            body: JSON.stringify({email, nickname, password})
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
        const email = document.querySelector("#loginForm input[name='email']").value.trim();
        const password = document.querySelector("#loginForm input[name='password']").value;
        
        if(!email || !password) {
            alert("Introduce email y contraseña");
            return;
        }
        //fetch de login
        const response = await fetch("/api/login.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({nickname, password})
        });

        const result = await response.json();
        if(result.success) {
            window.location.href = "show.php"; 
        } else { 
            alert(result.message); }
    });

    //LÓGICA DEL JUEGO

    const opcionJugada = document.getElementById('opcionJugada');
    const atacar = document.getElementById('atacar');
    const defender = document.getElementById('defender');
    const playerCard = document.getElementById('playerCard');
    const machineCard = document.getElementById('machineCard');
    const ronda = document.getElementById('ronda');
    const puntuacionJugador = document.getElementById('puntuacionJugador');
    const puntuacionCpu = document.getElementById('puntuacionCpu');
    const restartBtn = document.getElementById('restartBtn');
    const popup = document.getElementById('popup');
    const closePopupBtn = document.getElementById('closePopupBtn');

    const gameState = {
        ronda: 1,
        maxRondas: 5,
        scoreJugador: 0,
        scoreCpu: 0,
        playerCard: null,
        machineCard: null,
        mazo: [],
        historial: []
    };

    async function cargarMazo() {
        const response = await fetch("/api/start_game.php");
        const data = await response.json();
        gameState.mazo = data.mazo;
        elegirCartas();
    }

    function elegirCartas() {
        const indiceJugador = Math.floor(Math.random() * gameState.mazo.length);
        const indiceCpu = Math.floor(Math.random() * gameState.mazo.length);
        gameState.playerCard = gameState.mazo[indiceJugador];
        gameState.machineCard = gameState.mazo[indiceCpu];
    }

    function actualizarUI() {
        playerCard.innerHTML = `
        <img src="${gameState.playerCard.imagen}" alt="${gameState.playerCard.nombre}" class="card-img"
        <div class="stat ataque">${gameState.playerCard.ataque}</div>
        <div class="stat defensa">${gameState.playerCard.defensa}</div>`;

        machineCard.innerHTML = `
        <img src="${gameState.machineCard.imagen}" alt="${gameState.machineCard.nombre}" class="card-img"
        <div class="stat-ataque">${gameState.machineCard.ataque}</div>
        <div class="stat-defensa">${gameState.machinerCard.defensa}</div>`;
    
    ronda.textContent = gameState.ronda;
    puntuacionJugador.textContent = gameState.scoreJugador;
    puntuacionCpu.textContent = gameState.scoreCpu;

    }
});