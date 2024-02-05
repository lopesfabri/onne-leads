<?php 

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'registos_leads';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName); //object format

    //Check if the database connection is correct
    // if ($conexao->connect_errno) {
    //     echo "Erro";
    // } else {
    //     echo "Conexão efetuada com sucesso";
    // }

    //$conexao->close();
?>