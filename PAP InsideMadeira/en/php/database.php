<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "insidemadeira";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
die("Falha na conexao: " . mysqli_connect_error());
}else{
//echo "Conexao realizada com sucesso";
}

?>