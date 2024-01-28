<?php
/*Abre a conexão com o BD*/

    //Import do arquivo de Variaveis e Constantes
    require_once('../../modulos/config.php');

    //Import do arquivo de função para conectar no BD
    require_once('../conexaoMysql.php');

    //chama a função que vai estabelecer a conexão com o BD
    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
    }

//Variaiveis
$nome = (string) null;
$sexo = (string) null;
$dataNascimento = (string) null;
$email = (string) null;
$senha = (string) null;
$statusUsuario = (integer) 0;

//Recebe todos os dados do formulário
$nome = $_POST['txtNome'];
$sexo = $_POST['rdoSexo'];
$data = explode("/", $_POST['txtNascimento']);
$dataNascimento = $data[2] . "-" . $data[1] . "-" . $data[0];
$email = $_POST['txtEmail'];
$senha = $_POST['pswSenha'];

$sql = "insert into tblusuarios 
            (
            nome,
            sexo,
            dataNascimento,
            email,
            senha,
            statusUsuario
            )
            values
            (
                '".$nome."',
                '".$sexo."',
                '".$dataNascimento."',
                '".$email."',
                '".$senha."',
                '".$statusUsuario."'
            )
        ";

//Executa o Script SQL no BD
       
if (mysqli_query($conex, $sql))
{
    echo("
            <script>
                alert('".REGISTRO_INSERIDO_SUCESSO."');
                location.href = '../../CMS/usuarios.php';
            </script>
    ");
}
else
    echo("
            <script>
                alert('".ERRO_INSERIR_DADOS."');
                location.href = '../../CMS/usuarios.php';
                window.history.back();
            </script>
        ");    

?>
