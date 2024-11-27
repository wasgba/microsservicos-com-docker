<?php
include 'conexao.php';

// Exibir todos os produtos cadastrados
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["produtoID"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . number_format($row["preco"], 2, ',', '.') . "</td>
                <td>" . $row["quantidade"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhum produto encontrado.</p>";
}

$conn->close();
?>
