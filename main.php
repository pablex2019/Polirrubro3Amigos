<?php
    session_start();
        //$categoria = array();
        /*$cont = 0;
        while ($row = mysqli_fetch_array($resultado)) {
            $resultadoa[$cont] = $row['rubro'],$row['categoría'];
        }*/
        //echo json_encode(jsonS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polirrubro 3 Amigos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <section>
        <canvas id="myPieGraph" style="max-height: 200px;"></canvas>
    </section>

</body>
<script>
    /*
    const rubro = <?php echo json_encode($rubro,JSON_UNESCAPED_UNICODE); ?>;
    const categoria = <?php echo json_encode($categoria,JSON_UNESCAPED_UNICODE); ?>;

    const pieData = {
        labels: rubro,
        datasets: [{
            data: [categoria],
            backgroundColor: [
            "#4EADEB",
            ],
            hoverOffset: 2,
        }],
    };

var pieCtx = myPieGraph.getContext('2d');

var myPieChart = new Chart(pieCtx, {
  /* IMPORTANTE: cargamos el complemento 
  plugins: [ChartDataLabels],
  type: 'pie',
  data: pieData,
  options: {
    plugins: {
      datalabels: {
        /* anchor puede ser "start", "center" o "end" 
        anchor: "center",
        /* Podemos modificar el texto a mostrar 
        formatter: (dato) => dato + "%",
        /* Color del texto 
        color: "black",
        /* Formato de la fuente 
        font: {
          family: '"Times New Roman", Times, serif',
          size: "28",
          weight: "bold",
        },
        /* Formato de la caja contenedora 
        //padding: "4",
        //borderWidth: 2,
        //borderColor: "darkblue",
        //borderRadius: 8,
        //backgroundColor: "lightblue"
      }
    }
  }
});*/
</script>
</html>