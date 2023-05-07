<?php
    require_once("c://xampp/htdocs/proyecto/view/head/head.php");
    require_once("c://xampp/htdocs/proyecto/controller/usernameController.php");
    $obj = new usernameController();
    $rows = $obj->index();
?>

<div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Agregar nuevo usuario</button>
</div>


<!-- Modal para agregar nuevo usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="store.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre del usuario</label>
                        <input type="text" name="nombre" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if($rows): ?>
            <?php foreach($rows as $row): ?>
                <tr>
                    <th><?= $row[0] ?></th>
                    <th><?= $row[1] ?></th>
                    <th>
                        <a href="show.php?id=<?= $row[0]?>" class="btn btn-primary">Ver</a>
                        <!-- ward -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?=$row[0]?>">
                            Editar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="editModal<?=$row[0]?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Aquí va el formulario de edición -->
                                        <form action="update.php" method="post" autocomplete="off">
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Id</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="id" readonly class="form-control-plaintext" id="staticEmail" value="<?= $row[0]?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Nuevo Nombre</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nombre" class="form-control" id="inputPassword" value="<?= $row[1]?>">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="submit" class="btn btn-success" value="Actualizar">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#id<?=$row[0]?>">Eliminar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="id<?=$row[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar el registro?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Una vez eliminado no se podra recuperar el registro
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                                        <a href="delete.php?id=<?= $row[0]?>" class="btn btn-danger">Eliminar</a>
                                        <!-- <button type="button" >Eliminar</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
            <td colspan="3" class="text-center">No hay registros actualmente</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal para eliminar usuario -->
<?php foreach($rows as $row): ?>
    <div class="modal fade" id="eliminarModal<?=$row[0]?>" tabindex="-1" aria-labelledby="eliminarModalLabel<?=$row[0]?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel<?=$row[0]?>">Eliminar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar al usuario <strong><?=$row[1]?></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="delete.php?id=<?=$row[0]?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal para agregar nuevo usuario -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarModalLabel">Agregar nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="store.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del usuario</label>
                        <input type="text" name="nombre" required class="form-control" id="nombre">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    var agregarModal = document.getElementById('agregarModal');
    var myModal = new bootstrap.Modal(agregarModal, {
        keyboard: false
    });
</script>

<?php
    require_once("c://xampp/htdocs/proyecto/view/head/footer.php");
?>