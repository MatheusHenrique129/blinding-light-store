<?php
//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');
//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

/*Variaveis*/
$name = (string) null;
$telephone = (string)null;
$cellphone = (string) null;
$email = (string) null;
$linkFacebook = (string) null;
$sugestaoCritica = (string) null;
$message = (string) null;
$profession = (string) null;
$homePage = (string) null;
$gender = (string) null;

/*Recebe todos os dados do formulário*/
$name = $_POST['txtNome'];
$telephone = $_POST['txtTelefone'];
$cellphone = $_POST['txtCelular'];
$email = $_POST['txtEmail'];
$linkFacebook = $_POST['urlFacebook'];
$sugestaoCritica = $_POST['sltSugestao'];
$message = $_POST['txtMensagem'];
$profession = $_POST['txtProfissao'];
$homePage = $_POST['urlHomePage'];
$gender = $_POST['rdoSexo'];

session_start();

$sql = "update tblcontacts set 
            name = '" . $name . "',
            telephone = '" . $telephone . "',
            cellphone = '" . $cellphone . "',
            email = '" . $email . "',
            facebook = '" . $linkFacebook . "',
            suggestion = '" . $sugestaoCritica . "',
            message = '" . $message . "',
            profession = '" . $profession . "',
            homePage = '" . $homePage . "',
            gender = '" . $gender . "'
	    where idContact = " . $_SESSION['id'];

unset($_SESSION['id']);

//Executa no BD o Script SQL
if (mysqli_query($conex, $sql)) {
    echo ("
            <script>                
                alert('" . REGISTRO_ATUALIZADO_SUCESSO . "');
                location.href = '../../cms/index.php';
            </script>
    ");
} else
    echo ("
            <script>
                alert('" . ERRO_ATUALIZADO_DADOS . "');
                location.href = '../../cms/index.php';
                window.history.back();
            </script>
    
        ");
