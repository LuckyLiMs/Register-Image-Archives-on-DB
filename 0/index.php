<?php

include("conexao.php");

if (isset($_FILES["arquivo"])) {
    $arquivo = $_FILES["arquivo"];

    if ($arquivo["error"]) {
        die("Falha ao enviar o arquivo");
    }

    if ($arquivo["size"] > 2097152) {
        die("Arquivo muito grande. Máximo 2MB");
    }

    $pasta = "arquivos/";
    $nomeDoArquivo = $arquivo['name'];
    $denominacao = $_POST['denominacao'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg') {
        die('Tipo de arquivo inválido');
    }

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);

    if ($deu_certo) {
        $mysqli->query("INSERT INTO arquivos (nome, path, denominacao) VALUES('$nomeDoArquivo','$path','$denominacao')") or die($mysqli->error);
        echo "<p>Arquivo enviado com sucesso!</p>";

        // Para acessá-lo, clique aqui: <a target-\"_blank\" href=\"arquivos/$novoNomeDoArquivo.$extensao\">Clique Aqui

    } else {
        echo "Falha ao enviar o arquivo";
    }
}

//logo
if (isset($_FILES["logo"])) {
    $logo = $_FILES["logo"];

    if ($logo["error"]) {
        die("Falha ao enviar o arquivo");
    }

    if ($logo["size"] > 2097152) {
        die("Arquivo muito grande. Máximo 2MB");
    }

    $pasta2 = "logo/";
    $nomeDaLogo = $logo['name'];
    $novoNomeDaLogo = uniqid();
    $extensaoLogo = strtolower(pathinfo($nomeDaLogo, PATHINFO_EXTENSION));

    if ($extensaoLogo != 'jpg' && $extensaoLogo != 'png' && $extensaoLogo != 'jpeg') {
        die('Tipo de arquivo inválido');
    }

    $path2 = $pasta2 . $novoNomeDaLogo . "." . $extensaoLogo;
    $deu_certo2 = move_uploaded_file($logo['tmp_name'], $path2);

    if ($deu_certo2) {
        $mysqli->query("INSERT INTO logo (nome, path) VALUES('$nomeDaLogo','$path2')") or die($mysqli->error);
        echo "<p>Arquivo enviado com sucesso!</p>";
    } else {
        echo "Falha ao enviar o arquivo";
    }
}

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

    <style>
        h2 {
            color: aqua;
        }

        spam {
            color: aqua;
        }
    </style>
</head>

<body>
    <div class="" style="background-color:black;">
        <a class="dropdown-item" href="consulta.php">
            <spam style="color:aqua; margin-left:48%;font-weight:bold;">HOME</spam>
        </a>

        <form method="post" enctype="multipart/form-data" action="">
            <br>
            <p>
                <label for="">Selecione o arquivo</label>
                <label for="" style="color:aqua">PNG, JPG, JPEG</label>
                <input name="arquivo" type="file">

                <br>

                <label for="denominacao" class="labelInput"> Denomine seu arquivo </label>
                <input type="text" name="denominacao" id="denominacao">
            </p>
            <button style="width: 50%; margin-left:25%; color:white;" type="submit">Enviar arquivo</button>
            <hr>
        </form>

        <!--LOGO-->
        <form method="post" enctype="multipart/form-data" action="">
            <br>
            <p>
                <label for="">Selecione uma <spam>LOGO</spam></label>
                <br>
                <label for="" style="color:aqua">PNG, JPG, JPEG</label>
                <input name="logo" type="file">
            </p>
            <button style="width: 50%; margin-left:25%; color:white;" type="submit">Enviar arquivo</button>
            <hr>
        </form>
    </div>
    <br>
    <!--Estrutura de repetição-->
    <?php
    while ($arquivo = $sql_query->fetch_assoc()) {
        ?>
        <!--Cards antigos
        <div class="col-md-4 float-left">
            <div class="card text-bg-white border border-dark" style="width: 18rem; margin-left: 10%; margin-bottom: 15%">
                <img class="card-img-top" src="<?php //echo $arquivo['path']; ?>" alt="Card image cap" height="150">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php //echo $arquivo['denominacao']; ?>
                    </h5>
                    <?php //echo date("d/m/Y H:i", strtotime($arquivo['data_upload'])); ?>
                    <a href="#" class="btn btn-outline-dark" style="width: 100%;">Ver mais</a>
                </div>
            </div>
        </div>
        -->

        <!--Cards-->
        <div class="fundo" style="margin-top: 5%;">
            <div class="col-md-4 float-left">
                <div class="card">
                    <a href="<?php echo $arquivo['path']; ?>"><img class="card-img-top"
                            src="<?php echo $arquivo['path']; ?>" alt="Card image cap" height="150"></a>
                    <div class="card-body">
                        <h2 style="margin-bottom:0px; margin-top:0px">
                            <?php echo $arquivo['id']; ?>
                        </h2>
                        <h5 class="card-title" style="text-align:center;">
                            <?php echo $arquivo['denominacao']; ?>
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