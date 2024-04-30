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
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'png') {
        die('Tipo de arquivo inválido');
    }

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);

    if ($deu_certo) {
        $mysqli->query("INSERT INTO arquivos (nome, path) VALUES('$nomeDoArquivo','$path')") or die($mysqli->error);
        echo "<p>Arquivo enviado com sucesso!</p>";

        // Para acessá-lo, clique aqui: <a target-\"_blank\" href=\"arquivos/$novoNomeDoArquivo.$extensao\">Clique Aqui

    } else {
        echo "Falha ao enviar o arquivo";
    }
}

$sql_query = $mysqli->query("SELECT * FROM arquivos") or die($mysqli->error);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data" action="">
        <p>
            <label for="">Selecione o arquivo</label>
            <input name="arquivo" type="file">
        </p>
        <button type="submit">Enviar arquivo</button>
    </form>

    <h1>Lista de arquivos</h1>
    <table border="1" cellpadding="10">
        <thead>
            <th>Preview</th>
            <th>Arquivo</th>
            <th>Data de Envio</th>
        </thead>
        <tbody>
            <?php
            while ($arquivo = $sql_query->fetch_assoc()) {
                ?>
                <tr>
                    <td><img height="50" src="<?php echo $arquivo['path']; ?>" alt=""></td>
                    <td>
                        <?php echo $arquivo['nome']; ?>
                    </td>
                    <td>
                        <?php echo date("d/m/Y H:i", strtotime($arquivo['data_upload'])); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>