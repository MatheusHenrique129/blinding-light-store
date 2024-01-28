<?php 
    
if(isset($_GET['modo']))
{
    if(strtoupper($_GET['modo']) == 'STATUS')
    {
        if(isset($_GET['id']) && $_GET['id'] != "")
        {
            
         //###################### INICIO DA EXCLUSÃO DO REGISTRO #####################################  
            require_once('../../modulos/config.php');

            require_once('../conexaoMysql.php');

            if(!$conex = conexaoMysql())
            {
                echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            }
            
            $idContato = $_GET['id'];
            
            if($_GET['status'] == 0)
                $statusContato = 1;
            else
                $statusContato = 0;
            

            $sql = "update tblcontatos set statusContato = '".$statusContato."'
                    where idContato = " . $idContato;

            if (mysqli_query($conex, $sql))
            {
                echo("
                        <script>
                            alert('Status alterado com sucesso!');
                            location.href = '../../CMS/index.php';
                        </script>
                ");

            }
            else
                echo("
                        <script>
                            alert('Erro ao atualizar o status no Banco de Dados!');

                            window.history.back();
                        </script>

                    ");
            
            //###################### FIM DA EXCLUSÃO DO REGISTRO #####################################
            
        }else 
            echo("
            <script>
                alert('Nenhum registro foi informado para realizar a exclusão');
                location.href = '../../CMS/index.php';
            </script>
    
        ");
        
    }else 
        echo("
            <script>
                alert('Requisição inválida para excluir um registro!');
                location.href = '../../CMS/index.php';
            </script>
    
        ");
    
}else 
    echo("
            <script>
                alert('Acesso inválido para esse arquivo!');
                location.href = '../../CMS/index.php';
            </script>
    
        ");


?>
