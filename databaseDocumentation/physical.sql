DROP DATABASE IF EXISTS eletronjun_db;
CREATE DATABASE eletronjun_db;

USE eletronjun_db;

CREATE USER 'tp'@'localhost' IDENTIFIED BY "1234";
GRANT ALL PRIVILEGES ON *.* TO  'tp'@'localhost';

CREATE TABLE OFFICE
(
	code INT NOT NULL AUTO_INCREMENT,
	office VARCHAR(15) NOT NULL,
	PRIMARY KEY office_pk (code)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE DIRECTORATE
(
	code INT NOT NULL AUTO_INCREMENT,
	directorate VARCHAR(50) NOT NULL,
	PRIMARY KEY directorate_pk (code)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE ADDRESS
(
	code INT NOT NULL AUTO_INCREMENT,
	cep VARCHAR(10) NOT NULL,
	address VARCHAR(100) NOT NULL,
    neighborhood VARCHAR(30),
    residence VARCHAR(6) NOT NULL,
	city  VARCHAR(50) NOT NULL,
	state  VARCHAR(2) NOT NULL,
	complement  VARCHAR(50) NULL,
	PRIMARY KEY address_pk (code)
	
) ENGINE=InnoDB CHARSET=utf8;


CREATE TABLE MEMBERS
(
	email VARCHAR(150) NOT NULL,
	registration VARCHAR(10),
	member_name VARCHAR(100) NOT NULL,
    sex VARCHAR(1) NOT NULL,
	nick VARCHAR(30) NOT NULL,
	password VARCHAR(61) NOT NULL,
	birthDate DATE NOT NULL,
	rg VARCHAR(9) NOT NULL,
    rg_agency VARCHAR(8) NOT NULL,
	cpf VARCHAR(15) NOT NULL,
	phone VARCHAR(15) NOT NULL,
	code_address INT NOT NULL,
	code_directorate INT,
	code_office INT NOT NULL,
	isActivity ENUM('n','y') NOT NULL DEFAULT 'n', /* To account actived, use 'y' or 'n' to inative. */
	image VARCHAR(150) NOT NULL DEFAULT 'default.png', /* Save file locate. */

	PRIMARY KEY members_pk (email),
    
	CONSTRAINT UNIQUE email_uk(email),
    CONSTRAINT UNIQUE cpf_uk(cpf),
    
	FOREIGN KEY members_address_fk (code_address) REFERENCES ADDRESS(code) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY members_directorate_fk (code_directorate) REFERENCES DIRECTORATE(code) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY members_office_fk (code_office) REFERENCES OFFICE(code) ON UPDATE RESTRICT ON DELETE RESTRICT
	
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE CATEGORY
(
	code INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	
	PRIMARY KEY members_pk (code)

) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE WEB_PAGE(
	code INT AUTO_INCREMENT ,
	title VARCHAR( 100 ) NOT NULL ,
	author VARCHAR( 100 ) NOT NULL ,
	code_category INT NOT NULL ,
	creation_date DATETIME NOT NULL,
	last_modified DATETIME NOT NULL,
	content VARCHAR(5000) NULL,

    PRIMARY KEY web_page_pk (code),
    FOREIGN KEY web_category_fk (code_category) REFERENCES CATEGORY(code) ON UPDATE RESTRICT ON DELETE RESTRICT

) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO OFFICE (office) VALUES ('Presidente');
INSERT INTO OFFICE (office) VALUES ('Diretor');
INSERT INTO OFFICE (office) VALUES ('Gerente');
INSERT INTO OFFICE (office) VALUES ('Assessor');
INSERT INTO OFFICE (office) VALUES ('Trainee');
INSERT INTO OFFICE (office) VALUES ('Colaborador');

INSERT INTO DIRECTORATE (directorate) VALUES ('Administrativo e Financeiro');
INSERT INTO DIRECTORATE (directorate) VALUES ('Gestão de Pessoas e Processos');
INSERT INTO DIRECTORATE (directorate) VALUES ('Marketing');
INSERT INTO DIRECTORATE (directorate) VALUES ('Gestão de Projetos');

/*usuário inicial padrão*/
INSERT INTO ADDRESS (cep, address, neighborhood, residence, city, state, complement)
	VALUES('72450-100',	'Q10', 'Gama Oeste','Lote 09', 'Gama', 'DF','apto 102');
/*password is 1234*/
INSERT INTO MEMBERS (email, registration, member_name, sex, nick, password, birthDate, rg, 
	rg_agency, cpf, phone, code_address, code_directorate,code_office,isActivity) VALUES
	('marketing@eletronjun.com.br', '14/0066543', 'Eletronjun', ' ', 'eletronjun','$2a$05$JD2WU824jsfhs23hu233D.0EbJKRpRMa8cI/4dKusO.yCyTiHuqvO',
		'2013-01-01','', '', '', '', 1, 3, 1,'y');
