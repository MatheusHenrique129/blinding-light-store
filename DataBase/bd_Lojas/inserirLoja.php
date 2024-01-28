<?php
/*Abre a conexão com o BD*/

    //Import do arquivo de Variaveis e Constantes
    require_once('../../modulos/config.php');

    //Import do arquivo de função para conectar no BD
    require_once('../conexaoMysql.php');

    //Import do arquivo que realiza o upload de uma Foto
    require_once('upload.php');

    //chama a função que vai estabelecer a conexão com o BD
    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
    }

//Variaiveis
$nome = (string) null;
$celular = (string) null;
$endereco = (string) null;
$foto = (string) "semFoto.jpg";
$statusLoja = (integer) 0;

//Recebe todos os dados do formulário
$nome = strtoupper($_POST['txtNome']);
$celular = $_POST['txtCelular'];
$endereco = $_POST['txtEndereco'];
$foto = uploadFoto($_FILES['fleFoto']);

$sql = "insert into tblnossasLojas
            (
            nome,
            celular,
            endereco,
            foto,
            statusLoja
            )
            values
            (
                '".$nome."',
                '".$celular."',
                '".$endereco."',
                '".$foto."',
                '".$statusLoja."'
            )
        ";

//Executa o Script SQL no BD
       
if (mysqli_query($conex, $sql))
{
    echo("
            <script>
                alert('".REGISTRO_INSERIDO_SUCESSO."');
                location.href = '../../CMS/nossasLojas.php';
            </script>
    ");
}
else
    echo("
            <script>
                alert('".ERRO_INSERIR_DADOS."');
                location.href = '../../CMS/nossasLojas.php';
                window.history.back();
            </script>
        ")
?>
