<?php
$action = "DataBase/bd_Contato/inserirContato.php";

//Import do arquivo de Variaveis e Constantes
require_once('modulos/config.php');

//Import do arquivo de função para conectar no BD
require_once('DataBase/conexaoMysql.php');

//Chama a função que estabelece a conexão com o BD
if(!$conex = conexaoMysql())
{ 
    echo("<script> alert('".ERRO_CONEX_BD_MYSQL."') </script>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLINDING LIGHT - Melhores Roupas Do Brasil</title>
    <link rel="icon" href="icons/icone%20View.png">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="Js/mascaraCelular.js"></script>
    <script src="js/mascaraTelefone.js"></script>
</head>

<body>
    <!-- SEÇÃO DO CABEÇALHO E DO MENU -->
    <div id="header">
        <div class="conteudo centerObject">
            <div id="logo">

            </div>
            <nav id="menuContainer" class="scroll">
                <ul id="menu">
                    <li><a href="#containerSlide" class="menuItens">HOME</a></li>
                    <li><a href="#sobreEmpresa" class="menuItens">EMPRESA</a></li>
                    <li><a href="#lojas" class="menuItens">LOJA</a></li>
                    <li><a href="#contatos" class="menuItens">CONTATO</a></li>
                </ul>
            </nav>
            <div id="btnLogin">
                <form name="frmMenu" method="post" action="index.html">
                    <div class="containerLogin">
                        <label>Usuário</label>
                        <input type="email" name="menuEmail" required placeholder="Digite seu Email" class="estiloLogin" value="">
                    </div>
                    <div class="containerLogin">
                        <label>Senha</label>
                        <input type="password" name="pwdSenha" required placeholder="Digite sua senha" class="estiloLogin" value="">
                    </div>

                    <input type="submit" name="subLogar" id="botaoLogin" value="Entrar">

                </form>
            </div>
        </div>
    </div>

    <!--SEÇÃO SOCIAL ICONES-->
    <div id="containerLogo">
        <div id="socialIcons">
            <a href="#">
                <img src="imagens/facebook.png" alt="facebook" class="imageRedeSocial">
            </a>
            <a href="#">
                <img src="imagens/instagram.png" alt="instagram" class="imageRedeSocial">
            </a>
            <a href="#">
                <img src="imagens/wa.png" alt="whatsapp" class="imageRedeSocial">
            </a>
        </div>
    </div>


    <!--SEÇÃO SLIDESHOW-->
    <section id="containerSlide" class="centerObject">
        <div id="slideShow" class="sombra">
            <div class="actionButton" id="previous">&laquo;</div>
            <div id="containerItems"></div>
            <div class="actionButton" id="next">&raquo;</div>
        </div>
    </section>

    <!--SEÇÃO PRODUTOS-->
    <div id="produtos" class="centerObject sombra">
        <div class="conteudo">
            <nav id="menuSecundario">
                <?php 
                    
                    $sql = "select tblcategoria.* from tblcategoria where tblcategoria.statusCategoria = 1";
                
                    $select = mysqli_query($conex, $sql);
                
                    while($rsCategoria = mysqli_fetch_assoc($sellect)){                
                ?>

                <div class="itemCheckbox">
                    <input type="checkbox" id="check1">
                    <label for="check1">Categoria</label>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Sobre</a></li>
                        <li><a href="">Sobre</a></li>
                        <li><a href="">Sobre</a></li>
                        <li><a href="">Sobre</a></li>
                    </ul>
                </div>
                <div class="itemCheckbox">
                    <input type="checkbox" id="check2">
                    <label for="check2">Menu</label>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Sobre</a></li>

                    </ul>
                </div>

                <?php 
                    }
                ?>

            </nav>

            <div id="containerSearch">
                <div id="search">
                    <form name="form" method="post" action="index.html">
                        <input type="search" name="schPesquisa" placeholder="Digite as palavras-chave do produto | ID do produto">
                    </form>
                    <div class="posicaoTitulo">
                        <h1>Titulo XXXXXXXX</h1>
                    </div>
                </div>
            </div>

            <!--CARDS PROTUDOS-->
            <div id="containerProtudo">
                <div id="parteProtudos">

                    <div class="cards">
                        <div class="cardsImagem">
                            <img src="imagens/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationsCards">
                                <p><b>Nome:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Descrição:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div>

                    <div class="cards">
                        <div class="cardsImagem">
                            <img src="imagens/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationsCards">
                                <p><b>Nome:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Descrição:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div>

                    <div class="cards">
                        <div class="cardsImagem">
                            <img src="imagens/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationsCards">
                                <p><b>Nome:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Descrição:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div>

                    <div class="cards">
                        <div class="cardsImagem">
                            <img src="imagens/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationsCards">
                                <p><b>Nome:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Descrição:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div>

                    <div class="cards">
                        <div class="cardsImagem">
                            <img src="imagens/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationsCards">
                                <p><b>Nome:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Descrição:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div>

                    <div class="cards">
                        <div class="cardsImagem">
                            <img src="imagens/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationsCards">
                                <p><b>Nome:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Descrição:</b></p>
                            </div>

                            <div class="informationsCards">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--SEÇÃO SOBRE A EMPRESA-->
    <div id="sobreEmpresa" class="centerObject sombra">
        <div class="conteudo">
            <h1>TITULO XXXXXXX</h1>
            <div id="textoEmpresa" class="centerObject">
                <p> oremcbvdsfbkjvdsflvbdfsbgjdfbjgdsfkbjgdfkgbjfvgbknjldfjlkdfgbjfdgbjdfbvdfbvjfbvljfadvsdfbkvdsbjvbhvblfvafdbvadfvlbjfvbhldf
                    svbhdfvblbrhdfvlbhdfblvhdfbhvdfbljvfdblvbfvlabhfgvlafgvlbhfdvjfvbhfavlballoremcnjbvkdn
                    bjdfbnfbdkjbvdsfbkjvdsflvbdfsbgjdfbjgdsfkbjgdfkgbjvfvgbknjldfjlkdfgbjfdgbjdfbvdfbvj
                    fbvljfadvsdfbkvdsbjvbhvblfvafdbvadfvlbjfvbhldfsvbhdbrhdfvlbhdfblvhdfbhvdfbljvfdblvbfvlabhfgvlafgv
                    lbhfdvjfvbhfavlballoremcnjbvkdnbjdfbnfbdkjbvdsfbkjvdsflvbdfsbgjdfbjgdsfkbjgdfkgbjvfvgbknjldfjlkdfgb
                    jfdgbjdfbvdfbvjfbvljfadvsdfbkbjvbhvblfvafdbvadfvlbjfvbhldfsvbhdfvblhdfvlbhdfblvhdfbhvdfbljvfdblvbfvl
                    abhfgvlafgvlbhfdvjfvbhfavlbalghrtyhryheatjkhbgygv
                </p>
            </div>
        </div>
    </div>

    <!--SEÇÃO PROTUDOS EM DESTAQUES-->
    <div id="destaques" class="centerObject sombra">
        <div class="conteudo">
            <h1>Nossos produtos em Destaques</h1>
            <div id="containerDestaques">

                <div class="conteudoDestaque">
                    <div class="imagemDestaque">

                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>Nome do Produto</h2>

                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="conteudoDestaque">
                    <div class="imagemDestaque">
                        <img src="imagens/paris.jpg" alt="paris">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>Nome do Produto</h2>

                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="conteudoDestaque">
                    <div class="imagemDestaque">
                        <img src="imagens/wa.png" alt="paris">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>Nome do Produto</h2>

                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="conteudoDestaque">
                    <div class="imagemDestaque">
                        <img src="imagens/polo.jpg" alt="paris">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>Nome do Produto</h2>

                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--SEÇÃO PRODUTOS EM PROMOÇÃO-->
    <div id="promocao" class="centerObject sombra">
        <div class="conteudo">
            <h1>Nossos Protudos em Promoção</h1>
            <div class="containerPromocao">

                <div class="cardsPromocoes">
                    <div class="cardsImagem">
                        <img src="imagens/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationsCards">
                            <p><b>Nome:</b> Felicidade Nike</p>
                        </div>
                        <div class="precoAntigo">
                            <p><b>de R$:</b> 1500,00</p>
                        </div>
                        <div class="precoAtual">
                            <p><b>Por R$:</b> 150,90</p>
                        </div>

                        <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoPromocao">
                    </div>
                </div>

                <div class="cardsPromocoes">
                    <div class="cardsImagem">
                        <img src="imagens/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationsCards">
                            <p><b>Nome:</b> Felicidade Nike</p>
                        </div>
                        <div class="precoAntigo">
                            <p><b>de R$:</b> 1500,00</p>
                        </div>
                        <div class="precoAtual">
                            <p><b>Por R$:</b> 150,90</p>
                        </div>

                        <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoPromocao">
                    </div>
                </div>

                <div class="cardsPromocoes">
                    <div class="cardsImagem">
                        <img src="imagens/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationsCards">
                            <p><b>Nome:</b> Felicidade Nike</p>
                        </div>
                        <div class="precoAntigo">
                            <p><b>de R$:</b> 1500,00</p>
                        </div>
                        <div class="precoAtual">
                            <p><b>Por R$:</b> 150,90</p>
                        </div>

                        <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoPromocao">
                    </div>
                </div>

                <div class="cardsPromocoes">
                    <div class="cardsImagem">
                        <img src="imagens/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationsCards">
                            <p><b>Nome:</b> Felicidade Nike</p>
                        </div>
                        <div class="precoAntigo">
                            <p><b>de R$:</b> 1500,00</p>
                        </div>
                        <div class="precoAtual">
                            <p><b>Por R$:</b> 150,90</p>
                        </div>

                        <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoPromocao">
                    </div>
                </div>

                <div class="cardsPromocoes">
                    <div class="cardsImagem">
                        <img src="imagens/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationsCards">
                            <p><b>Nome:</b> Felicidade Nike</p>
                        </div>
                        <div class="precoAntigo">
                            <p><b>de R$:</b> 1500,00</p>
                        </div>
                        <div class="precoAtual">
                            <p><b>Por R$:</b> 150,90</p>
                        </div>

                        <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoPromocao">
                    </div>
                </div>


                <div class="cardsPromocoes">
                    <div class="cardsImagem">
                        <img src="imagens/desconto.png" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationsCards">
                            <p><b>Nome:</b></p>
                        </div>
                        <div class="precoAntigo">
                            <p><b>de R$:</b> 1500,00</p>
                        </div>
                        <div class="precoAtual">
                            <p><b>Por R$:</b> 150,90</p>
                        </div>

                        <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoPromocao">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--SEÇÃO NOSSSAS LOJAS-->
    <div id="lojas" class="centerObject sombra">
        <div class="conteudo">
            <h1>Nossas Lojas</h1>
            <div class="textoLoja">
                <p>Estamos te esperando em uma das nossas lojas físicas! Descubra o endereço da <b>Blinding Light</b>
                    mais perto de você.<br>
                    <b>Consulte lojas com Serviço Delivery.</b>
                </p>
            </div>
            <div id="positiontoadasLojas">
                <h1>Todas as lojas</h1>
            </div>

            <div id="containerLojas">

                <?php
                
                    $sql = "select * from tblnossaslojas where tblnossaslojas.statusLoja = 1;";

                    $select = mysqli_query($conex, $sql);
                
                    while($rsLojas = mysqli_fetch_assoc($select))
                    {
                ?>

                <!--CARDS NOSSAS LOJAS-->
                <div class="cardsLojas">
                    <div class="iconDescricao">
                        <img src="icons/<?=$rsLojas['statusAberto']?>.png" alt="Localização das Lojas" class="imagemLojas">
                    </div>
                    <div class="informationsLojas">
                        <p><?=$rsLojas['nome']?><br>
                            <?=$rsLojas['celular']?><br>
                            <?=$rsLojas['endereco']?><br>
                            <b>Aberto</b>
                        </p>
                    </div>
                </div>                
                <?php
                    }
                ?>
                
                

<!--
                <div class="cardsLojas">
                    <div class="iconDescricao">
                        <img src="icons/location_icon.png" alt="Localização das Lojas" class="imagemLojas">
                    </div>
                    <div class="informationsLojas">
                        <p>SHOPPING PÁTIO SAVASSI<br>
                            (31) 98401-9379<br>
                            Avenida do Contorno, 6061<br>
                            <b>Aberto</b>
                        </p>
                    </div>
                </div>

-->

            </div>
        </div>
    </div>

    <!--SEÇÃO RODAPÉ-->
    <footer id="footer">

        <div id="containerContatos" class="centerObject">
            <div id="contatos" class="centerObject">
                <h1>FALE CONOSCO</h1>

                <!--Formulario Contatos-->
                <form name="frmContatos" method="post" action="<?=$action?>">

                    <div class="arrumaLayoutContatos">


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Nome: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" value="" placeholder="Digite seu Nome" required pattern="[a-z A-Z é]*">
                            </div>
                        </div>


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Telefone: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="tel" name="txtTelefone" value="" pattern="[(][0-9]{2}[)][0-9]{4}-[0-9]{4}" placeholder="(44)4444-4444" onkeypress="MascaraTelefone(this);" maxlength="13">
                            </div>
                        </div>


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Celular: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="tel" name="txtCelular" value="" required pattern="[(][0-9]{2}[)][0-9]{5}-[0-9]{4}" placeholder="(99)99999-9999" onkeypress="Mascara(this);" maxlength="14">
                            </div>
                        </div>


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Email: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="email" name="txtEmail" value="" required placeholder="Digite seu melhor E-mail">
                            </div>
                        </div>

                    </div>

                    <div class="arrumaLayoutContatos">

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Link do Facebook: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input name="urlFacebook" type="url" placeholder="Link do Facebook caso possua">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Sugestões e Criticas: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <select name="sltSugestao">
                                    <option value="">Selecione uma opção</option>

                                    <?php
                                        $sql = "select * from tblcontatos";
                      
                                        $select = mysqli_fetch_assoc($conex, $sql);
                      
                                        while($rsContato = mysqli_fetch_assoc($select))
                                        {    
                                    ?>
                                    <option value="<?=$rsContato['idContato']?>"> <?=$rsContato['sugestao'];?> "></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Mensagem: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <textarea name="txtMensagem" cols="50" rows="7" required placeholder="Mensagem..."></textarea>
                            </div>
                        </div>


                    </div>

                    <div class="arrumaLayoutContatos">

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Profissão: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtProfissao" value="" placeholder="Digite sua Profissão" required pattern="[a-z A-Z é]*">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Home Page: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input name="urlHomePage" type="url" placeholder="página pessoal caso possua">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Sexo: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="radio" name="rdoSexo" required value="F">Feminino.
                                <input type="radio" name="rdoSexo" value="M">Masculino.
                            </div>
                        </div>
                        <div class="enviar">
                            <div class="enviar">
                                <input type="submit" name="btnEnviar" value="Enviar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>

        <div id="containerPrivacidade">
            <div id="logoRodape">

            </div>
            <div id="copyRight" class="centerObject">
                <h5>
                    ©Copyright 2020<br>
                    Todos os direitos reservados a Matheus Henrique - Politica de Privacidade
                </h5>
            </div>
        </div>
    </footer>

    <!--Botão para ir para o Inicio-->
    <button type="button" onclick="backToTop()" id="btnTop"></button>

    <script src="js/sliderShow.js"></script>
    <script src="js/back-to-top.js"></script>
</body>

</html>
