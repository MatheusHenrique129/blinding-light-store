<?php
//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

$id = $_POST['idUsuario'];

$sql = "select * from tblusuarios where idUsuario = " . $id;

$select = mysqli_query($conex, $sql);

if ($rsUsuarios = mysqli_fetch_assoc($select)) {
    $nome = $rsUsuarios['nome'];
    $email = $rsUsuarios['email'];
    $dataNascimento = explode("-", $rsUsuarios['dataNascimento']);
    $dataNasc = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];
    $sexo = $rsUsuarios['sexo'];

    if (strtoupper($sexo) == "F")
        $Feminino = "checked";
    elseif (strtoupper($sexo) == "M")
        $Masculino = "checked";
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
                    Sexo:
                </td>
                <td>
                    <?= $sexo ?>
                </td>
            </tr>
            <tr>
                <td>
                    Data de Nascimento:
                </td>
                <td>
                    <?= $dataNasc ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <?= $email ?>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>