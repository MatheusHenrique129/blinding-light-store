<?php 
    //Import do arquivo de Variaveis e Constantes
    require_once('../../modulos/config.php');

    //Import do arquivo de função para conectar no BD
    require_once('../conexaoMysql.php');

    //chama a função que vai estabelecer a conexão com o BD
    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
    }

/*Variaveis*/
$nome = (string) null;
$sexo = (string) null;
$dataNascimento = (string)null;
$email = (string) null;
$senha = (string) null;

/*Recebe todos os dados do formulário*/
$nome = $_POST['txtNome'];
$email = $_POST['txtEmail'];
$data = explode("/", $_POST['txtNascimento']);
$dataNascimento = $data[2] . "-" . $data[1] . "-" . $data[0];
$sexo = $_POST['rdoSexo'];

session_start();

$sql = "update tblusuarios set 
        nome = '".$nome."',
        sexo = '".$sexo."',
        dataNascimento = '".$dataNascimento."',
        email = '".$email."'
       
	    where idUsuario = " . $_SESSION['id'];

unset($_SESSION['id']);

//Executa no BD o Script SQL
if (mysqli_query($conex, $sql))
{
    echo("
            <script>                
                alert('".REGISTRO_ATUALIZADO_SUCESSO."');
                location.href = '../../CMS/usuarios.php';
            </script>
    ");
}
else
    echo("
            <script>
                alert('".ERRO_ATUALIZADO_DADOS."');
                location.href = '../../CMS/usuarios.php';
                window.history.back();
            </script>    
        ");

?>