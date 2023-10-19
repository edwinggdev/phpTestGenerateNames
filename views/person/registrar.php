<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>
    <?php require 'views/header.php'; ?>
    <h1>Pagina Nuevo</h1>
    <div><?= $this->mensaje; ?></div>
    <form action="<?= constant('URL') ?>alumno/guardar" method="POST">
        <p>
            <label for="matricula">Matricula</label>
            <input type="text"  name="matricula" id="">
        </p>
        <p>
            <label for="nombre">Nombre</label>
            <input type="text"  name="nombre" id="">
        </p>
        <p>
            <label for="apellido">Apellido</label>
            <input type="text"  name="apellido" id="">
        </p>
        <p>
            <input type="submit" value="Registrar" id="">
        </p>
    </form>
    <?php require 'views/footer.php'; ?>
</body>
</html>