<?php
include 'conexao.php';

// Recebe os dados da venda do formulário
$produto_id = $_POST['produto_id'];
$quantidade = $_POST['quantidade'];
$data_venda = date('Y-m-d H:i:s');

// Verifica se o produto existe e obtém suas informações
$sql_produto = "SELECT preco, quantidade FROM produtos WHERE produtoID = '$produto_id'";
$result_produto = $conn->query($sql_produto);

if ($result_produto->num_rows > 0) {
    $produto = $result_produto->fetch_assoc();
    $preco_unitario = $produto['preco'];
    $estoque_atual = $produto['quantidade'];

    // Verifica se há estoque suficiente
    if ($estoque_atual >= $quantidade) {
        // Insere a venda no banco de dados
        $sql_venda = "INSERT INTO vendas (produtoID, quantidade, preco_unitario, data_venda) 
                      VALUES ('$produto_id', '$quantidade', '$preco_unitario', '$data_venda')";

        // Atualiza a quantidade de produtos no estoque
        $sql_update = "UPDATE produtos SET quantidade = quantidade - '$quantidade' WHERE produtoID = '$produto_id'";

        // Executa as consultas
        if ($conn->query($sql_venda) === TRUE && $conn->query($sql_update) === TRUE) {
            echo "Venda registrada com sucesso!";
        } else {
            echo "Erro ao registrar venda: " . $conn->error;
        }
    } else {
        echo "Estoque insuficiente. Apenas $estoque_atual unidade(s) disponível(is).";
    }
} else {
    echo "Produto não encontrado.";
}

$conn->close();
?>
