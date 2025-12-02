## Autenticación y usuarios

### `login.php`
**Método:** POST  
**Descripción:** Inicia sesión de un usuario con email y contraseña.  
**Request body (JSON):**
```json
{
  "email": "usuario@example.com",
  "password": "contraseña"
}
```
**Respuesta (JSON) exitosa:**
```json
{
  "success": true,
  "message": "Inicio de sesión correcto.",
  "user": {
    "id": 1,
    "nickname": "Usuario1",
    "email": "usuario@example.com"
  }
}
```

### `logout.php`
**Método:** GET o POST  
**Descripción:** Cierra la sesión actual.  
**Respuesta:**
```json
{
  "success": true,
  "message": "Sesión cerrada correctamente."
}
```

### `check_login.php`
**Método:** GET  
**Descripción:** Verifica si hay un usuario logueado en sesión.  
**Respuesta si hay sesión activa:**
```json
{
  "logged": true,
  "user": {
    "id": 1,
    "nickname": "Usuario1",
    "email": "usuario@example.com"
  }
}
```
**Respuesta si no hay sesión:**
```json
{
  "logged": false,
  "message": "Error: No hay usuarios logueados"
}
```

### `register.php`
**Método:** POST  
**Descripción:** Registra un nuevo usuario.  
**Request body (JSON):**
```json
{
  "nickname": "Usuario1",
  "email": "usuario@example.com",
  "password": "contraseña"
}
```
**Respuesta:**
```json
{
  "success": true,
  "message": "Usuario creado con éxito"
}
```

---

## Juego y puntuaciones

### `start_game.php`
**Método:** GET  
**Descripción:** Devuelve un mazo de cartas barajadas.  
**Respuesta (JSON) exitosa:**
```json
{
  "status": "ok",
  "mazo": [
    {"id":1,"nombre":"Carta1","valor":10},
    {"id":2,"nombre":"Carta2","valor":5}
  ]
}
```
**Respuesta si no hay cartas:**
```json
{
  "status": "error",
  "message": "No hay cartas en la base de datos."
}
```

### `save_score.php`
**Método:** POST  
**Descripción:** Guarda la puntuación y resultado de una partida.  
**Request body (JSON):**
```json
{
  "score": 100,
  "result": "win"
}
```
**Respuesta exitosa:**
```json
{
  "success": true,
  "message": "Partida guardada correctamente"
}
```
**Errores posibles:**
```json
{
  "success": false,
  "message": "Datos incompletos"
}
```

### `get_ranking.php`
**Método:** POST  
**Descripción:** Devuelve el ranking de usuarios según su puntuación.  
**Respuesta (JSON):**
```json
{
  "success": true,
  "ranking": [
    {"id":1,"nickname":"Usuario1","score":500},
    {"id":2,"nickname":"Usuario2","score":400}
  ]
}
```