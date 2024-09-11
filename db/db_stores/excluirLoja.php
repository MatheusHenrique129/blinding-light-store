<?php

if (isset($_GET['modo'])) {
    if (strtoupper($_GET['modo']) == 'EXCLUIR') {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            require_once('../../modules/config.php');

            require_once('../mysql_connection.php');

            if (!$conex = mysqlConnection()) {
                echo ("<script> alert('" . ERRO_CONEX_BD_MYSQL . "'); </script>");
            }

            $idStore = $_GET['id'];

            $sql = "delete from tblstores 
                    where idStore = " . $idStore;

            //Executa no BD o Script SQL
            if (mysqli_query($conex, $sql)) {
                $nomeFoto = $_GET['foto'];

                if ($nomeFoto != "no-image.jpg")
                    unlink('../../arquivos/' . $nomeFoto);

                echo ("
                        <script>
                            alert('" . REGITRO_EXCLUIDO_SUCESSO . "');
                            location.href = '../../cms/nossasLojas.php';
                        </script>
                ");
            } else
                echo ("
                        <script>
                            alert('" . ERRO_EXCLUIR_DADOS . "');
                            window.history.back();
                        </script>

                    ");
        } else
            echo ("
            <script>
                alert('" . NENHUM_REGISTRO_INFORMADO . "');
                location.href = '../../cms/nossasLojas.php';
            </script>
    
        ");
    } else
        echo ("
            <script>
                alert('" . REQUISI_INVALIDA . "');
                location.href = '../../cms/nossasLojas.php';
            </script>
    
        ");
} else
    echo ("
            <script>
                alert('" . ACESSO_INVALIDO . "');
                location.href = '../../cms/nossasLojas.php';
            </script>
    
        ");
