<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/app.js"></script>
    <title>VS Game</title>
</head>
<body>

<div class="container">
    <div class="card" id="playerCard">
    </div>
    <img src="assets/images/vs.png" alt="VS" class="vs">
    <div class="card" id="machineCard">
    </div>
    </div>
<div class="container">
    <div class="buttons" >
      <a href="#" id="atacar">
        <img src="assets/images/atacar.png" alt="Carta del Jugador" class="btn" >
      </a>
      <a href="#" id="defender">
        <img src="assets/images/defender.png" alt="Carta del Jugador" class="btn" >
      </a>
    </div>
    
</div>
  <button id='restartBtn'>
      <img src="assets/images/restartgame.png" alt="reiniciar" id="restartGame">
  </button>
  <button id='logout'>
      <img src="assets/images/logout.png" alt="reiniciar" id="logoutBtn">
  </button>
<div class="score">
    <div class="contentScore">
    <div id="bandera" class="show">
      <img src="assets/images/win1.png" alt="win1" class="win1">
      <img src="assets/images/win2.png" alt="win2" class="win2">
     
    </div>
      <img src="assets/images/score.png" alt="reiniciar" id="scoreGame">
      <div class="ronda">
      </div>
      <div class="puntuacionJugador">
      </div>
      <div class="puntuacionCpu">
      </div>
    </div>
</div>

<div class="popup" id="popup">
        <div class="popup-content">
            <button class="close-btn" id="closePopupBtn">&times;</button>
            <h2>Jugada</h2>
            <p></p>
        </div>
    </div>
</body>
</html>
