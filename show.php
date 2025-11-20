<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>VS Game</title>
</head>
<body>

<form action="" method="GET" id="formEnvio" style="display: none";>
    <select name="opcionJugada" id="opcionJugada">
        <option value="ataque">Ataque</option>
        <option value="defensa">Defensa</option>
    </select>
    <input type="submit" value="Enviar">
</form>

<div class="container">
    <div class="card" id="playerCard">
    </div>
    <img src="assets/images/vs.png" alt="VS" class="vs">
    <div class="card" id="machineCard">
    </div>
    </div>
<div class="container">
    <div class="buttons" >
      <a href="#" id="atacar" onclick="atacar(); return false"> <!-- FALTA ENLACE Y CAMBIAR ONCLICK POR EVENTOS-->
        <img src="assets/images/atacar.png" alt="Carta del Jugador" class="btn" >
      </a>
      <a href="#" id="defender"  onclick="defender(); return false">
        <img src="assets/images/defender.png" alt="Carta del Jugador" class="btn" >
      </a>
    </div>
    
</div>
  <button id='restartBtn'>
      <img src="assets/images/restartgame.png" alt="reiniciar" id="restartGame">
  </button>
<div class="score">
    <div class="contentScore">
    <div id="bandera" class="show">
      <img src="assets/images/win1.png" alt="win1" class="win1">
      <!-- win2.png quizá no es necesaria, en el video demo nunca se activa-->
      <!-- <img src="img/win2.png" alt="win2" class="win2"> -->
     
    </div>
      <img src="assets/images/score.png" alt="reiniciar" id="scoreGame">
      <div class="ronda">
        1
      </div>
      <div class="puntuacionJugador">
        2
      </div>
      <div class="puntuacionCpu">
         3
      </div>
    </div>
</div>

<div class="popup active" id="popup">
        <div class="popup-content">
            <button class="close-btn" id="closePopupBtn">&times;</button>
            <h2>Jugada</h2>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, provident.
        </div>
    </div>

</body>
</html>
