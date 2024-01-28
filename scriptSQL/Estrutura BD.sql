create database dblojaroupas;

show databases;

use dblojaroupas;

create table tblcontatos (
	idContato int not null auto_increment primary key,
	nome varchar(80) not null,
    telefone varchar(14),
    celular varchar(15) not null,
    email varchar(48) not null,
	facebook varchar(250),
    sugestaoCritica int(2) not null, 
    mensagem text,
    profissao varchar(50) not null,
    homePage varchar(250),
    sexo varchar(1) not null
);

show tables;

desc tblcontatos;

insert into tblcontatos (nome, telefone, celular, email, facebook, sugestaoCritica, mensagem, profissao, homePage, sexo, statusContato)
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

select * from tblcontatos;

 select * from tblcontatos order by idContato desc;

alter table tblcontatos add column statusContato boolean;

update tblcontatos set statusContato = '0' where idContato = '1';


select * from tblcontatos order by tblcontatos.idContato desc;

delete from tblcontatos;







