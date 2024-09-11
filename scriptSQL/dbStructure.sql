create database db_blindingLight_store;

use db_blindingLight_store;

show databases;

create table tblcontacts (
	id int not null auto_increment primary key,
	name varchar(80) not null,
    telephone varchar(15),
    cellphone varchar(15) not null,
    email varchar(50) not null,
	facebook varchar(250),
    suggestion int(2) not null, 
    message text not null,
    profession varchar(50) not null,
    homePage varchar(250),
    gender varchar(1) not null,
    statusContact boolean not null
);

show tables;
desc tblcontatos;

create table tblcategory(
	idCategory int not null primary key auto_increment, 
    name varchar(60) not null,
    statusCategory boolean not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table tblsubcategory(
	idSubcategory int not null primary key auto_increment,
    name varchar(60) not null,
    idCategory INT NOT NULL,
    constraint fk_category_subcategory 
    foreign key (idCategory) 
    references tblcategory(idCategory)
);

CREATE TABLE tblproducts (
    idProduct INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    promotion_price DECIMAL(10,2) NULL, -- Preço em promoção
    stock INT NOT NULL DEFAULT 0,     -- Quantidade em estoque
    image VARCHAR(255), 
    idSubcategory INT,
    isFeatured BOOLEAN DEFAULT FALSE,
    isOnPromotion BOOLEAN DEFAULT FALSE;
    statusProduct BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_subcategory_product FOREIGN KEY (idSubcategory) REFERENCES tblsubcategory(idSubcategory)
);

CREATE TABLE tblorders (
    idOrder INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    totalAmount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'shipped', 'delivered', 'canceled') NOT NULL DEFAULT 'pending',
    delivery_address VARCHAR(255) NOT NULL,
    payment_method ENUM('credit_card', 'debit_card', 'paypal', 'boleto') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_user FOREIGN KEY (idUser) REFERENCES tblusers(idUser)
);

CREATE TABLE tblorder_items (
    idOrder INT NOT NULL,
    idProduct INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (idOrder, idProduct),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_item_order FOREIGN KEY (idOrder) REFERENCES tblorders(idOrder),
    CONSTRAINT fk_order_item_product FOREIGN KEY (idProduct) REFERENCES tblproducts(idProduct)
);

CREATE TABLE tblcart (
    idCart INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cart_user FOREIGN KEY (idUser) REFERENCES tblusers(idUser)
);

CREATE TABLE tblcart_items (
    idCart INT NOT NULL,
    idProduct INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY (idCart, idProduct),
    CONSTRAINT fk_cart_item_cart FOREIGN KEY (idCart) REFERENCES tblcart(idCart),
    CONSTRAINT fk_cart_item_product FOREIGN KEY (idProduct) REFERENCES tblproducts(idProduct)
);

CREATE TABLE tbldelivery (
    idDelivery INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idOrder INT NOT NULL,
    deliveryDate DATE,
    status ENUM('pending', 'in_transit', 'delivered', 'failed') NOT NULL DEFAULT 'pending',
    delivery_address VARCHAR(255),
    CONSTRAINT fk_delivery_order FOREIGN KEY (idOrder) REFERENCES tblorders(idOrder)
);

create table tblstores (
	idStore int not null auto_increment primary key,
    name varchar(50) not null,
    cellphone varchar(15) not null,
    address varchar(100) not null,
    photo varchar(70) not null,
    statusStore int(1)  not null,
    #openDelivery varchar(8) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table tblusers (
	idUser int NOT NULL auto_increment primary key,
    name varchar(100) NOT NULL,
    cellphone varchar(15) NOT NULL, 
    gender varchar(1) NOT NULL,
    dateBirth date NOT NULL,
    email varchar(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') NOT NULL, -- Definindo o tipo de acesso: cliente ou admin
    statusUser BOOLEAN NOT NULL DEFAULT TRUE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tblroles (
    idRole INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE tbluser_roles (
    idUser INT NOT NULL,
    idRole INT NOT NULL,
    PRIMARY KEY (idUser, idRole)
    CONSTRAINT fk_user FOREIGN KEY (idUser) REFERENCES tblusers(idUser),
    CONSTRAINT fk_role FOREIGN KEY (idRole) REFERENCES tblroles(idRole)
);

-- Inserindo os roles básicos
INSERT INTO tblroles (name) VALUES ('client'), ('admin');

-- INSERT CATEGORIES IN TABLE --
INSERT INTO tblcategory(name, statusCategory) VALUES ('Computadores', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Eletrônicos', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Roupas Masculinas', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Roupas Femininas', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Calçados', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Acessórios', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Móveis', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Esportes', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Brinquedos', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Beleza e Cuidados Pessoais', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Livros', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Papelaria', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Alimentos e Bebidas', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Automóveis', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Ferramentas', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Jardinagem', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Instrumentos Musicais', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Pet Shop', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Jogos e Consoles', 1);
INSERT INTO tblcategory(name, statusCategory) VALUES ('Filmes e Séries', 1);

-- INSERT SUBCATEGORIES IN TABLE --
-- Subcategorias para Computadores (idCategory = 1)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Notebooks', 1);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Desktops', 1);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios para Computadores', 1);

-- Subcategorias para Eletrônicos (idCategory = 2)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Smartphones', 2);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Tablets', 2);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios Eletrônicos', 2);

-- Subcategorias para Roupas Masculinas (idCategory = 3)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Camisas', 3);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Calças', 3);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Ternos', 3);

-- Subcategorias para Roupas Femininas (idCategory = 4)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Vestidos', 4);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Saias', 4);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Blusas', 4);

-- Subcategorias para Calçados (idCategory = 5)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Tênis', 5);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Sandálias', 5);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Sapatos Sociais', 5);

-- Subcategorias para Acessórios (idCategory = 6)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Relógios', 6);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Óculos de Sol', 6);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Bijuterias', 6);

-- Subcategorias para Móveis (idCategory = 7)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Sofás', 7);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Cadeiras', 7);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Mesas', 7);

-- Subcategorias para Esportes (idCategory = 8)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Roupas Esportivas', 8);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios Esportivos', 8);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Calçados Esportivos', 8);

-- Subcategorias para Brinquedos (idCategory = 9)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Bonecas', 9);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Jogos de Tabuleiro', 9);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Carrinhos', 9);

-- Subcategorias para Beleza e Cuidados Pessoais (idCategory = 10)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Maquiagem', 10);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Cremes e Loções', 10);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Perfumes', 10);

-- Subcategorias para Livros (idCategory = 11)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Ficção', 11);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Não Ficção', 11);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Infantil', 11);

-- Subcategorias para Papelaria (idCategory = 12)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Cadernos', 12);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Canetas', 12);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Artigos de Escritório', 12);

-- Subcategorias para Alimentos e Bebidas (idCategory = 13)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Bebidas', 13);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Snacks', 13);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Comidas Congeladas', 13);

-- Subcategorias para Automóveis (idCategory = 14)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Peças de Carro', 14);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Motos', 14);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios para Veículos', 14);

-- Subcategorias para Ferramentas (idCategory = 15)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Ferramentas Manuais', 15);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Ferramentas Elétricas', 15);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios para Ferramentas', 15);

-- Subcategorias para Jardinagem (idCategory = 16)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Ferramentas de Jardim', 16);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Plantas', 16);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Vasos', 16);

-- Subcategorias para Instrumentos Musicais (idCategory = 17)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Guitarras', 17);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Baterias', 17);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Teclados', 17);

-- Subcategorias para Pet Shop (idCategory = 18)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Rações', 18);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios para Animais', 18);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Brinquedos para Pets', 18);

-- Subcategorias para Jogos e Consoles (idCategory = 19)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Consoles', 19);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Jogos de Videogame', 19);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Acessórios para Consoles', 19);

-- Subcategorias para Filmes e Séries (idCategory = 20)
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Filmes', 20);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Séries', 20);
INSERT INTO tblsubcategory(name, idCategory) VALUES ('Documentários', 20);

-- INSERT PRODUCTS IN TABLE --
-- Produtos para Notebooks
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Notebook Gamer X', 'Notebook para jogos com processador i7 e 16GB de RAM.', 4500.00, 'images/notebook-gamer.jpg', TRUE, 1),
('Notebook Ultrabook Y', 'Ultrabook leve e portátil com tela de 13 polegadas.', 2500.00, 'images/ultrabook.jpg', TRUE, 1);

-- Produtos para Desktops
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Desktop Power Z', 'Desktop com processador i9 e 32GB de RAM.', 5000.00, 'images/desktop-power.jpg', TRUE, 2),
('Desktop Home Office W', 'Desktop básico para home office.', 1500.00, 'images/desktop-office.jpg', TRUE, 2);

-- Produtos para Acessórios para Computadores
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Teclado Mecânico RGB', 'Teclado mecânico com iluminação RGB e switches Cherry MX.', 300.00, 'images/teclado-rgb.jpg', TRUE, 3),
('Mouse Óptico', 'Mouse óptico ergonômico com 6 botões.', 80.00, 'images/mouse-optico.jpg', TRUE, 3);

-- Produtos para Smartphones
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Smartphone X', 'Smartphone com câmera de 48MP e 128GB de armazenamento.', 2000.00, 'images/smartphone-x.jpg', TRUE, 4),
('Smartphone Y', 'Smartphone com tela OLED e 64GB de armazenamento.', 1500.00, 'images/smartphone-y.jpg', TRUE, 4);

-- Produtos para Tablets
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Tablet Pro A', 'Tablet com tela de 10 polegadas e suporte a caneta.', 1200.00, 'images/tablet-pro.jpg', TRUE, 5),
('Tablet Básico B', 'Tablet com tela de 8 polegadas e 32GB de armazenamento.', 600.00, 'images/tablet-basico.jpg', TRUE, 5);

-- Produtos para Acessórios Eletrônicos
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Fone de Ouvido Bluetooth', 'Fone de ouvido com cancelamento de ruído e Bluetooth 5.0.', 350.00, 'images/fone-bluetooth.jpg', TRUE, 6),
('Carregador Portátil', 'Carregador portátil com capacidade de 10000mAh.', 120.00, 'images/carregador-portatil.jpg', TRUE, 6);

-- Produtos para Camisas
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Camisa Polo Azul', 'Camisa polo em algodão com botão e gola.', 100.00, 'images/camisa-polo.jpg', TRUE, 7),
('Camisa Casual X', 'Camisa casual de manga longa em tecido leve.', 120.00, 'images/camisa-casual.jpg', TRUE, 7);

-- Produtos para Calças
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Calça Jeans', 'Calça jeans azul escuro com corte reto.', 150.00, 'images/calca-jeans.jpg', TRUE, 8),
('Calça Chino', 'Calça chino leve e confortável.', 130.00, 'images/calca-chino.jpg', TRUE, 8);

-- Produtos para Ternos
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Terno Slim Fit', 'Terno slim fit com blazer e calça.', 700.00, 'images/terno-slim.jpg', TRUE, 9),
('Terno Clássico', 'Terno clássico com blazer e calça.', 800.00, 'images/terno-classico.jpg', TRUE, 9);

-- Produtos para Vestidos
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Vestido Floral', 'Vestido floral de verão com alças.', 180.00, 'images/vestido-floral.jpg', TRUE, 10),
('Vestido Midi', 'Vestido midi elegante para eventos.', 220.00, 'images/vestido-midi.jpg', TRUE, 10);

-- Produtos para Saias
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Saia Jeans', 'Saia jeans curta com botões frontais.', 120.00, 'images/saia-jeans.jpg', TRUE, 11),
('Saia de Tule', 'Saia de tule com cintura elástica.', 140.00, 'images/saia-tule.jpg', TRUE, 11);

-- Produtos para Blusas
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Blusa de Seda', 'Blusa de seda com manga curta.', 150.00, 'images/blusa-seda.jpg', TRUE, 12),
('Blusa Casual', 'Blusa casual de algodão com estampa.', 80.00, 'images/blusa-casual.jpg', TRUE, 12);

-- Produtos para Tênis
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Tênis Casual', 'Tênis casual em couro com sola de borracha.', 180.00, 'images/tenis-casual.jpg', TRUE, 13),
('Tênis Esportivo', 'Tênis esportivo com amortecimento avançado.', 220.00, 'images/tenis-esportivo.jpg', TRUE, 13);

-- Produtos para Sandálias
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Sandália de Couro', 'Sandália de couro com tiras ajustáveis.', 120.00, 'images/sandalia-couro.jpg', TRUE, 14),
('Sandália Casual', 'Sandália casual com sola confortável.', 100.00, 'images/sandalia-casual.jpg', TRUE, 14);

-- Produtos para Sapatos Sociais
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Sapato Oxford', 'Sapato oxford em couro para ocasiões formais.', 250.00, 'images/sapato-oxford.jpg', TRUE, 15),
('Sapato Derby', 'Sapato derby clássico com acabamento em verniz.', 270.00, 'images/sapato-derby.jpg', TRUE, 15);

-- Produtos para Relógios
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Relógio de Pulso', 'Relógio de pulso com mostrador analógico.', 350.00, 'images/relogio-pulso.jpg', TRUE, 16),
('Relógio Esportivo', 'Relógio esportivo com GPS e monitor de batimento cardíaco.', 500.00, 'images/relogio-esportivo.jpg', TRUE, 16);

-- Produtos para Óculos de Sol
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Óculos de Sol Polarizado', 'Óculos de sol com lentes polarizadas.', 150.00, 'images/oculos-solar.jpg', TRUE, 17),
('Óculos de Sol Fashion', 'Óculos de sol com design moderno.', 200.00, 'images/oculos-fashion.jpg', TRUE, 17);

-- Produtos para Bijuterias
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Colar de Pérolas', 'Colar de pérolas com fecho de prata.', 90.00, 'images/colar-perolas.jpg', TRUE, 18),
('Brincos de Cristal', 'Brincos de cristal com acabamento dourado.', 60.00, 'images/brincos-cristal.jpg', TRUE, 18);

-- Produtos para Sofás
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Sofá 3 Lugares', 'Sofá de 3 lugares em tecido suave.', 1200.00, 'images/sofa-3-lugares.jpg', TRUE, 19),
('Sofá Cama', 'Sofá que se transforma em cama.', 1500.00, 'images/sofa-cama.jpg', TRUE, 19);

-- Produtos para Cadeiras
INSERT INTO tblproducts (name, description, price, image, statusProduct, idSubcategory) VALUES 
('Cadeira de Escritório', 'Cadeira ergonômica para escritório.', 400.00, 'images/cadeira-escritorio.jpg', TRUE, 20),
('Cadeira de Jantar', 'Cadeira de jantar com estofado.', 250.00, 'images/cadeira-jantar.jpg', TRUE, 20);


desc tblstores;

--  INSERT STORES IN TABLE --
insert into tblstores (name, cellphone, address, photo, statusStore)
values
(
'SHOPPING PÁTIO SAVASSI',
'(31)98401-9379',
'Avenida do Contorno, 6061',
'no-image.jpg',
1
);

--  INSERT CONTACTS IN TABLE --
-- Insert a new contact
insert into tblcontacts (name, telephone, cellphone, email, facebook, suggestion, message, profession, homePage, gender, statusContact)
values('Mariana',
'119854-1040',
'1199854-1040',
'marianabrantes@gmail.com',
'https://api.whatsapp.com/send?phone=',
'S',
'teste',
'mecanica',
'https://martechtoday.com',
'F',
1
);

insert into tblcontacts (name, telephone, cellphone, email, facebook, suggestion, message, profession, homePage, gender, statusContact)
values('Ronaldo',
'119854-1040',
'1199854-1040',
'rodolfoabrantes@gmail.com',
'https://api.whatsapp.com/send?phone=',
1,
'teste',
'mecanico',
'https://martechtoday.com/death-home-page-greatly-exaggerated-170610',
'M',
'1'
);

select * from tblstores;

select * from tblstores where idStore = '1';

-- alter table tblstores add column foto varchar (100);

select * from tblstores order by tblstores.idStore desc;

delete from tblstores where idStore = 1;

update tblstores set nome = '16 Quatras', celular = '(31)98401-9379', endereco = 'Avenida do Contorno, 6061', foto = 'no-image.jpg' where idStore = 1;

select * from tblstores where idStore = 1;

select * from tblstores where tblstores.statusLoja = 1;

desc tblcontacts;

select * from tblcontacts;

 select * from tblcontacts order by idContact desc;

alter table tblcontacts add column statusContact boolean;

update tblcontacts set statusContact = '0' where idContact = '1';

select * from tblcontacts order by tblcontacts.idContact desc;

delete from tblcontacts;
