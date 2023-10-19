<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    
</head>
<body>
    <?php require 'views/header.php'; ?>
    <h1>Pagina Personas</h1>
    <div>
        <!-- <?= var_dump($this->persons) ?> -->
        <a href="<?= constant('URL').'person/registrar' ?>">Nueva Persona</a>
        <a href="#" onClick="generate()">Generar</a>
        <a href="#" onClick="load()">cargar</a>
        <table>
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Editar</th>
                <th>Desactivar</th>
            </thead>
            <tbody id="table_persons">
                <?php foreach($this->persons as $row){
                    $person = new Person();
                    $person = $row;
                               
                ?>
                <tr>
                    <td><?= $person->id ?></td>
                    <td><?= $person->name ?></td>
                    <td><?= $person->lastname ?></td>
                    <td><?= $person->age ?></td>
                    <td><a href="#" onclick="edit(<?= $person->id ?>, <?= $person->name ?>, <?= $person->lastname ?>, <?= $person->age ?>)">Editar</a></td>
                    <td><a href="#" onclick="delete1(<?= $person->id ?>)">Eliminar</a></td>
                    <!-- <td><a href="<?= constant('URL').'person/ver/'. $person->id ?>">Editar</a></td>
                    <td><a href="<?= constant('URL').'person/eliminar/'. $person->id ?>">Eliminar</a></td> -->
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary" onclick='openModal()'>
        Launch demo modal
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="frm">
                        <input type="text" name="txt_id" value="">
                        <input type="text" name="txt_name" value="">
                        <input type="text" name="txt_lastname" value="">
                        <input type="text" name="txt_age" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="update()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>

    <?php require 'views/footer.php'; ?>
   <script src="./vendor/js/app.js">

   </script>
</body>
</html>