<?php 

function uploadFoto($objFile)
{
    if($objFile['size'] > 0 && $objFile['type']!="")
    {
        $diretorioArquivos = "../../arquivos/";

        $arquivosPermitidos = array("image/jpeg","image/jpg","image/png");

        $tamanhoMaxArquivo = 5120;

        $arquivoUpload = $objFile;

        $caminhoTemp = $arquivoUpload['tmp_name'];

        $tamanhoArquivo = round($arquivoUpload['size']/1024);

        $extensaoArquivo = $arquivoUpload['type'];

        if(in_array($extensaoArquivo, $arquivosPermitidos))
        {
            if($tamanhoArquivo <= $tamanhoMaxArquivo)
            {
                $nomeArquivo = pathinfo($arquivoUpload['name'], PATHINFO_FILENAME);

                $ext = pathinfo($arquivoUpload['name'], PATHINFO_EXTENSION);

                $nomeArquivoCripty = md5($nomeArquivo.uniqid(time()));

                $foto = $nomeArquivoCripty.".".$ext;

                if(move_uploaded_file($caminhoTemp, $diretorioArquivos.$foto))
                    $statusUploadArquivo = true;
                else
                    $statusUploadArquivo = false;

            }
            else
            {
                echo("
                <script> 
                    alert('".TAMANHO_ARQUIVO." ".$tamanhoMaxArquivo."Kb');
                    location.href = '../../CMS/nossasLojas.php';
                    window.history.back();
                </script>
                ");  
            }
        }

        else
        {
            echo("
                <script> 
                    alert('".EXTENSAO_NAO_PERMITIDA."');
                    location.href = '../../CMS/nossasLojas.php';
                    window.history.back();
                </script>
            ");
        }

    }
    
    if ($statusUploadArquivo)
        return $foto;
    else
        return "semFoto.jpg";
}


?>