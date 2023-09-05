<?php

// Incluir a conexão com banco de dados
include_once "./conexao.php";

// Carrega o arquivo com XML e transforma o arquivo XML em Objeto
$xml = simplexml_load_file('arquivo.xml');

// Cria o laço de repetição para ler os registros do XML
foreach($xml->usuario as $registro):

    // Imprimi os valores do XML com PHP
    echo "Nome: " . $registro->nome . "<br>";
    echo "E-mail: " . $registro->email . "<br>";

    // Cria a QUERY para cadastrar no banco de dados com PHP e PDO
    $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";

    // Prepara a QUERY com PDO
    $cad_usuario = $conn->prepare($query_usuario);

    // Substitui o link da QUERY pelo valor utilizando bindParam
    $cad_usuario->bindParam(':nome', $registro->nome);
    $cad_usuario->bindParam(':email', $registro->email);

    // Executa a QUERY com PHP e PDO
    $cad_usuario->execute();

    // Verifica com PHP se cadastrou no banco de dados
    if($cad_usuario->rowCount()){
        echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
    }else{
        echo "<p style='color: #f00;'>Erro: Usuário não cadastrado.</p>";
    }

    // Imprimi o traço com HTML e PHP
    echo "<hr>";
endforeach;