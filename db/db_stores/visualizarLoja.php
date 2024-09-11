<?php
//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

$id = $_POST['idStore'];

$sql = "select * from tblstores where idStore = " . $id;

$select = mysqli_query($conex, $sql);

if ($rsStores = mysqli_fetch_assoc($select)) {
    $nome = $rsStores['nome'];
    $celular = $rsStores['celular'];
    $endereco = $rsStores['endereco'];
}

?>

<html>

<head>
    <title>Visualizar Contato</title>
    <link rel="stylesheet" type="text/css" href="../../cms/css/style.css">
    <script>
        $(document).ready(function() {
            $(".fecharModal").click(function() {
                $(".modalContainer").fadeOut();
            });
        });
    </script>
</head>

<body>
    <div class="fecharModal">
        Fechar
    </div>
    <div class="visualizarContatos">
        <table class="visualizarContato">
            <tr>
                <td>
                    Nome:
                </td>
                <td>
                    <?= $nome ?>
                </td>
            </tr>
            <tr>
                <td>
                    Celular:
                </td>
                <td>
                    <?= $celular ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <?= $endereco ?>
                </td>
            </tr>
            <tr>
                <td>
                    Foto:
                </td>
                <td>
                    <img src="../arquivos/<?= $rsStores['foto'] ?>" class="fotoVisualizar">
                </td>
            </tr>
        </table>
    </div>

</body>

</html>