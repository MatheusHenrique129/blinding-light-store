<?php
/*Abre a conexão com o BD*/

//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//Import do arquivo que realiza o upload de uma Foto
require_once('upload.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

//Variaiveis
$name = (string) null;
$celular = (string) null;
$endereco = (string) null;
$foto = (string) "no-image.jpg";
$statusLoja = (int) 0;

//Recebe todos os dados do formulário
$name = strtoupper($_POST['txtNome']);
$celular = $_POST['txtCelular'];
$endereco = $_POST['txtEndereco'];
$foto = uploadFoto($_FILES['fleFoto']);

$sql = "insert into tblstores
            (
            name,
            celular,
            endereco,
            foto,
            statusLoja
            )
            values
            (
                '" . $name . "',
                '" . $celular . "',
                '" . $endereco . "',
                '" . $foto . "',
                '" . $statusLoja . "'
            )
        ";

//Executa o Script SQL no BD

if (mysqli_query($conex, $sql)) {
    echo ("
            <script>
                alert('" . REGISTRO_INSERIDO_SUCESSO . "');
                location.href = '../../cms/nossasLojas.php';
            </script>
    ");
} else
    echo ("
            <script>
                alert('" . ERRO_INSERIR_DADOS . "');
                location.href = '../../cms/nossasLojas.php';
                window.history.back();
            </script>
        ")
