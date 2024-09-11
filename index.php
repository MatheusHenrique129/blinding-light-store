<?php
//Variavel que será utilizada no atributo action do form (Cadastrar e Atualizar)
$action = "db/bd_Contato/inserirContato.php";

//Import do arquivo de Variaveis e Constantes
require_once('modules/config.php');

//Import do arquivo de função para conectar no BD
require_once('db/mysql_connection.php');

//Chama a função que estabelece a conexão com o BD
if (!$conex = mysqlConnection()) {
    echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "') </script>");
    //die; //Finaliza a interpretação da página
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blinding Light Store - Melhores Roupas Do Brasil</title>
    <link rel="icon" href="icons/icon-view.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="Js/cellphone-mask.js"></script>
    <script src="js/telephone-mask.js"></script>
</head>

<body>
    <!-- SEÇÃO DO CABEÇALHO E DO MENU -->
    <div id="header">
        <div class="conteudo centerObject">
            <div id="logo"></div>

            <nav id="menuContainer" class="scroll">
                <ul id="menu">
                    <li><a href="#containerSlider" class="menuItens">Home</a></li>
                    <li><a href="#sobreEmpresa" class="menuItens">Empresa</a></li>
                    <li><a href="#storeSection" class="menuItens">Loja</a></li>
                    <li><a href="#contatos" class="menuItens">Contato</a></li>
                </ul>
            </nav>

            <div id="loginContainer">
                <form name="frmMenu" method="post" action="index.html">
                    <div class="textSessionLogin">
                        <label>Usuário</label>
                        <input type="email" name="menuEmail" required placeholder="Digite seu Email" class="inputLogin" value="">
                    </div>
                    <div class="textSessionLogin">
                        <label>Senha</label>
                        <input type="password" name="pwdSenha" required placeholder="Digite sua senha" class="inputLogin" value="">
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
                <img src="images/facebook.png" alt="facebook" class="imageRedeSocial">
            </a>
            <a href="#">
                <img src="images/instagram.png" alt="instagram" class="imageRedeSocial">
            </a>
            <a href="#">
                <img src="images/whatsapp.png" alt="whatsapp" class="imageRedeSocial">
            </a>
        </div>
    </div>

    <!--SEÇÃO sliderShow-->
    <section id="containerSlider" class="centerObject">
        <div id="sliderShow" class="shadow">
            <div class="buttonSliderAction" id="previous">&laquo;</div>
            <div id="containerItems"></div>
            <div class="buttonSliderAction" id="next">&raquo;</div>
        </div>
    </section>

    <!--SEÇÃO PRODUTOS-->
    <section id="produtos" class="centerObject shadow">
        <div class="conteudo">
            <nav id="secondaryMenu">
                <?php
                $sql = "SELECT c.idCategory, c.name AS category_name, s.idSubcategory, s.name AS subcategory_name 
                        FROM tblcategory AS c
                        LEFT JOIN tblsubcategory AS s ON c.idCategory = s.idCategory
                        WHERE c.statusCategory = 1";

                $select = mysqli_query($conex, $sql);
                $categories = [];

                while ($row = mysqli_fetch_assoc($select)) {
                    // Verifica se a categoria já existe no array
                    if (!isset($categories[$row['idCategory']])) {
                        $categories[$row['idCategory']] = [
                            'name' => $row['category_name'],
                            'subcategories' => []
                        ];
                    }

                    // Adiciona subcategoria se existir
                    if (!empty($row['subcategory_name'])) {
                        $categories[$row['idCategory']]['subcategories'][] = [
                            'id' => $row['idSubcategory'],
                            'name' => $row['subcategory_name']
                        ];
                    }
                }

                foreach ($categories as $categoryID => $categoryData) {
                ?>
                    <div class="checkboxItem">
                        <input type="checkbox" id="<?= $categoryID ?>">
                        <label for="<?= $categoryID ?>"><?= $categoryData["name"] ?></label>
                        <ul>
                            <?php
                            // Exibe as subcategorias
                            foreach ($categoryData["subcategories"] as $subcategory) {
                            ?>
                                <li><a href="index.php?idSubcategory=<?= $subcategory['id'] ?>"><?= $subcategory["name"] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>

                <!-- <div class="checkboxItem">
                    <input type="checkbox" id="check2">
                    <label for="check2">Menu</label>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Sobre</a></li>
                    </ul>
                </div> -->
            </nav>

            <div id="containerSearch">
                <div id="search">
                    <form name="form" method="post" action="search.php">
                        <input type="search" name="searchInput" placeholder="Digite as palavras-chave do produto | ID do produto">
                    </form>
                    <div class="posicaoTitulo">
                        <h1>Ofertas</h1>
                    </div>
                </div>
            </div>

            <br>

            <!--CARDS PRODUTOS-->
            <div id="productContainer">
                <div id="parteProtudos">
                    <?php
                    $idSubcategory = isset($_GET['idSubcategory']) ? intval($_GET['idSubcategory']) : 0;

                    if ($idSubcategory > 0) {
                        $sql = "SELECT * FROM tblproducts WHERE idSubcategory = $idSubcategory";
                    } else {
                        $sql = "SELECT * FROM tblproducts WHERE statusProduct = 1";
                    }

                    $select = mysqli_query($conex, $sql);

                    if (mysqli_num_rows($select) > 0) {
                        while ($rsProduct = mysqli_fetch_assoc($select)) {
                    ?>
                            <div class="card">
                                <div class="cardsImagem">
                                    <img src="<?= !empty($rsProduct['image']) ? $rsProduct['image'] : 'images/no-image.jpg'; ?>" alt="<?= $rsProduct['name'] ?>">
                                </div>
                                <div class="cardDescricao centerObject">
                                    <div class="informationCard">
                                        <p><b>Nome:</b> <?= $rsProduct['name'] ?></p>
                                    </div>
                                    <div class="informationCard">
                                        <p><b>Descrição:</b> <?= $rsProduct['description'] ?></p>
                                    </div>
                                    <div class="informationCard">
                                        <p><b>Preço:</b> R$ <?= number_format($rsProduct['price'], 2, ',', '.') ?></p>
                                    </div>
                                    <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="noProductsMessage">
                            <img src="images/cat-no-mensage.webp" alt="Gatinho" class="noProductsImage">
                            <p>Nenhum produto encontrado para essa subCategoria.</p>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- <div class="card">
                        <div class="cardsImagem">
                            <img src="images/paris.jpg" alt="roupas de marca">
                        </div>
                        <div class="cardDescricao centerObject">
                            <div class="informationCard">
                                <p><b>Nome:</b></p>
                            </div>
                            <div class="informationCard">
                                <p><b>Descrição:</b></p>
                            </div>
                            <div class="informationCard">
                                <p><b>Preço:</b></p>
                            </div>
                            <input type="button" name="btnProtudos" value="SAIBA MAIS" class="botaoProtudos">
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </section>

    <!--SEÇÃO SOBRE A EMPRESA-->
    <section id="sobreEmpresa" class="centerObject shadow">
        <div class="conteudo">
            <h1>TITULO XXXXXXX</h1>
            <div id="textoEmpresa" class="centerObject">
                <p> As tendências que combinam estilo e conforto para desfilar por aí são as que mais caem no gosto das pessoas. Assim,
                    a Vans se tornou tão amada e presente nos pés de pessoas com todos os estilos. A marca californiana tem uma grande variedade de modelos em roupas, acessórios e tênis dedicados ao estilo street.
                    Quem gosta de se vestir bem sabe que alguns itens não podem faltar no guarda-roupas. É o caso do tênis Vans, por ser básico e confortável ele é muito fácil de incluir nos looks tanto no verão quanto no inverno.
                    Dá para usar com bermudas, vestido, macacão e outros. Ou seja, opções não faltam! O modelo de tênis Vans Old Skool é um dos queridinhos do momento, estando presente no pé de fashionistas do mundo todo.
                    A Vans tem também outros produtos incríveis, como a regata Vans, o boné Vans, etc. Dá para garantir um visual moderno e diferente só com os produtos da marca. Por exemplo, você pode combinar uma camiseta Vans com um blazer colorido.
                    Na Session Store você encontra os melhores produtos da Vans para vestir-se com peças modernas e confortáveis! Gosta de estilo e conforto?
                </p>
            </div>
        </div>
    </section>

    <!--SEÇÃO PROTUDOS EM DESTAQUES-->
    <section id="destaques" class="centerObject shadow">
        <div class="conteudo">
            <h1>Nossos produtos em Destaques</h1>
            <div id="containerDestaques" class="grid">
                <div class="featuredCard centerObject">
                    <div class="featuredCardImage">
                        <img src="images/vans.webp" alt="vans">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>VANS</h2>

                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="featuredCard centerObject">
                    <div class="featuredCardImage">
                        <img src="images/nike.webp" alt="nike">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>NIKE</h2>

                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="featuredCard centerObject">
                    <div class="featuredCardImage">
                        <img src="images/high.webp" alt="high">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>HIGH</h2>
                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="featuredCard centerObject">
                    <div class="featuredCardImage">
                        <img src="images/baw.webp" alt="baw clothing">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>BAW CLOTHING</h2>
                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="featuredCard centerObject">
                    <div class="featuredCardImage">
                        <img src="images/element.webp" alt="element">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>ELEMENT</h2>
                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

                <div class="featuredCard centerObject">
                    <div class="featuredCardImage">
                        <img src="images/dc.webp" alt="dc shoes">
                    </div>
                    <div class="tituloDestaque centerObject">
                        <h2>DC SHOES</h2>
                        <input type="submit" name="subDestaque" value="SAIBA MAIS" class="botaoDestaque">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--SEÇÃO PRODUTOS EM PROMOÇÃO-->
    <section id="promocao" class="centerObject shadow">
        <div class="conteudo">
            <h1>Nossos Protudos em Promoção</h1>
            <div class="containerPromocao">

                <div class="cardPromotion">
                    <div class="cardsImagem">
                        <img src="images/no-image.jpg" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationCard">
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

                <div class="cardPromotion">
                    <div class="cardsImagem">
                        <img src="images/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationCard">
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

                <div class="cardPromotion">
                    <div class="cardsImagem">
                        <img src="images/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationCard">
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

                <div class="cardPromotion">
                    <div class="cardsImagem">
                        <img src="images/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationCard">
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

                <div class="cardPromotion">
                    <div class="cardsImagem">
                        <img src="images/" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationCard">
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

                <div class="cardPromotion">
                    <div class="cardsImagem">
                        <img src="images/desconto.png" alt="roupas de marca">
                    </div>
                    <div class="cardDescricao centerObject">
                        <div class="informationCard">
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
    </section>

    <!--SEÇÃO NOSSSAS LOJAS-->
    <section id="storeSection" class="centerObject shadow">
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
                $sql = "select * from tblstores where tblstores.statusStore = 1;";
                $select = mysqli_query($conex, $sql);

                while ($rsStores = mysqli_fetch_assoc($select)) {
                ?>
                    <!--CARDS NOSSAS LOJAS-->
                    <div class="storeCard">
                        <div class="iconDescricao">
                            <img src="icons/location.png" alt="<?= $rsStores['name'] ?>" class="imagemLojas">
                        </div>
                        <div class="storeInformation">
                            <p><?= $rsStores['name'] ?><br>
                                <?= $rsStores['cellphone'] ?><br>
                                <?= $rsStores['address'] ?><br>
                                <b>Aberto</b>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- <div class="storeCard">
                    <div class="iconDescricao">
                        <img src="icons/location.png" alt="Localização das Lojas" class="imagemLojas">
                    </div>
                    <div class="storeInformation">
                        <p>SHOPPING PÁTIO SAVASSI<br>
                            (31) 98401-9379<br>
                            Avenida do Contorno, 6061<br>
                            <b>Aberto</b>
                        </p>
                    </div>
                </div> -->

            </div>
        </div>
    </section>

    <!--SEÇÃO RODAPÉ-->
    <footer id="footer">
        <div id="containerContatos" class="centerObject">
            <div id="contatos" class="centerObject">
                <h1>FALE CONOSCO</h1>

                <!--Formulario Contatos-->
                <form name="frmContatos" method="post" action="<?= $action ?>">
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
                                <input type="tel" name="txtCelular" value="" required pattern="[(][0-9]{2}[)][0-9]{5}-[0-9]{4}" placeholder="(99)99999-9999" onkeypress="Mask(this);" maxlength="14">
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
                                    $sql = "select * from tblcontacts";
                                    $select = mysqli_query($conex, $sql);

                                    while ($rsContato = mysqli_fetch_assoc($select)) {
                                    ?>
                                        <option value="<?= $rsContato['idContato'] ?>"> <?= $rsContato['suggestion']; ?></option>
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

    <script src="js/slider-show.js"></script>
    <script src="js/back-to-top.js"></script>
</body>

</html>