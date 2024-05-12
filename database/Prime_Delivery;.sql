create database prime_delivery
default character set utf8
default collate utf8_general_ci;

use prime_delivery;

CREATE TABLE Cliente (
    ID_Cliente int NOT NULL auto_increment,
    Nome_Cliente varchar(90) NOT NULL,
    Senha_Cliente varchar(90) unique NOT NULL,
    Endereco_Cliente varchar(90) NOT NULL,
    Celular varchar(20 ) NOT NULL ,
    PRIMARY KEY(ID_Cliente)
)default charset = utf8;
desc Cliente;

CREATE TABLE Pedidos (
    ID_pedidos int NOT NULL auto_increment,
    Data_pedido date NOT NULL,
    fk_Cliente_ID_Cliente int,
    primary key(ID_pedidos)
)default charset = utf8;
desc Pedidos;

CREATE TABLE produtos (
   ID_Produto int NOT NULL AUTO_INCREMENT,
   Preco_Produto decimal(10,2) NOT NULL,
   Descricao_Produto text,
   Imagem_Path varchar(255) DEFAULT NULL,
   Nome_Produto varchar(90) NOT NULL,
  PRIMARY KEY (ID_Produto)
) DEFAULT CHARSET=utf8mb4;
desc Produtos;

CREATE TABLE Contem (
    Valor_Total decimal(6,3) NOT NULL,
    fk_produtos_ID_Produto int,
    fk_Pedidos_ID_pedidos int
)default charset = utf8;
desc Contem; 
ALTER TABLE Pedidos ADD CONSTRAINT FK_Pedidos_2
    FOREIGN KEY (fk_Cliente_ID_Cliente)
    REFERENCES Cliente (ID_Cliente)
    ON DELETE RESTRICT;
 
ALTER TABLE Contem ADD CONSTRAINT FK_Contem_1
    FOREIGN KEY (fk_produtos_ID_Produto)
    REFERENCES produtos (ID_Produto)
    ON DELETE RESTRICT;
 
ALTER TABLE Contem ADD CONSTRAINT FK_Contem_2
    FOREIGN KEY (fk_Pedidos_ID_pedidos)
    REFERENCES Pedidos (ID_pedidos)
    ON DELETE SET NULL;
