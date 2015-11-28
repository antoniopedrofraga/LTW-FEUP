
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
	user INTEGER,
	createDate DATE,
	eventDate DATE
);


INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 1', 'Party', 1, "2015-11-25 23:30:00", "2015-11-31 23:30:00");

INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 2', 'Concert', 2, "2015-11-23 23:30:00", "2015-11-31 23:30:00");

INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 3', 'Conference', 3, "2015-11-21 23:30:00", "2015-11-31 23:30:00");

INSERT INTO event VALUES (NULL, 'Uma descrição qualquer 3', 'Reunion', 2, "2015-11-19 23:30:00", "2015-11-31 23:30:00");