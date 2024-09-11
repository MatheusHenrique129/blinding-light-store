<?php
/*Abre a conexão com o BD*/

//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

//Variaiveis
$nome = (string) null;
$telefone = (string) null;
$celular = (string) null;
$email = (string) null;
$linkFacebook = (string) null;
$sugestaoCritica = (string) null;
$mensagem = (string) null;
$profissao = (string) null;
$homePage = (string) null;
$sexo = (string) null;
$statusContato = (int) 0;

//Recebe todos os dados do formulário
$nome = $_POST['txtNome'];
$telefone = $_POST['txtTelefone'];
$celular = $_POST['txtCelular'];
$email = $_POST['txtEmail'];
$linkFacebook = $_POST['urlFacebook'];
$sugestaoCritica = $_POST['sltSugestao'];
$mensagem = $_POST['txtMensagem'];
$profissao = $_POST['txtProfissao'];
$homePage = $_POST['urlHomePage'];
$sexo = $_POST['rdoSexo'];

$sql = "insert into tblcontatos 
            (
                nome,
                telefone,
                celular,
                email,
                facebook,
                sugestaoCritica,
                mensagem,
                profissao,
                homePage,
                sexo,
                statusContato
            )
            values
            (
                '" . $nome . "',
                '" . $telefone . "',
                '" . $celular . "',
                '" . $email . "',
                '" . $linkFacebook . "',
                '" . $sugestaoCritica . "',
                '" . $mensagem . "',
                '" . $profissao . "',
                '" . $homePage . "',
                '" . $sexo . "',
                '" . $statusContato . "'
            )
        ";

//Executa o Script SQL no BD

if (mysqli_query($conex, $sql)) {
    echo ("
            <script>
                alert('" . REGISTRO_INSERIDO_SUCESSO . "');
                location.href = '../../cms/index.php';
            </script>
    ");
} else
    echo ("
            <script>
                alert('" . ERRO_INSERIR_DADOS . "');
                location.href = '../../cms/index.php';
                window.history.back();
            </script>
        ")
