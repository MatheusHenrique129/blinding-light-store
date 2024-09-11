<?php
//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

$id = $_POST['idContato'];

$sql = "select * from tblcontatos where idContato = " . $id;

$select = mysqli_query($conex, $sql);

if ($rsContacts = mysqli_fetch_assoc($select)) {
    $nome = $rsContacts['nome'];
    $telefone = $rsContacts['telefone'];
    $celular = $rsContacts['celular'];
    $email = $rsContacts['email'];
    $linkFacebook = $rsContacts['facebook'];
    //        $sugestaoCritica = $rsContacts['critica'];   
    $mensagem = $rsContacts['mensagem'];
    $profissao = $rsContacts['profissao'];
    $homePage = $rsContacts['homePage'];
    $sexo = $rsContacts['sexo'];

    if (strtoupper($sexo) == "M")
        $chkMan = "checked";
    elseif (strtoupper($sexo) == "F")
        $chkGirl = "checked";
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
                    Telefone:
                </td>
                <td>
                    <?= $telefone ?>
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
                    <?= $email ?>
                </td>
            </tr>
            <tr>
                <td>
                    Link Facebook:
                </td>
                <td>
                    <?= $linkFacebook ?>
                </td>
            </tr>
            <tr>
                <td>
                    Sugestão ou Critica:
                </td>
                <td>
                    <?= $sugestaoCritica ?>
                </td>
            </tr>
            <tr>
                <td>
                    Mensagem:
                </td>
                <td>
                    <?= $mensagem ?>
                </td>
            </tr>
            <tr>
                <td>
                    Profissão
                </td>
                <td>
                    <?= $profissao ?>
                </td>
            </tr>
            <tr>
                <td>
                    HomePage:
                </td>
                <td>
                    <?= $homePage ?>
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


        </table>
    </div>

</body>

</html>