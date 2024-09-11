create database db_blindingLight_store;

show databases;
use db_blindingLight_store;

create table tblcontatos (
	idContato int not null auto_increment primary key,
	nome varchar(80) not null,
    telefone varchar(14),
    celular varchar(15) not null,
    email varchar(48) not null,
	facebook varchar(250),
    sugestaoCritica varchar(1) not null, 
    mensagem text,
    profissao varchar(50) not null,
    homePage varchar(250),
    sexo varchar(1) not null,
    statusContato int(2) not null
);

show tables;
desc tblcontatos;

insert into tblcontatos (nome, telefone, celular, email, facebook, sugestaoCritica, mensagem, profissao, homePage, sexo, statusContato)
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

select * from tblcontatos where idContato = '3';

update tblcontatos set 
        nome = 'Amanda',
        telefone = '(11)5555-2456',
        celular = '(19)95812-0158',
        email = 'ale@senaisp.edu.br',
        facebook = 'https://martechtoday.com',
        sugestaoCritica = 'C',
        mensagem = 'teste update',
        profissao = 'DEV´s',
        homePage = 'https://martechtoday.com',
        sexo = 'F' where idContato = '1';

create table tblusuarios (
	idUsuario int not null auto_increment primary key,
    nome varchar(70) not null,
    sexo varchar(1) not null,
    dataNascimento date not null,
    email varchar(48) not null,
    senha varchar(15) not null,
    statusUsuario int(1) 
);

desc tblusuarios;

insert into tblusuarios (nome, sexo, dataNascimento, email, senha, statusUsuario)
values('Lucas',
'M',
'2000-05-15',
'michael@gmail.com',
'123',
1);

delete from tblusuarios  where idUsuario = 2;

select * from tblusuarios where idUsuario = 2;

#Deleta a tabela desejada
drop table tblstores;

select * from tblusuarios order by tblusuarios.idUsuario desc;

update tblusuarios set 
        nome = 'Reginaldo Alves',
        sexo = 'M',
        dataNascimento = '1975-05-19',
        email = 'mad@gmail.com'
       
	    where idUsuario = 1;
        

create table tblgenero (
	idGeneros int not null auto_increment primary key,
    genero int
);

desc tblgenero;

insert into tblusuarios 
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
                'Cleitinho',
                'F',
                '1958',
                'cleitinhocheirosa@gmail.com',
                '656565gnio',
                1);
