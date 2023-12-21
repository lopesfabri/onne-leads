<?php 

    $dbHost = 'https://onne-leads.netlify.app';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'onne';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName); //object format

    //Check if the database connection is correct
    // if ($conexao->connect_errno) {
    //     echo "Erro";
    // } else {
    //     echo "Conexão efetuada com sucesso";
    // }

?>