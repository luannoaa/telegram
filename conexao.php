<?php
$link = mysqli_connect('localhost:3307', 'root', 'master');
if (!$link) {
    die('Não foi possível conectar: ' . mysqli_error());
}
echo 'Conexão bem sucedida';
mysqli_close($link);
?>