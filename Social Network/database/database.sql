
CREATE TABLE user (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	firstName VARCHAR,
	lastName VARCHAR,
	email VARCHAR UNIQUE,
	password VARCHAR
);



INSERT INTO user VALUES (NULL, 'Abel', 'Tiago', 'abelito@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Pedro', 'Fraga', 'antoniopedrofraga@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Filipa', 'Barroso', 'pipinha@gmail.com', '1234');


CREATE TABLE event (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR,
	type VARCHAR,
	user INTEGER
);


INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 1', 'party', 1);

INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 2', 'concert', 2);

INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 3', 'conference', 3);