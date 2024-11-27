-- Criação da tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    produtoID INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL
);

-- Criação da tabela de estoque
CREATE TABLE IF NOT EXISTS estoque (
    estoqueID INT AUTO_INCREMENT PRIMARY KEY,
    produtoID INT,
    quantidade INT NOT NULL,
    FOREIGN KEY (produtoID) REFERENCES produtos(produtoID) ON DELETE CASCADE
);

-- Criação da tabela de vendas
CREATE TABLE IF NOT EXISTS vendas (
    vendaID INT AUTO_INCREMENT PRIMARY KEY,
    produtoID INT,
    quantidade INT NOT NULL,
    FOREIGN KEY (produtoID) REFERENCES produtos(produtoID) ON DELETE CASCADE
);

-- Criar a tabela de usuários, caso não exista
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
);

-- Inserir os usuários no banco de dados com senhas criptografadas
INSERT INTO usuarios (username, password, role)
VALUES 
    ('wasgba', '$2y$10$e3B1Y9u1C2Q8Jlz5gP2j6u5R1ocd8Sz5gGG47XTOs8hNqpOmI/cxu', 'admin'),
    ('usuario1', '$2y$10$2MxP6A7phkTbADPe7fnoKf0GxIv3Dwn6XkUEP9bskt1jT5tuKpkGq', 'cliente'),
    ('usuario2', '$2y$10$6h5nR3Vb0bBGWSkMxeA4ZC65TO5LnxOw.k39b6G5rkAczZAs7mxTq', 'vendedor'),
    ('dono', '$2y$10$Ks0ZRrgjzbfA11BqQ3JjA6lX6MQ.DfZJ2pfjZvqUm9Nf6EImwrwqW', 'dono');

-- Inserir alguns produtos na tabela de produtos
INSERT INTO produtos (nome, descricao, preco) 
VALUES 
    ('Produto 1', 'Descrição do Produto 1', 10.00),
    ('Produto 2', 'Descrição do Produto 2', 20.00),
    ('Produto 3', 'Descrição do Produto 3', 30.00),
    ('Produto 4', 'Descrição do Produto 4', 40.00);
