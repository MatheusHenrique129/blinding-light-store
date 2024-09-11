<?php

function uploadImage($objFile)
{
    if ($objFile['size'] > 0 && $objFile['type'] != "") {
        $directoryFiles = "../../files/";
        $filesAllowed = array("image/jpeg", "image/jpg", "image/png", "image/gif");

        $sizeMaxFile = 5120;
        $fileUpload = $objFile;

        $pathTemp = $fileUpload['tmp_name'];
        $fileSize = round($fileUpload['size'] / 1024);
        $fileExtension = $fileUpload['type'];

        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileSize <= $sizeMaxFile) {
                $filename = pathinfo($fileUpload['name'], PATHINFO_FILENAME);
                $ext = pathinfo($fileUpload['name'], PATHINFO_EXTENSION);

                $filenameCripty = md5($filename . uniqid(time()));

                $image = $filenameCripty . "." . $ext;

                if (move_uploaded_file($pathTemp, $directoryFiles . $image))
                    $statusUploadFile = true;
                else
                    $statusUploadFile = false;
            } else {
                echo ("
                    <script> 
                        alert('" . TAMANHO_ARQUIVO . " " . $sizeMaxFile . "Kb');
                        location.href = '../../cms/nossasLojas.php';
                        window.history.back();
                    </script>
                ");
            }
        } else {
            echo ("
                <script> 
                    alert('" . EXTENSAO_NAO_PERMITIDA . "');
                    location.href = '../../cms/nossasLojas.php';
                    window.history.back();
                </script>
            ");
        }
    }

    if ($statusUploadFile)
        return $image;

    return "no-image.jpg";
}
