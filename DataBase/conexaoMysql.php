<?php
/*****************************************************************
*
    OBJETIVO: Configuração para conectar no Banco de Dados MySQL     
    AUTOR: Matheus Henrique                                   
    DATA: 20/10/2020 
    
******************************************************************/

function conexaoMysql()
{
    //Variaveis para a conexão com o BD
    $server = (string) "localhost";
    $user = (string) "root";
    $password = (string) ""; // Your Password
    $dataBase = (string) "dblojasroupas";
    
    //Cria conexão com o BD MySQL
    if ($conexao = @mysqli_connect($server, $user, $password, $dataBase))
        return $conexao;
    else
        return false;
}

?>
