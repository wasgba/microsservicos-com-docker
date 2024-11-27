<?php
include 'conexao.php';

// Recebe os dados do formulário
$nome = $_POST['nome'];
$marca = $_POST['fabricante'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];

// Inserir no banco de dados - Tabela de Produtos
$sql_produto = "INSERT INTO produtos (nome, descricao, preco) 
                VALUES ('$nome', '$marca', '$preco')";

if ($conn->query($sql_produto) === TRUE) {
    // Obter o ID do produto recém inserido
    $produtoID = $conn->insert_id;

    // Inserir na tabela de Estoque
    $sql_estoque = "INSERT INTO estoque (produtoID, quantidade) 
                    VALUES ('$produtoID', '$quantidade')";

    if ($conn->query($sql_estoque) === TRUE) {
        echo "Novo produto cadastrado com sucesso, e estoque atualizado!";
    } else {
        echo "Erro ao inserir no estoque: " . $conn->error;
    }
} else {
    echo "Erro ao inserir produto: " . $conn->error;
}

$conn->close();
?>

