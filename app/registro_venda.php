<?php
include 'conexao.php';

// Dados da venda
$produto_id = $_POST['produto_id'];
$quantidade = $_POST['quantidade'];
$data_venda = date('Y-m-d H:i:s');

// Verifica o preço do produto a partir do banco
$sql_preco = "SELECT preco, quantidade FROM produtos WHERE produtoID = '$produto_id'";
$result_preco = $conn->query($sql_preco);

if ($result_preco->num_rows > 0) {
    $produto = $result_preco->fetch_assoc();
    $preco_unitario = $produto['preco'];
    $estoque_atual = $produto['quantidade'];

    // Verifica se há estoque suficiente
    if ($estoque_atual >= $quantidade) {
        // Inserir venda
        $sql_venda = "INSERT INTO vendas (produtoID, quantidade, preco_unitario, data_venda) 
                      VALUES ('$produto_id', '$quantidade', '$preco_unitario', '$data_venda')";

        // Atualizar quantidade do produto no estoque
        $sql_update = "UPDATE produtos SET quantidade = quantidade - '$quantidade' WHERE produtoID = '$produto_id'";

        if ($conn->query($sql_venda) === TRUE && $conn->query($sql_update) === TRUE) {
            echo "Venda registrada com sucesso!";
        } else {
            echo "Erro ao registrar venda: " . $conn->error;
        }
    } else {
        echo "Estoque insuficiente. Apenas $estoque_atual unidades disponíveis.";
    }
} else {
    echo "Produto não encontrado.";
}

$conn->close();
?>
