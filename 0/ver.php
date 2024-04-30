<?php

include("conexao.php");

//verifico se recebeu o id do produto
if (!isset($_GET["id"])) {
    header("consulta.php");
}
//busco o produto com o id
$_GET["id"];

$sql_query = $mysqli->query("SELECT * FROM logo") or die($mysqli->error);
$logo = $sql_query->fetch_assoc();

//select para randomizar
//$sql_query = $mysqli->query("SELECT * FROM arquivos WHERE id =" . $_GET["id"]) or die($mysqli->error);
//$arquivo = $sql_query->fetch_assoc();

//randomiza id
//$num = random_int($arquivo["id"] + 1, $_GET['id'] + 5);

//pega um numero aleatório excluindo o id do produto atual

//pega produto clicado
$sql_query = $mysqli->query("SELECT * FROM arquivos WHERE id =" . $_GET["id"]) or die($mysqli->error);
//pega outros produtos
//$sql_query2 = $mysqli->query("SELECT * FROM arquivos WHERE id=" . $num) or die($mysqli->error);

$arquivo = $sql_query->fetch_assoc();
//$arquivo2 = $sql_query2->fetch_assoc();

function getRandomNumber()
{
    do {
        $num = random_int(1, 12);
    } while (in_array($num, array($_GET['id'])));

    return $num;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>

    <link rel="shortcut icon" href="<?php echo $logo['path']; ?>" type="image/x-icon">

    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--bootstrap js-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <!--link arquivo css-->
    <link rel="stylesheet" href="style.css">

    <style>
        h2 {
            color: aqua;
        }
    </style>
</head>

<body>
    <!--inclui o header-->
    <?php include 'header.php'; ?>

    <div class="" style="background-color:black">
        <br>
    </div>

    <!-- Product section-->
    <div class="" style="width:100%; background-color:black;">
        <img class="card-img-top mb-5 mb-md-0" style="width: 90%; margin-left:5%" src="<?php echo $arquivo['path']; ?>"
            alt="..." />
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6" style="color:white">
                    <h1 class="display-5 fw-bolder">
                        <?php echo $arquivo['denominacao']; ?>
                    </h1>
                    <div class="fs-5 mb-5">
                        <?php echo date("d/m/Y H:i", strtotime($arquivo['data_upload'])); ?>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem
                        quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis
                        delectus ipsam minima ea iste laborum vero?</p>
                    <a href="<?php echo $arquivo['path']; ?>">
                        <button style="width: 100%; height: 60px; font-size: 25px"> Ver mais</button>
                    </a>

                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="">
            <h1 class="fw-bolder mb-4 ml-5">Mais Artes</h2>
                <div class="container mt-5" style="align-items:center; justify-content:center;">
                    <div class="row">
                        <div class="fundo ml-4" style="margin-top: 5%;">
                            <?php
                            //select para randomizar
                            $sql_query = $mysqli->query("SELECT * FROM arquivos WHERE id =" . $_GET["id"]) or
                                die($mysqli->error);
                            $arquivo = $sql_query->fetch_assoc();

                            //pega outros produtos
                            $sql_query2 = $mysqli->query("SELECT * FROM arquivos WHERE id=" . getRandomNumber()) or die($mysqli->error);

                            $arquivo2 = $sql_query2->fetch_assoc();
                            ?>
                            <div class="col-md-4 float-left">
                                <div class="card">
                                    <a href="<?php echo $arquivo2['path']; ?>"><img class="card-img-top"
                                            src="<?php echo $arquivo2['path']; ?>" alt="Card image cap"
                                            height="150"></a>
                                    <div class="card-body">
                                        <h2 style="margin-bottom:0px; margin-top:0px">
                                            <?php echo $arquivo2['id']; ?>
                                        </h2>
                                        <h5 class="card-title" style="text-align:center;">
                                            <?php echo $arquivo2['denominacao']; ?>
                                        </h5>
                                        <?php echo date("d/m/Y H:i", strtotime($arquivo2['data_upload'])); ?>
                                        <a href="ver.php?id=<?php echo $arquivo2['id']; ?>"><button
                                                style="width: 100%;">
                                                Ver
                                                mais
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fundo ml-5" style="margin-top: 5%;">
                            <?php
                            //select para randomizar
                            $sql_query = $mysqli->query("SELECT * FROM arquivos WHERE id =" . $_GET["id"]) or
                                die($mysqli->error);
                            $arquivo = $sql_query->fetch_assoc();

                            //pega outros produtos
                            $sql_query2 = $mysqli->query("SELECT * FROM arquivos WHERE id=" . getRandomNumber()) or die($mysqli->error);

                            $arquivo2 = $sql_query2->fetch_assoc();
                            ?>
                            <div class="col-md-4 float-left">
                                <div class="card">
                                    <a href="<?php echo $arquivo2['path']; ?>"><img class="card-img-top"
                                            src="<?php echo $arquivo2['path']; ?>" alt="Card image cap"
                                            height="150"></a>
                                    <div class="card-body">
                                        <h2 style="margin-bottom:0px; margin-top:0px">
                                            <?php echo $arquivo2['id']; ?>
                                        </h2>
                                        <h5 class="card-title" style="text-align:center;">
                                            <?php echo $arquivo2['denominacao']; ?>
                                        </h5>
                                        <?php echo date("d/m/Y H:i", strtotime($arquivo2['data_upload'])); ?>
                                        <a href="ver.php?id=<?php echo $arquivo2['id']; ?>"><button
                                                style="width: 100%;">
                                                Ver
                                                mais
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fundo ml-5" style="margin-top: 5%;">
                            <?php
                            //select para randomizar
                            $sql_query = $mysqli->query("SELECT * FROM arquivos WHERE id =" . $_GET["id"]) or
                                die($mysqli->error);
                            $arquivo = $sql_query->fetch_assoc();

                            //pega outros produtos
                            $sql_query2 = $mysqli->query("SELECT * FROM arquivos WHERE id=" . getRandomNumber()) or die($mysqli->error);

                            $arquivo2 = $sql_query2->fetch_assoc();
                            ?>
                            <div class="col-md-4 float-left">
                                <div class="card">
                                    <a href="<?php echo $arquivo2['path']; ?>"><img class="card-img-top"
                                            src="<?php echo $arquivo2['path']; ?>" alt="Card image cap"
                                            height="150"></a>
                                    <div class="card-body">
                                        <h2 style="margin-bottom:0px; margin-top:0px">
                                            <?php echo $arquivo2['id']; ?>
                                        </h2>
                                        <h5 class="card-title" style="text-align:center;">
                                            <?php echo $arquivo2['denominacao']; ?>
                                        </h5>
                                        <?php echo date("d/m/Y H:i", strtotime($arquivo2['data_upload'])); ?>
                                        <a href="ver.php?id=<?php echo $arquivo2['id']; ?>"><button
                                                style="width: 100%;">
                                                Ver
                                                mais
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!--
    ----------- Footer
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    ----------- Bootstrap core JS
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    ----------- Core theme JS
    <script src="js/scripts.js"></script>
    -->
</body>


</html>