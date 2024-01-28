<?php
$action = "../DataBase/bd_Usuario/inserirUsuario.php";

//Import do arquivo de Variaveis e Constantes
require_once('../modulos/config.php');

//Import do arquivo de função para conectar no BD
require_once('../DataBase/conexaoMysql.php');

//Chama a função que estabelece a conexão com o BD
if(!$conex = conexaoMysql())
{ 
    echo("<script> alert('".ERRO_CONEX_BD_MYSQL."') </script>");
}

    if(isset($_GET['modo']))
    {
        if(strtoupper($_GET['modo']) == "CONSULTAR")
        {
            if(isset($_GET['id']) && $_GET['id'] !="")
            {
                $id = $_GET['id'];

                session_start();

                $_SESSION['id'] = $id;

                $sql = "select * from tblusuarios where idUsuario = ".$id;                 
                
                    $select = mysqli_query($conex, $sql);

                if($rsUsuarios = mysqli_fetch_assoc($select))
                {
                    $nome = $rsUsuarios['nome'];
                    $email = $rsUsuarios['email'];
                    $senha = $rsUsuarios['senha'];
                    $dataNascimento = explode("-",$rsUsuarios['dataNascimento']);
                    $dataNasc = $dataNascimento[2]."/".$dataNascimento[1]."/".$dataNascimento[0];                                
                    $sexo = $rsUsuarios['sexo'];
                    
                    if(strtoupper($sexo) == "F")
                        $Feminino = "checked";
                    elseif(strtoupper($sexo) == "M")
                        $Masculino = "checked";

                    $action = "../DataBase/bd_Usuario/atualizarUsuario.php";    
                }
            }
        }        
    }
     
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS do Site</title>

    <link rel="icon" href="imagens/Logo.png">

    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $(".pesquisar").click(function() {
                $(".modalContainer").fadeIn(3000);
            });
        });

        function visualizarUsuario(id) {
            $.ajax({
                type: "POST",
                url: "../DataBase/bd_Usuario/visualizarUsuario.php",
                data: {idUsuario: id},
                success: function(dados) {
                    $(".modal").html(dados);
                }
            });
        }
    </script>

</head>

<body>
    <!--SEÇÃO MODAL-->
    <div class="modalContainer">
        <div class="modal">

        </div>
    </div>
    <div id="container" class="centerObject">
        <header id="header">
            <div id="container-logo">
                <div id="CMS-text">
                    <h1>CMS</h1>
                    <p>- Sistema de Gerenciamento do Site</p>
                </div>

                <div id="logo">
                    <img src="imagens/Logo.png">
                </div>

            </div>

            <!--SEÇÃO MENU-->
            <nav id=" container-menu">

                <!--SEÇÃO CARDS MENU-->
                <div id="container-cards-menu">

                    <div class="capsula-cards">
                        <a href="#">
                            <div class="imagem-cards-menu">
                                <img src="icone/conteudo.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Conteúdo</p>
                            </div>
                        </a>
                    </div>

                    <div class="capsula-cards" id="abaFale_conosco">
                        <a href="index.php">
                            <div class="imagem-cards-menu">
                                <img src="icone/icon_fale-conosco.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Fale Conosco</p>
                            </div>
                        </a>
                    </div>


                    <div class="capsula-cards">
                        <a href="nossasLojas.php">
                            <div class="imagem-cards-menu">
                                <img src="icone/protudos.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Produtos</p>
                            </div>
                        </a>
                    </div>


                    <div class="capsula-cards">
                        <a href="usuarios.php">
                            <div class="imagem-cards-menu">
                                <img src="icone/usuario.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Usuários</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!--SEÇÃO BOAS VINDAS-->
                <div id="container-logout">
                    <div id="bem-vindo">
                        <p>Bem-vindo(a), {xxxxxx}.</p>
                    </div>
                    <div id="logout">
                        <p>Logout</p>
                    </div>
                </div>
            </nav>
        </header>

        <!--SEÇÃO CONTEUDO-->
        <section id="conteudo">
            <div id="cadastroUsuarios" class="centerObject">
                <div id="cadastroTitulo">
                    <h1>Cadastros de Usuarios</h1>
                </div>
                <div id="cadastroInformacoes">
                    <form action="<?=$action?>" name="frmUsuarios" method="post">


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Nome: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" value="<?=@$nome?>" placeholder="Digite seu nome*" required pattern="[a-z A-Z é]*">
                            </div>
                        </div>
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                Sexo:
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="radio" required name="rdoSexo" value="F" <?=@$Feminino?>>Feminino.
                                <input type="radio" required name="rdoSexo" value="M" <?=@$Masculino?>>Masculino.
                            </div>
                        </div>
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Data de Nascimento: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNascimento" required value="<?=@$dataNasc?>" placeholder="day/month/year*">
                            </div>
                        </div>
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Email: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="email" name="txtEmail" required value="<?=@$email?>" placeholder="Digite seu E-mail*">
                            </div>
                        </div>

                        <?php
                           if(isset($_GET['modo']) && strtoupper($_GET['modo'])=="CONSULTAR")
                           {
                        ?>
                        <?php
                           }
                           else
                           {
                        ?>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Senha: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="password" required name="pswSenha" value="<?=@$senha?>" placeholder="Senha*">
                            </div>
                        </div>

                        <?php
                           }
                        ?>


                        <div id="formEnviar">
                            <div class="enviarUsuarios">
                                <?php
                                       if(isset($_GET['modo']) && strtoupper($_GET['modo'])=="CONSULTAR")
                                       {
                                    ?>
                                <input type="submit" name="btnEnviar" value="Atualizar">
                                <?php
                                       }
                                       else
                                       {
                                    ?>
                                <input type="submit" name="btnEnviar" value="Salvar">
                                <?php
                                       }
                                    ?>


                            </div>
                        </div>

                    </form>

                </div>
            </div>




            <div id="consultaDeDados" class="centerObject">
                <table id="tblConsulta">
                    <tr>
                        <td id="tblTitulo" colspan="5">
                            <h1> Consulta de Usuários.</h1>
                        </td>
                    </tr>
                    <tr id="tblLinhas">
                        <td class="tblColunas">Nome</td>
                        <td class="tblColunas">Email</td>
                        <td class="tblColunas">Sexo</td>
                        <td class="tblColunas">Data de Nascimento</td>
                        <td class="tblColunas">Opções</td>
                    </tr>

                    <?php
    
                        $sql = "select * from tblusuarios order by tblusuarios.idUsuario desc;";
    
//                        $sql = " select tblcontatos.idContato, tblcontatos.nome, tblcontatos.celular, tblcontatos.email, tblcontatos.profissao, tblcontatos.statusContato"
                    
                        $select = mysqli_query($conex, $sql);
                          
                        while($rsUsuarios = mysqli_fetch_assoc($select))
                        {                    
                    ?>
                    <tr id="tblLinhas">
                        <td class="tblColunas"><?=@$rsUsuarios['nome']?></td>
                        <td class="tblColunas"><?=@$rsUsuarios['email']?></td>
                        <td class="tblColunas"><?=@$rsUsuarios['sexo']?></td>
                        <td class="tblColunas"><?=@$rsUsuarios['dataNascimento']?></td>
                        <td class="tblColunas">
                            <div class="cardsImagens">
                                <a href="../DataBase/bd_Usuario/excluirUsuario.php?modo=excluir&id=<?=$rsUsuarios['idUsuario']?>" onclick="return confirm('Deseja realmente excluir esse Registro?')">
                                    <img src="icone/delete.png" alt="Excluir" title="Excluir" class="excluir">
                                </a>
                            </div>
                            <div class="cardsImagens">
                                <a href="usuarios.php?modo=consultar&id=<?=$rsUsuarios['idUsuario']?>">
                                    <img src="icone/edit.png" alt="Editar" title="Editar" class="editar">
                                </a>
                            </div>
                            <div class="cardsImagens">
                                <img src="icone/visualizar.png" alt="modal" title="Pesquisar" class="pesquisar" onclick="visualizarUsuario(<?=$rsUsuarios['idUsuario']?>);">
                            </div>
                            <div class="cardsImagens">
                                <a href="../DataBase/bd_Usuario/ativarDesativarUsuario.php?modo=status&id=<?=$rsUsuarios['idUsuario']?>&status=<?=$rsUsuarios['statusUsuario']?>">
                                    <img src="icone/<?=$rsUsuarios['statusUsuario']?>.png" alt="Status" title="Status" class="editar">
                                </a>
                            </div>
                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                </table>
            </div>



        </section>

        <footer id="footer">
            <p>Desenvolvido por: Matheus Henrique Santos Da Silva</p>
        </footer>
    </div>
</body>

</html>
