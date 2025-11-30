document.addEventListener("DOMContentLoaded", () => {

    const showLogin = document.getElementById("showLogin");
    const showRegister = document.getElementById("showRegister");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const logout = document.getElementById("logout");

    //Cambiar entre formularios
    if(showRegister) {
        showRegister.addEventListener("click", (e) => {
            e.preventDefault();
            loginForm.style.display = "none";
            registerForm.style.display = "block";
        });
    }

    if(showLogin) {
        showLogin.addEventListener("click", (e) => {
            e.preventDefault();
            registerForm.style.display = "none";
            loginForm.style.display = "block";
        });
    }

    //Validar registro
    if(registerForm) {
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
            const response = await fetch("http://localhost/Proyecto/vsgame/api/register.php", {

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
    }

    //Login
    if(loginForm) {
        loginForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const email = document.querySelector("#loginForm input[name='email']").value.trim();
            const password = document.querySelector("#loginForm input[name='password']").value;
            
            if(!email || !password) {
                alert("Introduce email y contraseña");

                return;
            }
            //fetch de login
            const response = await fetch("http://localhost/Proyecto/vsgame/api/login.php", {

                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },

                    body: JSON.stringify({email, password})

            });

            const result = await response.json();
            if(result.success) {
                window.location.href = "show.php"; 
            } else { 
                alert(result.message); }
        });
    }

    //Logout
    if(logout) {
        logout.addEventListener("click", async () => {
            const response = await fetch("http://localhost/Proyecto/vsgame/api/logout.php", {
                    method: "POST",
                    headers: { "Content-type": "application/json" },
                    credentials: "include",
                    body: JSON.stringify({})
            });

            const result = await response.json();

            if(result.success){
                window.location.href = "login.php";
            } else {
                alert("Error al cerrar sesión");
            }
        });
    }



    //LÓGICA DEL JUEGO

    //const opcionJugada = document.getElementById('opcionJugada');
    const atacar = document.getElementById('atacar');
    const defender = document.getElementById('defender');
    const playerCard = document.getElementById('playerCard');
    const machineCard = document.getElementById('machineCard');
    const ronda = document.querySelector('.ronda');
    const puntuacionJugador = document.querySelector('.puntuacionJugador');
    const puntuacionCpu = document.querySelector('.puntuacionCpu');
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

        const response = await fetch("http://localhost/Proyecto/vsgame/api/start_game.php");

        const data = await response.json();
        gameState.mazo = data.mazo;
        elegirCartas();
    }

    function elegirCartas() {
        const indiceJugador = Math.floor(Math.random() * gameState.mazo.length);
        const indiceCpu = Math.floor(Math.random() * gameState.mazo.length);
        gameState.playerCard = gameState.mazo[indiceJugador];
        gameState.machineCard = gameState.mazo[indiceCpu];

        actualizarUI();
    }

    function actualizarUI() {
        playerCard.innerHTML = `
        <img src="assets/images/cards/${gameState.playerCard.imagen}" alt="${gameState.playerCard.nombre}" class="card-img">
        <div class="stat-ataque">${gameState.playerCard.ataque}</div>
        <div class="stat-defensa">${gameState.playerCard.defensa}</div>`;

        machineCard.innerHTML = `
        <img src="assets/images/cards/${gameState.machineCard.imagen}" alt="${gameState.machineCard.nombre}" class="card-img">
        <div class="stat-ataque">${gameState.machineCard.ataque}</div>
        <div class="stat-defensa">${gameState.machineCard.defensa}</div>`;
    
        ronda.textContent = gameState.ronda;
        puntuacionJugador.textContent = gameState.scoreJugador;
        puntuacionCpu.textContent = gameState.scoreCpu;

    }

    function jugarRonda(accionJugador) {
        let jugadorValor;

        if(accionJugador === 'ataque') {
        jugadorValor = gameState.playerCard.ataque;
        } else {
        jugadorValor = gameState.playerCard.defensa;
        }

        let accionCpu;
        let cpuValor;

        if (Math.random() < 0.5) {
         accionCpu = 'ataque';
         cpuValor = gameState.machineCard.ataque;
        } else {
         accionCpu = 'defensa';
         cpuValor = gameState.machineCard.defensa;
        }

        let ganador;

        if(jugadorValor > cpuValor) {
         ganador = "Jugador";
         gameState.scoreJugador++;
        } else if(cpuValor > jugadorValor) {
         ganador = "CPU";
         gameState.scoreCpu++;
        } else {
         ganador = "Empate";
        }

        popup.querySelector("h2").textContent = `Ronda: ${gameState.ronda}`;
        popup.querySelector("p").textContent = `Ganador de la ronda: ${ganador} (El rival usó ${accionCpu})`;
        popup.classList.add("active");

        gameState.ronda++;
        ronda.textContent = gameState.ronda;

        if (gameState.ronda <= gameState.maxRondas) {
        elegirCartas();
        }

        if (gameState.ronda > gameState.maxRondas) {
            popup.querySelector("h2").textContent = "Fin del juego";
            popup.querySelector("p").textContent = `Jugador: ${gameState.scoreJugador} | Cpu: ${gameState.scoreCpu}`;
        }
    }

    function reiniciarJuego() {
        gameState.ronda = 1;
        gameState.scoreJugador = 0;
        gameState.scoreCpu = 0;
        gameState.historial = [];
        elegirCartas();
    }

    //LISTENERS
    if(atacar) {
        atacar.addEventListener('click', () => {
            jugarRonda('ataque');
        });
    }

    if(defender) {
        defender.addEventListener('click', () => {
            jugarRonda('defensa');
        });
    }

    if(closePopupBtn) {
        closePopupBtn.addEventListener('click', () => {
            popup.classList.remove('active');
            if (gameState.ronda > gameState.maxRondas) {
                reiniciarJuego();
            }
        });
    }

    if(restartBtn) restartBtn.addEventListener('click', reiniciarJuego);
    
    //INICIO
    async function init() {
        await cargarMazo();
    };

    init();
});