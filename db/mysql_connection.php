<?php

/******************************************************************
    OBJETIVO: Configuração para conectar no Banco de Dados MySQL     
    AUTOR: Matheus Henrique                                   
    DATA: 20/10/2020 
 ******************************************************************/

function mysqlConnection()
{
    //Variaveis para a conexão com o BD
    $server = (string) "localhost";
    $user = (string) "root";
    $password = (string) ""; // Your Password
    $database = (string) "db_blindingLight_store";

    //Cria conexão com o BD MySQL
    if ($connection = @mysqli_connect($server, $user, $password, $database))
        return $connection;

    return false;
}
