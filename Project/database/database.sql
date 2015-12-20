
CREATE TABLE user (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	firstName VARCHAR,
	lastName VARCHAR,
	photoPath VARCHAR,
	email VARCHAR UNIQUE,
	password TEXT
);

INSERT INTO user VALUES (NULL, 'Abel', 'Tiago', 'vileda.jpg', 'abelito@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Pedro', 'Fraga', 'fraga.jpg', 'antoniopedrofraga@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Filipa', 'Barroso', 'jules.jpg', 'pipinha@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Luisa', 'Silva', 'luisa.jpg', 'luisa@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Joana', 'Pereira', 'joana.jpg', 'joana@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Jose', 'Camacho', 'ze.jpg', 'ze@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Joao', 'Martins', 'joao.jpg', 'joao@gmail.com', '1234');


CREATE TABLE event (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR,
	description VARCHAR,
	type VARCHAR,
	photoPath VARCHAR,
	createDate DATE,
	eventDate DATE
);


INSERT INTO event VALUES (NULL, 'Partyyyy' ,'A description 1', 'Party', "default-party.png" ,"2015-11-25 23:30:00", "2020-12-31 23:30:00");

INSERT INTO event VALUES (NULL, 'U2 Concert', 'A description 2', 'Concert', "default-concert.png" ,"2015-11-23 23:30:00", "2020-12-31 23:30:00");

INSERT INTO event VALUES (NULL, 'Mourinho speech', 'A description 3', 'Conference', "default-conference.png" ,"2015-12-21 23:30:00", "2020-11-31 23:30:00");

INSERT INTO event VALUES (NULL, 'Group work','A description 3', 'Reunion', "default-reunion.png" ,"2015-11-19 23:30:00", "2020-12-31 23:30:00");

INSERT INTO event VALUES (NULL, 'Run','A description 0', 'Sports', "default-sports.png" ,"2015-11-19 23:30:00", "2020-12-31 23:30:00");

CREATE TABLE attendance (
	email VARCHAR,
	eventId INTEGER,
	UNIQUE(email, eventId)
);

INSERT INTO attendance VALUES ('antoniopedrofraga@gmail.com', 1);
INSERT INTO attendance VALUES ('ze@gmail.com', 1);
INSERT INTO attendance VALUES ('luisa@gmail.com', 1);
INSERT INTO attendance VALUES ('abelito@gmail.com', 1);
INSERT INTO attendance VALUES ('joao@gmail.com', 1);
INSERT INTO attendance VALUES ('joana@gmail.com', 1);

INSERT INTO attendance VALUES ('antoniopedrofraga@gmail.com', 2);
INSERT INTO attendance VALUES ('ze@gmail.com', 2);
INSERT INTO attendance VALUES ('luisa@gmail.com', 2);
INSERT INTO attendance VALUES ('joao@gmail.com', 2);
INSERT INTO attendance VALUES ('joana@gmail.com', 2);
INSERT INTO attendance VALUES ('pipinha@gmail.com', 2);


INSERT INTO attendance VALUES ('ze@gmail.com', 4);
INSERT INTO attendance VALUES ('luisa@gmail.com', 4);
INSERT INTO attendance VALUES ('pipinha@gmail.com', 4);
INSERT INTO attendance VALUES ('joao@gmail.com', 4);
INSERT INTO attendance VALUES ('joana@gmail.com', 4);
INSERT INTO attendance VALUES ('abelito@gmail.com', 4);

INSERT INTO attendance VALUES ('ze@gmail.com', 3);
INSERT INTO attendance VALUES ('luisa@gmail.com', 3);
INSERT INTO attendance VALUES ('pipinha@gmail.com', 3);
INSERT INTO attendance VALUES ('joao@gmail.com', 3);
INSERT INTO attendance VALUES ('joana@gmail.com', 3);
INSERT INTO attendance VALUES ('abelito@gmail.com',3);


CREATE TABLE comment (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	email VARCHAR,
	eventId INTEGER,
	commentText VARCHAR
);


INSERT INTO comment VALUES (NULL, 'antoniopedrofraga@gmail.com', 1, 'Great, can not wait!');
INSERT INTO comment VALUES (NULL, 'antoniopedrofraga@gmail.com', 1, 'Best event ever!');
INSERT INTO comment VALUES (NULL, 'joana@gmail.com', 1, 'Niiiice!');
INSERT INTO comment VALUES (NULL, 'ze@gmail.com', 1, 'Good party!');


INSERT INTO comment VALUES (NULL, 'luisa@gmail.com', 2, 'Nice music...');
INSERT INTO comment VALUES (NULL, 'joao@gmail.com', 2, 'OMG, a U2 concert!');

INSERT INTO comment VALUES (NULL, 'pipinha@gmail.com', 3, 'Mourinho is the best manager in the world.');
INSERT INTO comment VALUES (NULL, 'abelito@gmail.com', 3, 'Chelsea it is not so great.');


INSERT INTO comment VALUES (NULL, 'luisa@gmail.com', 4, 'We need to work Pedro!');
INSERT INTO comment VALUES (NULL, 'ze@gmail.com', 4, 'This work it is not easy..');
INSERT INTO comment VALUES (NULL, 'joana@gmail.com', 4, 'I forgot :(');



CREATE TABLE owner (
	email VARCHAR,
	eventId INTEGER,
	UNIQUE(email, eventId)
);


INSERT INTO owner VALUES ('antoniopedrofraga@gmail.com', 3);
INSERT INTO owner VALUES ('antoniopedrofraga@gmail.com', 4);
INSERT INTO owner VALUES ('pipinha@gmail.com', 1);
INSERT INTO owner VALUES ('abelito@gmail.com', 2);
INSERT INTO owner VALUES ('pipinha@gmail.com', 5);

