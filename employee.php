<?php
    // Include config file
    require_once "config.php";
    error_reporting(0);
    $busqueda = $_POST["s"];
    session_start();
    //$sql= "select * from empleado where estado = 0 order by dni asc";
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    if($busqueda!="")
    {
        $sql= "SELECT empleado.id,dni,nombres,apellidos,correo_electrónico,perfil.descripción as descripción FROM empleado
                JOIN perfil on perfil.id = empleado.PERFIL_id
                WHERE empleado.estado = 0 AND nombres like '%$busqueda%' or apellidos like '%$busqueda'
                ORDER BY apellidos ASC";
    }else{
        $sql= "SELECT empleado.id,dni,nombres,apellidos,correo_electrónico,perfil.descripción as descripción FROM empleado
                JOIN perfil on perfil.id = empleado.PERFIL_id
                WHERE empleado.estado = 0
                ORDER BY apellidos ASC";
    }
    $query = $link->query($sql);
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polirrubro 3 Amigos</title>
    <link rel="stylesheet" href="estilos/employee.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse" style="border-radius: 0px 0px 0px 0px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="main.php">Inicio</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <?php
                             switch($_SESSION["perfil"]){
                                case 1:
                                    echo "<li><a href=\"article.php\" style=\"background-color: transparent !important;\">Articulos</a></li>";
                                    echo "<li><a href=\"employee.php\" style=\"background-color: transparent !important;\">Empleados</a></li>";
                                    break;
                                case 4:
                                    echo "<li><a href=\"article.php\" style=\"background-color: transparent !important;\">Articulos</a></li>";
                                    break;
                                default:
                                    break;
                        } ?>    
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main id="principal">
        <h2 id=titulo>Empleados</h2>
        <a id="agregar" data-toggle="modal" href="#myModalCreate" class="btn btn-primary">Agregar</a>
        <!-- Create -->
        <div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Empleado - Agregar</h4>
                                </div>
                                <div class="modal-body">
                                <form role="form" method="post" action="empleados/create.php">
                                    <div class="form-group">
                                        <label for="dni">Dni</label>
                                        <input type="text" id="dni" class="form-control" name="dni" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" id="nombres" class="form-control" name="nombres" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" id="apellidos" class="form-control" name="apellidos" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo_electrónico">Correo Electronico</label>
                                        <input type="email" class="form-control" name="correo_electrónico" id="correo_electrónico" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="usuario">Usuario (Opcional)</label>
                                        <input type="text" class="form-control" name="usuario" id="usuario">
                                    </div>
                                    <div class="form-group">
                                        <label for="clave">Contraseña (Opcional)</label>
                                        <input type="password" class="form-control" name="clave" id="clave">
                                    </div>
                                    <div class="form-group">
                                        <label for="perfil">Perfil</label>
                                        <select name="perfil" class="form-control" id="perfil">
                                            <option value="0">Seleccione</option>
                                                <?php
                                                $query1 = $link -> query ("SELECT * FROM perfil");
                                                while ($valores = mysqli_fetch_array($query1)) { ?>
                                                    <option value=<?php echo $valores[0]; ?>><?php echo $valores[1] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="employee.php">Cancelar</a>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
        <!-- Edit -->
        <div class="modal fade" id="myModalEdit" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Empleado - Editar</h4>
                                </div>
                                <div class="modal-body">
                                <form role="form" method="post" action="empleados/edit.php">
                                    <div class="form-group">
                                        <input type="hidden" name="idEdit" id="idEdit">
                                        <label for="dni">Dni</label>
                                        <input type="text" class="form-control" id="dniEdit" name="dniEdit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" class="form-control" id="nombresEdit" name="nombresEdit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidosEdit" name="apellidosEdit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo_electrónico">Correo Electronico</label>
                                        <input type="text" class="form-control" id="correo_electrónicoEdit" name="correo_electrónicoEdit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="usuario">Usuario (Opcional)</label>
                                        <input type="text" class="form-control" name="usuarioEdit" id="usuarioEdit">
                                    </div>
                                    <div class="form-group">
                                        <label for="clave">Contraseña (Opcional)</label>
                                        <input type="password" class="form-control" name="claveEdit" id="claveEdit">
                                    </div>
                                    <div class="form-group">
                                        <label for="perfil">Perfil</label>
                                        <select name="perfilEdit" class="form-control" id="perfilEdit">
                                            <option value="0">Seleccione</option>
                                                <?php
                                                $query2 = $link -> query ("SELECT * FROM perfil");
                                                while ($valores2 = mysqli_fetch_array($query2)) { ?>
                                                    <option value=<?php echo $valores2[0]; ?>><?php echo $valores2[1] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="employee.php">Cancelar</a>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
        <form class="navbar-form navbar-right" id="formularioBusqueda" role="search" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class = "form-group">
                <input type="text" id="campobusqueda" name="s" class="form-control" placeholder="Buscar" value="<?php echo $busqueda;?>">
            </div>
            <button type="submit" class="btn btn-default" id="buscar"><i class="glyphicon glyphicon-search"></i></button>
        </form>
        <?php if($query->num_rows>0):?>
        <table id="tabla" class="table table-hover" >
            <thead>
                <tr>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo Electronico</th>
                    <th>Perfil</th>
                    <th>Acciones</th>    
                </tr>
            </thead>
            <tbody>
                <?php while ($r=$query->fetch_array()):?>
                <tr>
                    <td><?php echo $r["dni"]; ?></td>
                    <td><?php echo $r["nombres"]; ?></td>
                    <td><?php echo $r["apellidos"]; ?></td>
                    <td><?php echo $r["correo_electrónico"]; ?></td>
                    <td><?php echo $r["descripción"]; ?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#myModalEdit" data-id="<?php echo $r["id"]; ?>" class="btn btn-sm btn-warning"><abbr title="Editar"><span class="glyphicon glyphicon-pencil"></span></abbr></a>
                        <a href="#" id="del-<?php echo $r["id"]; ?>"class="btn btn-sm btn-danger"><abbr title="Eliminar"><span class="glyphicon glyphicon-trash"></span></abbr></a>
                        <script>
                            $("#del-"+<?php echo $r["id"]; ?>).click(function(e){
                                e.preventDefault();
                                p = confirm("¿Estas seguro de eliminar?");
                                if(p){
                                    window.location="empleados/delete.php?id="+<?php echo $r["id"];?>;
			                    }
                            });
                        </script>
                    </td> 
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
        <script>
            let enlace  = document.querySelectorAll('[data-target="#myModalEdit"]');
            enlace.forEach(a => {
                a.addEventListener('click', function() {
                    let tds = this.closest('tr').querySelectorAll('td');
                    let id = this.dataset.id;
                    let dni = tds[0].innerText;
                    let nombres = tds[1].innerText;
                    let apellidos = tds[2].innerText;
                    let correo_electrónico = tds[3].innerText;
                    // Asignar datos a ventana modal:
                    document.querySelector('#idEdit').value = id;
                    document.querySelector('#dniEdit').value = dni;
                    document.querySelector('#nombresEdit').value = nombres;
                    document.querySelector('#apellidosEdit').value = apellidos;
                    document.querySelector('#correo_electrónicoEdit').value = correo_electrónico;
                });
            });
        </script>
        <?php else:?>
                <br><br><p id="mensaje" class="alert alert-warning">No hay resultados</p>
        <?php endif;?>
    </main>
</body>
</html>