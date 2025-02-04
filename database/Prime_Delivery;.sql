-- ==============================================
-- 📌 CRIAÇÃO DO BANCO DE DADOS
-- ==============================================
CREATE DATABASE prime_delivery
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

USE prime_delivery;

-- ==============================================
-- 📌 TABELA CLIENTE
-- ==============================================
CREATE TABLE Cliente (
    ID_Cliente INT NOT NULL AUTO_INCREMENT, -- ID único para cada cliente
    Nome_Cliente VARCHAR(90) NOT NULL,      -- Nome do cliente
    Senha_Cliente VARCHAR(255) NOT NULL,    -- Senha do cliente (armazenada de forma segura com hash)
    Endereco_Cliente VARCHAR(90) NOT NULL,  -- Endereço do cliente
    Celular VARCHAR(20) NOT NULL UNIQUE,    -- Celular único para cada cliente
    PRIMARY KEY (ID_Cliente)                -- Chave primária
);

-- ✅ Índice para acelerar buscas pelo nome do cliente
CREATE INDEX idx_nome_cliente ON Cliente (Nome_Cliente);

DESC Cliente;

-- ==============================================
-- 📌 TABELA PEDIDOS
-- ==============================================
CREATE TABLE Pedidos (
    ID_pedidos INT NOT NULL AUTO_INCREMENT, -- ID único para cada pedido
    Data_pedido DATETIME NOT NULL,          -- Data e hora do pedido
    fk_Cliente_ID_Cliente INT NOT NULL,     -- Referência ao cliente que fez o pedido
    PRIMARY KEY (ID_pedidos),               -- Chave primária

    -- 🔗 Chave estrangeira vinculando cada pedido a um cliente
    CONSTRAINT FK_Pedidos_Cliente
        FOREIGN KEY (fk_Cliente_ID_Cliente)
        REFERENCES Cliente (ID_Cliente)
        ON DELETE CASCADE  -- Se um cliente for excluído, seus pedidos também serão removidos
);

-- ✅ Índice para melhorar a velocidade de consultas pelo cliente nos pedidos
CREATE INDEX idx_fk_cliente_pedidos ON Pedidos (fk_Cliente_ID_Cliente);

DESC Pedidos;

-- ==============================================
-- 📌 TABELA PRODUTOS
-- ==============================================
CREATE TABLE Produtos (
    ID_Produto INT NOT NULL AUTO_INCREMENT,  -- ID único para cada produto
    Preco_Produto DECIMAL(10,2) NOT NULL,    -- Preço do produto (10 dígitos no total, 2 decimais)
    Descricao_Produto TEXT,                  -- Descrição do produto
    Imagem LONGBLOB,                         -- imagem do produto
    Tipo_Imagem VARCHAR(50),                 -- Tipo da imagem
    Nome_Produto VARCHAR(90) NOT NULL UNIQUE,-- Nome do produto (deve ser único)
    PRIMARY KEY (ID_Produto)                 -- Chave primária
);

-- ✅ Índice para melhorar a busca por nome do produto
CREATE INDEX idx_nome_produto ON Produtos (Nome_Produto);

DESC Produtos;

-- ==============================================
-- 📌 TABELA CONTEM (Relaciona Pedidos e Produtos)
-- ==============================================
CREATE TABLE Contem (
    Valor_Total DECIMAL(10,2) NOT NULL,     -- Valor total do item do pedido (quantidade * preço unitário)
    fk_produtos_ID_Produto INT NOT NULL,    -- Referência ao produto
    fk_Pedidos_ID_pedidos INT NOT NULL,     -- Referência ao pedido
    PRIMARY KEY (fk_produtos_ID_Produto, fk_Pedidos_ID_pedidos), -- Chave primária composta

    -- 🔗 Chave estrangeira vinculando cada item a um produto
    CONSTRAINT FK_Contem_Produto
        FOREIGN KEY (fk_produtos_ID_Produto)
        REFERENCES Produtos (ID_Produto)
        ON DELETE CASCADE,                  -- Se um produto for excluído, os registros relacionados também serão

    -- 🔗 Chave estrangeira vinculando cada item a um pedido
    CONSTRAINT FK_Contem_Pedido
        FOREIGN KEY (fk_Pedidos_ID_pedidos)
        REFERENCES Pedidos (ID_pedidos)
        ON DELETE CASCADE                   -- Se um pedido for excluído, os registros relacionados também serão removidos
);

-- ✅ Índices para melhorar buscas nas relações entre pedidos e produtos
CREATE INDEX idx_fk_pedido_contem ON Contem (fk_Pedidos_ID_pedidos);
CREATE INDEX idx_fk_produto_contem ON Contem (fk_produtos_ID_Produto);

DESC Contem;


