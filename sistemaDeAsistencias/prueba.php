<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Autocompletado</title>
</head>
<body>

    <h1>Formulario con Autocompletado</h1>
    <form action="/submit" method="post" autocomplete="on">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" autocomplete="name" required maxlength="20" ><br><br>
        
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" autocomplete="family-name" required maxlength="20" ><br><br>
        
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" autocomplete="email" required maxlength="20" ><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" autocomplete="street-address" required maxlength="20" ><br><br>
        
        <label for="ciudad">Ciudad:</label><br>
        <input type="text" id="ciudad" name="ciudad" autocomplete="city" required maxlength="20" ><br><br>
        
        <label for="codigo_postal">Código Postal:</label><br>
        <input type="text" id="codigo_postal" name="codigo_postal" autocomplete="postal-code" required maxlength="20" ><br><br>
        
        <button type="submit">Enviar</button>
    </form>

</body>

<script>

    
</script>
</html>
