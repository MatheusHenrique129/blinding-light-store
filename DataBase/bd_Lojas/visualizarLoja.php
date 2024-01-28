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
    
    $id = $_POST['idLojas'];

    $sql = "select * from tblnossaslojas where idLojas = ".$id;

    $select = mysqli_query($conex, $sql);
    
    if ($rsLojas = mysqli_fetch_assoc($select))
    {
        $nome = $rsLojas['nome'];
        $celular = $rsLojas['celular'];
        $endereco = $rsLojas['endereco'];
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
                    <?=$endereco?>
                </td>
            </tr>
            <tr>
                <td>
                    Foto:
                </td>
                <td>
                    <img src="../arquivos/<?=$rsLojas['foto']?>" class="fotoVisualizar">
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
