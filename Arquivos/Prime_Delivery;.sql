create database prime_delivery
default character set utf8mb4
default collate utf8mb4_general_ci;

use prime_delivery;

CREATE TABLE Cliente (
    ID_Cliente int NOT NULL auto_increment, /*auto_increment ADD um ID automaticamente */
    Nome_Cliente varchar(90) NOT NULL,/* NOT NULL diz que essa area não pode ficar fazia */
    Senha_Cliente varchar(90) unique NOT NULL,/*unique diz que não pode haver dois dados iquais */
    Endereco_Cliente varchar(100) NOT NULL,/*varchar permite o armazenamento de textos de comprimentos diferentes em relaão ao espaço total*/
    Celular varchar(20 ) NOT NULL ,
    PRIMARY KEY(ID_Cliente)
)default charset = utf8mb4;/*Permite a entrada de caracteres especiais*/
desc Cliente;

CREATE TABLE Pedidos (
	ID_pedidos int NOT NULL auto_increment,
    Data_pedido TIMESTAMP DEFAULT now() NOT NULL ,/*Permite colocar a data e a hora atual*/
    fk_Cliente_ID_Cliente int,
    primary key(ID_pedidos)
)default charset = utf8mb4;
desc Pedidos;

CREATE TABLE produtos (
    ID_Produto int NOT NULL auto_increment,
    Preco_Produto decimal(10,2) NOT NULL,/*Permite o armazenamento de numeros com ponto flutuante de até 10 carcts com 2 casas decimais*/
    Nome_Produto varchar(90) NOT NULL,
    PRIMARY KEY(ID_Produto)
)default charset = utf8mb4;
desc Produtos;

CREATE TABLE Contem (
    Valor_Total decimal(10,2) NOT NULL,
    fk_produtos_ID_Produto int,
    fk_Pedidos_ID_pedidos int
)default charset = utf8mb4;
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
    
