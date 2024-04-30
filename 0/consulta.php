<?php

include("conexao.php");

$sql_query = $mysqli->query("SELECT * FROM logo") or die($mysqli->error);
$logo = $sql_query->fetch_assoc();

$sql_query = $mysqli->query("SELECT * FROM arquivos") or die($mysqli->error);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
</head>

<body>
    <!--inclui o header-->
    <?php include 'header.php'; ?>

    <!--Estrutura de repetição-->
    <?php
    while ($arquivo = $sql_query->fetch_assoc()) {
        ?>
        <!--Cards-->
        <div class="fundo" style="margin-top: 5%;">
            <div class="col-md-4 float-left">
                <div class="card">
                    <a href="<?php echo $arquivo['path']; ?>"><img class="card-img-top"
                            src="<?php echo $arquivo['path']; ?>" alt="Card image cap" height="150"></a>
                    <div class="card-body">
                        <h2 style="margin-bottom:0px; margin-top:0px; color:aqua">
                            <?php echo $arquivo['id'];?>
                        </h2>
                        <h5 class="card-title" style="text-align:center;">
                            <?php echo $arquivo['denominacao'];?>
                        </h5>
                        <?php echo date("d/m/Y H:i", strtotime($arquivo['data_upload'])); ?>
                        <a href="ver.php?id=<?php echo $arquivo['id']; ?>"><button style="width: 100%;"> Ver mais
                            </button></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</body>

</html>