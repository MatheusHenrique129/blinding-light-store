<?php
//Import do arquivo de Variaveis e Constantes
require_once('../../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../mysql_connection.php');

//Importe do aquivo de função para atualizar imagem
require_once('upload.php');

//chama a função que vai estabelecer a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
}

/*Variaveis*/
$nome = (string) null;
$celular = (string) null;
$endereco = (string) null;
$foto = (string) "no-image.jpg";


/*Recebe todos os dados do formulário*/
$nome = strtoupper($_POST['txtNome']);
$celular = $_POST['txtCelular'];
$endereco = $_POST['txtEndereco'];
$foto = uploadImage($_FILES['fleFoto']);

session_start();

$sql = "update tblstores set 
        nome = '" . $nome . "',
        celular = '" . $celular . "',
        endereco = '" . $endereco . "',      
        foto = '" . $foto . "'      
       
	    where idStore = " . $_SESSION['id'];

unset($_SESSION['id']);

//echo($sql);

//Executa no BD o Script SQL
if (mysqli_query($conex, $sql)) {
    echo ("
            <script>                
                alert('" . REGISTRO_ATUALIZADO_SUCESSO . "');
                location.href = '../../cms/nossasLojas.php';
            </script>
    ");
} else
    echo ("
            <script>
                alert('" . ERRO_ATUALIZADO_DADOS . "');
                location.href = '../../cms/nossasLojas.php';
                window.history.back();
            </script>
    
        ");
