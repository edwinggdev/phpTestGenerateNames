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
    <form action="<?= constant('URL') ?>alumno/actualizar" method="POST">
    <input type="hidden"  name="id" value="<?= $this->alumno->id ?>" >
        <p>
            <label for="matricula">Matricula</label>
            <input type="text"  name="matricula" value="<?= $this->alumno->matricula ?>" >
        </p>
        <p>
            <label for="nombre">Nomre</label>
            <input type="text"  name="nombre" value="<?= $this->alumno->nombre ?>">
        </p>
        <p>
            <label for="apellido">Apellido</label>
            <input type="text"  name="apellido" value="<?= $this->alumno->apellido ?>">
        </p>
        <p>
            <input type="submit"  value="Registrar" id="">
        </p>
    </form>
    <?php require 'views/footer.php'; ?>
</body>
</html>