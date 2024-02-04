CREATE DATABASE farmaciasistema;

USE farmaciasistema;


CREATE TABLE tipo_us (
  id_tipo_us int(11) NOT NULL AUTO_INCREMENT,
  nome_tipo varchar(45) NOT NULL,
  PRIMARY KEY(id_tipo_us)
)DEFAULT CHARSET=utf8;




CREATE TABLE usuario (
  id_usuario int(11) NOT NULL AUTO_INCREMENT,
  nome_us varchar(45)NOT NULL,
  apelido_us varchar(45)NOT  NULL,
  idade varchar(45)NOT  NULL,
  dni_us varchar(45)NOT  NULL,
  senha_us varchar(45)NOT  NULL,
  telefone_us int(11)  NULL,
  endereco_us varchar(45)  NULL,
  correio_us varchar(25)  NULL,
  genero_us varchar(25)  NULL,
  adicional_us varchar(500) NULL,
  avatar varchar(255),
  us_tipo int(11),
  PRIMARY KEY(id_usuario),
  FOREIGN KEY (us_tipo) REFERENCES tipo_us (id_tipo_us)
)DEFAULT CHARSET=utf8;




CREATE TABLE tipo_produto (
  id_tipo_produto int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(45)  NULL,
  PRIMARY KEY(id_tipo_produto)
)DEFAULT CHARSET=utf8;




CREATE TABLE laboratorio (
  id_laboratorio int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(45) NULL,
  PRIMARY KEY(id_laboratorio)
)DEFAULT CHARSET=utf8;




CREATE TABLE fornecedor (
  id_fornecedor int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(45) NULL,
  telefone int(11) NULL,
  correio varchar(45) NULL,
  endereco varchar(45) NULL,
  PRIMARY KEY(id_fornecedor)
)DEFAULT CHARSET=utf8;



CREATE TABLE apresentacao (
  id_apresentacao int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(45) NULL,
  PRIMARY KEY(id_apresentacao)
)DEFAULT CHARSET=utf8;




CREATE TABLE venda_mensal (
  mensal double DEFAULT NULL
)DEFAULT CHARSET=utf8;





CREATE TABLE produto (
  id_produto int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(45) NULL,
  concentracao varchar(255) NULL,
  adicional varchar(255) NULL,
  preco float,
  prod_lab int(11),
  prod_tipo_prod int(11),
  prod_presente int(11),
  PRIMARY KEY(id_produto),
  FOREIGN KEY (prod_lab) REFERENCES laboratorio (id_laboratorio),
  FOREIGN KEY (prod_presente) REFERENCES apresentacao (id_apresentacao),
  FOREIGN KEY (prod_tipo_prod) REFERENCES tipo_produto (id_tipo_produto)
)DEFAULT CHARSET=utf8;




CREATE TABLE venda (
  id_venda int(11) NOT NULL AUTO_INCREMENT,
  data date NULL,
  cliente varchar(45) DEFAULT NULL,
  dni int(11) DEFAULT NULL,
  total float DEFAULT NULL,
  vendedor int(11),
  PRIMARY KEY(id_venda),
  FOREIGN KEY (vendedor) REFERENCES usuario (id_usuario)
)DEFAULT CHARSET=utf8;




CREATE TABLE venda_produto (
  id_venda_produto int(11)NOT NULL AUTO_INCREMENT,
  quantidade int(11) NULL,
  subtotal float NULL,
  produto_id_produto int(11) NULL,
  venda_id_venda int(11),
  PRIMARY KEY(id_venda_produto),
  FOREIGN KEY (produto_id_produto) REFERENCES produto (id_produto),
  FOREIGN KEY (venda_id_venda) REFERENCES venda (id_venda)
)DEFAULT CHARSET=utf8;


CREATE TABLE lote (
  id_lote int(11)NOT NULL AUTO_INCREMENT,
  stock int(11) NULL,
  vencimento date,
  lote_id_prod int(11),
  lote_id_forne int(11),
  PRIMARY KEY(id_lote),
  FOREIGN KEY (lote_id_forne) REFERENCES fornecedor (id_fornecedor),
  FOREIGN KEY (lote_id_prod) REFERENCES produto (id_produto)
)DEFAULT CHARSET=utf8;



CREATE TABLE detalhe_venda (
  id_detalhe int(11) NOT NULL AUTO_INCREMENT,
  det_quantidade int(11) NULL,
  det_vencimento date NULL,
  id_det_lote int(11),
  id_det_prod int(11),
  id_det_forne int(255),
  id_det_venda int(11),
  PRIMARY KEY(id_detalhe),
  FOREIGN KEY (id_det_lote) REFERENCES lote (id_lote),
  FOREIGN KEY (id_det_prod) REFERENCES produto (id_produto),
  FOREIGN KEY (id_det_forne) REFERENCES fornecedor (id_fornecedor),
  FOREIGN KEY (id_det_venda) REFERENCES venda (id_venda)
)DEFAULT CHARSET=utf8;
