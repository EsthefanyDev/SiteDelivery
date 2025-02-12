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
    ID_Cliente INT NOT NULL AUTO_INCREMENT,
    Nome_Cliente VARCHAR(90) NOT NULL,
    Senha_Cliente VARCHAR(255) NOT NULL,
    Endereco_Cliente VARCHAR(90) NOT NULL,
    Celular VARCHAR(20) NOT NULL UNIQUE,
    PRIMARY KEY (ID_Cliente)
);

CREATE INDEX idx_nome_cliente ON Cliente (Nome_Cliente);

-- ==============================================
-- 📌 TABELA PEDIDOS
-- ==============================================
CREATE TABLE Pedidos (
    ID_pedidos INT NOT NULL AUTO_INCREMENT,
    Data_pedido DATETIME NOT NULL,
    fk_Cliente_ID_Cliente INT NOT NULL,
    PRIMARY KEY (ID_pedidos),
    CONSTRAINT FK_Pedidos_Cliente
        FOREIGN KEY (fk_Cliente_ID_Cliente)
        REFERENCES Cliente (ID_Cliente)
        ON DELETE CASCADE
);

CREATE INDEX idx_fk_cliente_pedidos ON Pedidos (fk_Cliente_ID_Cliente);

-- ==============================================
-- 📌 TABELA CATEGORIAS
-- ==============================================
CREATE TABLE Categorias (
    ID_Categoria INT NOT NULL AUTO_INCREMENT,
    Nome_Categoria VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (ID_Categoria)
);

INSERT INTO Categorias (Nome_Categoria) VALUES
('Pizzas'),
('Hambúrgueres'),
('Acompanhamentos'),
('Bebidas');
('Combos');

CREATE INDEX idx_nome_categoria ON Categorias (Nome_Categoria);

-- ==============================================
-- 📌 TABELA PRODUTOS
-- ==============================================
CREATE TABLE Produtos (
    ID_Produto INT NOT NULL AUTO_INCREMENT,
    Nome_Produto VARCHAR(90) NOT NULL UNIQUE,
    fk_Categoria_ID_Categoria INT NOT NULL,
    Preco_Produto DECIMAL(10,2) NOT NULL,
    Descricao_Produto TEXT,
    Imagem LONGBLOB,
    Tipo_Imagem VARCHAR(50),
    PRIMARY KEY (ID_Produto),
    CONSTRAINT FK_Produtos_Categoria
        FOREIGN KEY (fk_Categoria_ID_Categoria)
        REFERENCES Categorias (ID_Categoria)
        ON DELETE CASCADE
);

CREATE INDEX idx_nome_produto ON Produtos (Nome_Produto);

-- ==============================================
-- 📌 TABELA CONTEM
-- ==============================================
CREATE TABLE Contem (
    Valor_Total DECIMAL(10,2) NOT NULL,
    fk_produtos_ID_Produto INT NOT NULL,
    fk_Pedidos_ID_pedidos INT NOT NULL,
    PRIMARY KEY (fk_produtos_ID_Produto, fk_Pedidos_ID_pedidos),
    CONSTRAINT FK_Contem_Produto
        FOREIGN KEY (fk_produtos_ID_Produto)
        REFERENCES Produtos (ID_Produto)
        ON DELETE CASCADE,
    CONSTRAINT FK_Contem_Pedido
        FOREIGN KEY (fk_Pedidos_ID_pedidos)
        REFERENCES Pedidos (ID_pedidos)
        ON DELETE CASCADE
);

CREATE INDEX idx_fk_pedido_contem ON Contem (fk_Pedidos_ID_pedidos);
CREATE INDEX idx_fk_produto_contem ON Contem (fk_produtos_ID_Produto);