<?php

include "../functions.php";
include "conexao.php";

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

    $valorobra = $_GET['valorobra'];

    if($valorobra == 1){
        cadastroSerie();
    }

    if($valorobra == 2){
        cadastroFilme();
    }

    if($valorobra == 3){
        cadastroNovela();
    }

    if($valorobra == 4){
        cadastroLivro();
    }

    emailUsuario();
    
    ?>

