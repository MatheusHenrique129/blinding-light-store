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
    
    $id = $_POST['idContato'];

    $sql = "select * from tblcontatos where idContato = ".$id;

    $select = mysqli_query($conex, $sql);
    
    if ($rsContatos = mysqli_fetch_assoc($select))
    {
        $nome = $rsContatos['nome'];
        $telefone = $rsContatos['telefone'];
        $celular = $rsContatos['celular'];
        $email = $rsContatos['email'];
        $linkFacebook = $rsContatos['facebook'];
//        $sugestaoCritica = $rsContatos['critica'];   
        $mensagem = $rsContatos['mensagem'];
        $profissao = $rsContatos['profissao'];
        $homePage = $rsContatos['homePage'];
        $sexo = $rsContatos['sexo'];

        if(strtoupper($sexo) == "M")
            $chkMan = "checked";
        elseif(strtoupper($sexo) == "F")
            $chkGirl = "checked";
 
    }

?>

<html>

<head>
    <title>Visualizar Contato</title>
    <link rel="stylesheet" type="text/css" href="../../CMS/CSS/style.css">
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
                    <?=$nome?>
                </td>
            </tr>
            <tr>
                <td>
                    Telefone:
                </td>
                <td>
                    <?=$telefone?>
                </td>
            </tr>
            <tr>
                <td>
                    Celular:
                </td>
                <td>
                    <?=$celular?>
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <?=$email?>
                </td>
            </tr>
            <tr>
                <td>
                    Link Facebook:
                </td>
                <td>
                    <?=$linkFacebook?>
                </td>
            </tr>
            <tr>
                <td>
                    Sugestão ou Critica:
                </td>
                <td>
                    <?=$sugestaoCritica?>
                </td>
            </tr>
            <tr>
                <td>
                    Mensagem:
                </td>
                <td>
                    <?=$mensagem?>
                </td>
            </tr>
            <tr>
                <td>
                    Profissão
                </td>
                <td>
                    <?=$profissao?>
                </td>
            </tr>
            <tr>
                <td>
                    HomePage:
                </td>
                <td>
                    <?=$homePage?>
                </td>
            </tr>
            <tr>
                <td>
                    Sexo:
                </td>
                <td>
                    <?=$sexo?>
                </td>
            </tr>


        </table>
    </div>

</body>

</html>
