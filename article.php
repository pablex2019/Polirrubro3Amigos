<?php
    // Include config file
    require_once "config.php";
    error_reporting(0);
    $busqueda = $_POST["s"];
    //$sql= "select * from empleado where estado = 0 order by dni asc";

    if($busqueda!="")
    {
        $sql= "SELECT  @i := @i + 1 as contador,a.id,a.descripción,a.cantidad,a.precio_costo,a.precio_venta,'' as utilidad,r.descripción as rubro_descripción,c.descripción as categoría_descripción 
                FROM articulo as a JOIN categoría as c ON c.id = a.CATEGORÍA_id 
                JOIN rubro as r ON r.id = c.RUBRO_id 
                CROSS JOIN (SELECT @i := 0) articulo
                WHERE a.estado = 0 and a.descripción like '%$busqueda%' 
                OR r.descripción like '%$busqueda%' OR c.descripción like '%$busqueda%'
                ORDER BY contador ASC";
    }else{
        $sql= "SELECT  @i := @i + 1 as contador,a.id,a.descripción,a.cantidad,a.precio_costo,a.precio_venta,'' as utilidad,r.descripción as rubro_descripción,c.descripción as categoría_descripción 
                 FROM articulo as a JOIN categoría as c ON c.id = a.CATEGORÍA_id 
                 JOIN rubro as r ON r.id = c.RUBRO_id 
                 CROSS JOIN (SELECT @i := 0) articulo
                 WHERE a.estado = 0 
                 ORDER BY contador ASC";
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
    <link rel="stylesheet" href="estilos/article.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    
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
                    <a class="navbar-brand" href="main.php">Polirrubro 3 Amigos</a>
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
        <h2 id=titulo>Articulos</h2>
        <?php
            if($_SESSION["perfil"]==1) { ?>
                <a id="agregar" data-toggle="modal" href="#myModalCreate" class="btn btn-primary">Agregar</a>
                <button id="descargarPDF" type="button" class="btn btn-success" onclick="Export()">Descargar PDF</button>
        <?php } ?>
        <?php
            if($_SESSION["perfil"]==4) { ?>
                <button id="descargarPDF" type="button" class="btn btn-success" onclick="Export()">Descargar PDF</button>
        <?php } ?>
        <!-- Create -->
        <div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Articulo - Agregar</h4>
                                </div>
                                <div class="modal-body">
                                <form role="form" method="post" action="articulos/create.php">
                                    <div class="form-group">
                                        <label for="descripción">Descripción</label>
                                        <input type="text" id="descripción" class="form-control" name="descripción" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="text" id="cantidad" class="form-control" name="cantidad" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Precio Costo</label>
                                        <input type="text" id="precio_costo" class="form-control" name="precio_costo">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Precio Venta</label>
                                        <input type="text" id="precio_venta" class="form-control" name="precio_venta">
                                    </div>
                                    <div class="form-group">
                                        <label for="rubro">Rubro</label>
                                        <select name="rubro" class="form-control" id="rubro" required>
                                            <option value="0">Seleccione</option>
                                                <?php
                                                $query1 = $link -> query ("SELECT * FROM rubro");
                                                while ($valores = mysqli_fetch_array($query1)) { ?>
                                                    <option value=<?php echo $valores[0]; ?>><?php echo $valores[1] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoría">Categoria</label>
                                        <select name="categoría" class="form-control" id="categoría" required>
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="article.php">Cancelar</a>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
        <!-- Edit -->
        <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Articulo - Editar</h4>
                                </div>
                                <div class="modal-body">
                                <form role="form" method="post" action="articulos/edit.php">
                                <?php
                                    if($_SESSION["perfil"]==1) { ?>
                                        <div class="form-group">
                                            <input type="hidden" name="idEdit" id="idEdit">
                                            <label for="descripción">Descripción</label>
                                            <input type="text" id="descripciónEdit" class="form-control" name="descripciónEdit" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="text" id="cantidadEdit" class="form-control" name="cantidadEdit" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellidos">Precio Costo</label>
                                            <input type="text" id="precio_costoEdit" class="form-control" name="precio_costoEdit">
                                        </div>
                                        <div class="form-group">
                                            <label for="apellidos">Precio Venta</label>
                                            <input type="text" id="precio_ventaEdit" class="form-control" name="precio_ventaEdit">
                                        </div>
                                        <div class="form-group">
                                            <label for="rubroEdit">Rubro</label>
                                                <select name="rubroEdit" class="form-control" id 
                                                ="rubroEdit">
                                                    <option value="0">Seleccione</option>
                                                        <?php 
                                                        $query2 = $link -> query ("SELECT * FROM rubro");
                                                        while ($valores1 = mysqli_fetch_array($query2)) { ?>
                                                                <option value=<?php echo $valores1[0]; ?>><?php echo $valores1[1] ?></option>
                                                        <?php } ?>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="categoríaEdit">Categoria</label>
                                            <select name="categoríaEdit" class="form-control" id="categoríaEdit" required>
                                                <option value="0">Seleccione</option>
                                                <p>The time is <span id="time"></span>.</p>
                                                        <?php 
                                                        $variable = "<div id=\"demo\">as</div>";
                                                            echo $variable;
                                                        $query3 = $link -> query ("SELECT c.id as id,c.descripción as descripción FROM categoría as c
                                                        JOIN rubro as r ON r.id = c.RUBRO_id
                                                        /*WHERE c.RUBRO_id = $idr*/
                                                        ORDER BY c.descripción ASC");
                                                        while ($valores2 = mysqli_fetch_array($query3)) { ?>
                                                                <option value=<?php echo $valores2[0]; ?>><?php echo $valores2[1] ?></option>
                                                        <?php } ?>       
                                            </select>
                                        </div>
                                <?php } ?>
                                <?php if($_SESSION["perfil"]== 4) { ?>
                                    <div class="form-group">
                                            <label for="descripción">Descripción</label>
                                            <input type="text" id="descripciónEdit" class="form-control" name="descripciónEdit" readonly>
                                        </div>
                                    <div class="form-group">
                                        <input type="hidden" name="idEdit2" id="idEdit2">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="text" id="cantidadEdit2" class="form-control" name="cantidadEdit2" required>
                                    </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-default" href="article.php">Cancelar</a>
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
        <table data-role="table" data-mode="columntoggle" class="table table-hover ui-responsive" id="tabla" class="">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Descripción</th>
                    <th style="text-align:center">Cantidad</th>
                    <th style="text-align:center">Precio Costo</th>
                    <th style="text-align:center">Precio Venta</th>
                    <th style="text-align:center">Utilidad Bruta (%) </th>
                    <th style="text-align:center">Rubro</th>
                    <th style="text-align:center">Categoría</th>
                    <th>Acciones</th>    
                </tr>
            </thead>
            <tbody>
                <?php while ($r=$query->fetch_array()):?>
                        <tr>
                            <td><?php echo $r["contador"];?></td>
                            <td><?php echo $r["descripción"]; ?></td>
                            <td style="text-align:center"><?php echo $r["cantidad"]; ?></td>
                            <td style="text-align:center"><?php echo $r["precio_costo"]; ?></td>
                            <td style="text-align:center"><?php echo $r["precio_venta"]; ?></td>
                            <td style="text-align:center"><?php echo number_format((($r["precio_venta"] - $r["precio_costo"]) / $r["precio_venta"])*100,2,".","");?></td>
                            <td style="text-align:center"><?php echo $r["rubro_descripción"]; ?></td>
                            <td style="text-align:center"><?php echo $r["categoría_descripción"]; ?></td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#myModalEdit" data-id="<?php echo $r["id"]; ?>" class="btn btn-sm btn-warning"><abbr title="Editar"><span class="glyphicon glyphicon-pencil"></span></abbr></a>
                                <?php
                                    if($_SESSION["perfil"]==1) { ?>
                                        <a href="#" id="del-<?php echo $r["id"]; ?>"class="btn btn-sm btn-danger"><abbr title="Eliminar"><span class="glyphicon glyphicon-trash"></span></abbr></a>
                                <?php } ?>
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
        <?php else:?>
                <br><br><p id="mensaje" class="alert alert-warning">No hay resultados</p>
        <?php endif;?>
    </main>
    </body>
    <script>
        
            function Export() {

                html2canvas(document.getElementById('tabla'), {
                    
                    onrendered:function(canvas) {
                        var contentWidth = canvas.width;
                        var contentHeight = canvas.height;
                        // Una página de pdf muestra la altura del lienzo generado por la página html;
                        var pageHeight = contentWidth / 592.28 * 841.89;
                        // La altura de la página html del pdf no se genera
                        var leftHeight = contentHeight;
                        // Desplazamiento de página
                        var position = 0;
                        // El tamaño del papel a4 [595.28,841.89], el ancho y el alto de la imagen en el pdf generado por el lienzo en la página html
                        var imgWidth = 595.28; 
                        var imgHeight = 592.28/contentWidth * contentHeight;
                        // Devolver datos de imagen URL, parámetros: formato de imagen y nitidez (0-1)
                        var pageData = canvas.toDataURL('image/jpeg', 3.0);
                        // La orientación es vertical por defecto, el tamaño de los ponits y el formato a4 [595.28,841.89]
                        var pdf = new jsPDF('', 'pt', 'a4');
                        // Hay dos alturas que deben distinguirse, una es la altura real de la página html y la altura de la página del pdf generado (841.89)
                        // Cuando el contenido no excede el rango mostrado en una página de pdf, no se requiere paginación
                        if (leftHeight < pageHeight) {
                            pdf.addImage(pageData, 'JPEG', 0, 0, imgWidth, imgHeight );
                        } else {
                            while(leftHeight > 0) {
                                pdf.addImage(pageData, 'JPEG', 0, position, imgWidth, imgHeight)
                                leftHeight -= pageHeight;
                                position -= 841.89;
                                                // Evita agregar páginas en blanco
                                if(leftHeight > 0) {
                                    pdf.addPage();
                                }
                            }
                        }
                        var today = new Date();
                        pdf.save('Articulos'+' '+today.toLocaleString()+'.pdf');
                    }
                });
            }
            $(document).ready(function(){
                
                $("#rubro").on('change', function () {
                    $("#rubro option:selected").each(function () {
                        var id_rubro = $(this).val();
                        $.post("articulos/categorias.php", { id_rubro: id_rubro }, function(data) {
                            $("#categoría").html(data);
                        });			
                    });
                });
                
                $("#rubroEdit").change(function () {
                    $("#rubroEdit option:selected").each(function () {
                        var id_rubroEdit = $(this).val();
                        console.log(id_rubroEdit);
                        $.post("articulos/categorias.php", { id_rubroEdit: id_rubroEdit }, function(data) {
                            $("#categoríaEdit").html(data);
                        });			
                    });
                });

            });
            var r = '';
            let enlace  = document.querySelectorAll('[data-target="#myModalEdit"]');
            enlace.forEach(a => {
                a.addEventListener('click', function() {
                    let tds = this.closest('tr').querySelectorAll('td');
                    let id = this.dataset.id;
                    
                    let url = "articulos/getRubro.php"
                    let formData = new FormData();
                    formData.append('id',id)

                    fetch(url,{
                        method: "POST",
                        body: formData
                    }).then(response => response.json()).then(data => {
                        idEdit.value = data.id
                        idEdit2.value = data.id
                        cantidadEdit2.value = data.cantidad
                        document.querySelector('#descripciónEdit').value = data.descripción
                        document.querySelector('#cantidadEdit').value = data.cantidad
                        document.querySelector('#precio_costoEdit').value = data.precio_costo
                        document.querySelector('#precio_ventaEdit').value = data.precio_venta
                        document.querySelector('#rubroEdit').value = data.id_rubro
                        document.querySelector('#categoríaEdit').value = data.id_categoría
                        let idrubro = document.querySelector('#rubroEdit').value = data.id_rubro
                        $.ajax({
                            url: 'article.php',
                            method: 'GET',
                            data:{idrubro,idrubro}, 
                            success:function(respuesta){
                                //console.log(data[6])
                                r = data[6].toString()
                            },
                            error: function(e){
                            }
                        })
                    }).catch(err => console.log(err))
                });
            });
            
        </script>
</html>