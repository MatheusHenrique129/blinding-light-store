<?php

if (isset($_GET['modo'])) {
    if (strtoupper($_GET['modo']) == 'STATUS') {
        if (isset($_GET['id']) && $_GET['id'] != "") {

            //###################### INICIO DA EXCLUSÃO DO REGISTRO #####################################  
            require_once('../../modules/config.php');

            require_once('../mysql_connection.php');

            if (!$conex = mysqlConnection()) {
                echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
            }

            $idStore = $_GET['id'];

            if ($_GET['status'] == 0)
                $statusLoja = 1;
            else
                $statusLoja = 0;


            $sql = "update tblstores set statusLoja = '" . $statusLoja . "'
                    where idStore = " . $idStore;

            if (mysqli_query($conex, $sql)) {
                echo ("
                        <script>
                            alert('Status alterado com sucesso!');
                            location.href = '../../cms/nossasLojas.php';
                        </script>
                ");
            } else
                echo ("
                        <script>
                            alert('Erro ao atualizar o status no Banco de Dados!');

                            window.history.back();
                        </script>

                    ");

            //###################### FIM DA EXCLUSÃO DO REGISTRO #####################################

        } else
            echo ("
            <script>
                alert('Nenhum registro foi informado para realizar a exclusão');
                location.href = '../../cms/nossasLojas.php';
            </script>
    
        ");
    } else
        echo ("
            <script>
                alert('Requisição inválida para excluir um registro!');
                location.href = '../../cms/nossasLojas.php';
            </script>
    
        ");
} else
    echo ("
            <script>
                alert('Acesso inválido para esse arquivo!');
                location.href = '../../cms/nossasLojas.php';
            </script>
    
        ");
