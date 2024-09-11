<?php
$action = "../db/bd_contact/inserirContato.php";

//Import do arquivo de Variaveis e Constantes
require_once('../modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('../db/mysql_connection.php');

//Chama a função que estabelece a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "') </script>");
}

if (isset($_GET['modo'])) {
    if (strtoupper($_GET['modo']) == "CONSULTAR") {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = $_GET['id'];

            session_start();

            $_SESSION['id'] = $id;

            $sql = "select * from tblcontacts where idContact = " . $id;

            $select = mysqli_query($conex, $sql);

            if ($rsContacts = mysqli_fetch_assoc($select)) {
                $nome = $rsContacts['name'];
                $telefone = $rsContacts['telephone'];
                $celular = $rsContacts['cellphone'];
                $email = $rsContacts['email'];
                $linkFacebook = $rsContacts['facebook'];
                $sugestaoCritica = $rsContacts['suggestion'];
                $message = $rsContacts['message'];
                $profession = $rsContacts['profession'];
                $homePage = $rsContacts['homePage'];
                $gender = $rsContacts['gender'];

                if (strtoupper($gender) == "M")
                    $chkMan = "checked";
                elseif (strtoupper($gender) == "F")
                    $chkGirl = "checked";

                $action = "../db/db_contact/updateContact.php";
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
    <title>CMS - Blinding Light Store</title>

    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $(".pesquisar").click(function() {
                $(".modalContainer").fadeIn(3000);
            });
        });

        function visualizarContato(id) {
            $.ajax({
                type: "POST",
                url: "../db/db_contact/viewContact.php",
                data: {
                    idContact: id
                },
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
                    <p>- Sistema de Gerenciamento - Blinding Light Store</p>
                </div>

                <div id="logo">
                    <img src="images/logo.png">
                </div>
            </div>

            <!--SEÇÃO MENU-->
            <nav id=" container-menu">
                <!--SEÇÃO CARDS MENU-->
                <div id="container-cards-menu">

                    <div class="capsula-cards">
                        <a href="#">
                            <div class="imagem-cards-menu">
                                <img src="icons/content.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Conteúdo</p>
                            </div>
                        </a>
                    </div>

                    <div class="capsula-cards">
                        <a href="index.php">
                            <div class="imagem-cards-menu">
                                <img src="icons/talk-to-us.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Fale Conosco</p>
                            </div>
                        </a>
                    </div>


                    <div class="capsula-cards">
                        <a href="nossasLojas.php">
                            <div class="imagem-cards-menu">
                                <img src="icons/product.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Produtos</p>
                            </div>
                        </a>
                    </div>


                    <div class="capsula-cards">
                        <a href="user.php">
                            <div class="imagem-cards-menu">
                                <img src="icons/user.png">
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
            <!--Seção Fale Conosco-->
            <div id="aba_contatos">
                <div id="cadastro" class="centerObject">
                    <div id="cadastroTitulo">
                        <h1>Cadastro de Contatos</h1>
                    </div>
                    <div id="cadastroInformacoes">

                        <form action="<?= $action ?>" name="frmCadastro" method="post">

                            <div class="arrumaLayoutContatos">

                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Nome: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="text" name="txtNome" value="<?= @$nome ?>" placeholder="Digite seu Nome" required pattern="[a-z A-Z é]*">
                                    </div>
                                </div>
                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Telefone: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="tel" name="txtTelefone" value="<?= @$telefone ?>" pattern="[(][0-9]{2}[)][0-9]{4}-[0-9]{4}" placeholder="(44)4444-4444">
                                    </div>
                                </div>
                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Celular: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="tel" name="txtCelular" value="<?= @$celular ?>" pattern="[(][0-9]{2}[)][0-9]{5}-[0-9]{4}" placeholder="(99)99999-9999">
                                    </div>
                                </div>
                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Email: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="email" name="txtEmail" value="<?= @$email ?>" placeholder="Digite seu E-mail">
                                    </div>
                                </div>
                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Link do Facebook: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input name="urlFacebook" type="url" value="<?= @$linkFacebook ?>" placeholder="Link do Facebook caso possua">
                                    </div>
                                </div>

                            </div>

                            <div class="arrumaLayoutContatos">

                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Home Page: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input name="urlHomePage" type="url" placeholder="página pessoal caso possua" value="<?= @$homePage ?>">
                                    </div>
                                </div>

                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Profissão: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="text" name="txtProfissao" value="<?= @$profession ?>" placeholder="Digite sua Profissão" required pattern="[a-z A-Z é]*">
                                    </div>
                                </div>

                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Sexo: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="radio" name="rdoSexo" required value="F" <?= @$chkGirl ?>>Feminino.
                                        <input type="radio" name="rdoSexo" value="M" <?= @$chkMan ?>>Masculino.
                                    </div>
                                </div>
                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Sugestões e Criticas: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <select name="sltSugestao">
                                            <option value="">Selecione uma opção</option>
                                            <option value="C">Critica</option>
                                            <option value="S">Sugestão</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="campos">
                                    <div class="cadastroInformacoesPessoais">
                                        <p> Mensagem: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <textarea name="txtMensagem" cols="50" rows="7" required placeholder="Mensagem..."><?= @$message ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div id="formEnviar">
                                <div class="enviar">
                                    <?php
                                    if (isset($_GET['modo']) && strtoupper($_GET['modo']) == "CONSULTAR") {
                                    ?>
                                        <input type="submit" name="btnEnviar" value="Atualizar">
                                    <?php
                                    } else {
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
                                <h1> Consulta de Dados.</h1>
                            </td>
                        </tr>
                        <tr id="tblLinhas">
                            <td class="tblColunas">Nome </td>
                            <td class="tblColunas">Celular </td>
                            <td class="tblColunas">Profissão </td>
                            <td class="tblColunas">Email </td>
                            <td class="tblColunas">Opções </td>
                        </tr>

                        <?php

                        $sql = "select * from tblcontacts order by tblcontacts.idContact desc";
                        //$sql = " select tblcontatos.idContact, tblcontatos.nome, tblcontatos.celular, tblcontatos.email, tblcontatos.profissao, tblcontatos.statusContato"
                        $select = mysqli_query($conex, $sql);

                        while ($rsContacts = mysqli_fetch_assoc($select)) {
                        ?>
                            <tr id="tblLinhas">
                                <td class="tblColunas"><?= @$rsContacts['name'] ?></td>
                                <td class="tblColunas"><?= @$rsContacts['celular'] ?></td>
                                <td class="tblColunas"><?= @$rsContacts['profissao'] ?></td>
                                <td class="tblColunas"><?= @$rsContacts['email'] ?></td>
                                <td class="tblColunas">
                                    <div class="cardsImagens">
                                        <a href="../db/bd_Contato/excluirContato.php?modo=excluir&id=<?= $rsContacts['idContact'] ?>" onclick="return confirm('Deseja realmente excluir esse Registro?')">
                                            <img src="icons/delete.png" alt="Excluir" title="Excluir" class="excluir">
                                        </a>
                                    </div>
                                    <div class="cardsImagens">
                                        <a href="index.php?modo=consultar&id=<?= $rsContacts['idContact'] ?>">
                                            <img src="icons/edit.png" alt="Editar" title="Editar" class="editar">
                                        </a>
                                    </div>
                                    <div class="cardsImagens">
                                        <img src="icons/view.png" alt="modal" title="Pesquisar" class="pesquisar" onclick="visualizarContato(<?= $rsContacts['idContact'] ?>);">
                                    </div>
                                    <div class="cardsImagens">
                                        <a href="../db/db_contact/ativarDesativarContato.php?modo=status&id=<?= $rsContacts['idContact'] ?>&status=<?= $rsContacts['statusContact'] ?>">
                                            <img src="icons/<?= $rsContacts['statusContact'] ?>.png" alt="Status" title="Status" class="editar">
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </table>
                </div>

            </div>
            <!-- Seção Usuarios -->

            <div id="abaUsuarios">


            </div>

        </section>

        <footer id="footer">
            <p>Desenvolvido por: Matheus Henrique Santos Da Silva</p>
        </footer>
    </div>
</body>

</html>