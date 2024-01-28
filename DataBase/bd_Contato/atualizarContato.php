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
$telefone = (string)null;
$celular = (string) null;
$email = (string) null;
$linkFacebook = (string) null;
$sugestaoCritica = (string) null;
$mensagem = (string) null;
$profissao = (string) null;
$homePage = (string) null;
$sexo = (string) null;


/*Recebe todos os dados do formulário*/
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

session_start();

$sql = "update tblcontatos set 
        nome = '".$nome."',
        telefone = '".$telefone."',
        celular = '".$celular."',
        email = '".$email."',
        facebook = '".$linkFacebook."',
        sugestaoCritica = '".$sugestaoCritica."',
        mensagem = '".$mensagem."',
        profissao = '".$profissao."',
        homePage = '".$homePage."',
        sexo = '".$sexo."'
       
	    where idContato = " . $_SESSION['id'];

unset($_SESSION['id']);

//Executa no BD o Script SQL
if (mysqli_query($conex, $sql))
{
    echo("
            <script>                
                alert('".REGISTRO_ATUALIZADO_SUCESSO."');
                location.href = '../../CMS/index.php';
            </script>
    ");
}
else
    echo("
            <script>
                alert('".ERRO_ATUALIZADO_DADOS."');
                location.href = '../../CMS/index.php';
                window.history.back();
            </script>
    
        ");

?>