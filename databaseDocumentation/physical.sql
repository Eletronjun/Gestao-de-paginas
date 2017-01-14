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

CREATE TABLE MEMBERS
(
	email VARCHAR(150) NOT NULL,
	registration VARCHAR(10),
	member_name VARCHAR(100) NOT NULL,
    sex VARCHAR(1) NOT NULL,
	nick VARCHAR(30) NOT NULL,
	password VARCHAR(61) NOT NULL,
	birthDate DATE NOT NULL,
	rg VARCHAR(30) NOT NULL,
	cpf VARCHAR(15) NOT NULL,
	phone VARCHAR(15) NOT NULL,
	course ENUM('Engenharia Eletrônica','Engenharia de Software',
		'Engenharia de Energia','Engenharia Automotiva','Engenharia Aeroespacial', 'Outros') NULL,
	period INT NULL,
	address VARCHAR(500) NOT NULL,
	code_directorate INT,
	code_office INT NOT NULL,
	isActivity ENUM('n','y') NOT NULL DEFAULT 'n', /* To account actived, use 'y' or 'n' to inative. */
	image VARCHAR(150) NOT NULL DEFAULT 'default.png', /* Save file locate. */

	PRIMARY KEY members_pk (email),

	CONSTRAINT UNIQUE email_uk(email),
    CONSTRAINT UNIQUE cpf_uk(cpf),

	FOREIGN KEY members_directorate_fk (code_directorate) REFERENCES DIRECTORATE(code) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY members_office_fk (code_office) REFERENCES OFFICE(code) ON UPDATE RESTRICT ON DELETE RESTRICT

) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE CATEGORY
(
	code INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	layout ENUM("publication", "short_publication", "video", "form") NOT NULL DEFAULT "publication",
	description VARCHAR(500) NOT NULL,
	isActivity ENUM(  "y",  "n" ) NOT NULL DEFAULT  'y',

	PRIMARY KEY members_pk (code)

) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE WEB_PAGE(
	code INT AUTO_INCREMENT ,
	title VARCHAR( 100 ) NOT NULL ,
	author VARCHAR( 100 ) NOT NULL ,
	code_category INT NOT NULL ,
	creation_date DATETIME NOT NULL,
	last_modified DATETIME NOT NULL,
	isActivity ENUM(  "y",  "n" ) NOT NULL DEFAULT  'y',
	content VARCHAR(5000) NULL,
	reference VARCHAR(300) NULL,
	image VARCHAR(200) NULL,
	form VARCHAR(300) NULL,
	video VARCHAR(300) NULL,

    PRIMARY KEY web_page_pk (code),
    FOREIGN KEY web_category_fk (code_category) REFERENCES CATEGORY(code) ON UPDATE CASCADE ON DELETE CASCADE

) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO OFFICE (office) VALUES ('Presidente Organizacional');
INSERT INTO OFFICE (office) VALUES ('Presidente Institucional');
INSERT INTO OFFICE (office) VALUES ('Diretor');
INSERT INTO OFFICE (office) VALUES ('Gerente');
INSERT INTO OFFICE (office) VALUES ('Assessor');
INSERT INTO OFFICE (office) VALUES ('Trainee');
INSERT INTO OFFICE (office) VALUES ('Colaborador');

INSERT INTO DIRECTORATE (directorate) VALUES ('Administrativo e Financeiro');
INSERT INTO DIRECTORATE (directorate) VALUES ('Gestão de Pessoas e Processos');
INSERT INTO DIRECTORATE (directorate) VALUES ('Marketing');
INSERT INTO DIRECTORATE (directorate) VALUES ('Gestão de Projetos');
INSERT INTO DIRECTORATE (directorate) VALUES ('Presidência');

/*usuário inicial padrão*/
/*password is 1234*/
INSERT INTO `eletronjun_db`.`MEMBERS` 
(`email`, `registration`, `member_name`, `sex`, `nick`, `password`, `birthDate`, `rg`, 
	`cpf`, `phone`, `course`, `period`, `address`, `code_address`, `code_directorate`, 
	`code_office`, `isActivity`, `image`) 
VALUES 
('marketing@eletronjun.com.br', '14/0066543', 'Eletronjun - Engenharia Eletrônica Júnior', 
	'M', 'eletronjun', '$2a$05$JD2WU824jsfhs23hu233D.0EbJKRpRMa8cI/4dKusO.yCyTiHuqvO', 
	'2013-01-01', ' ', '42341155847', '(99)99999-9999', 'Engenharia Eletrônica', '10', 
	'Unb-Gama', '1', '2', '5', 'y', 'default.png');