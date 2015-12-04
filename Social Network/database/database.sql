
CREATE TABLE user (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	firstName VARCHAR,
	lastName VARCHAR,
	photoPath VARCHAR,
	email VARCHAR UNIQUE,
	password VARCHAR
);

INSERT INTO user VALUES (NULL, 'Abel', 'Tiago', 'default-user.png', 'abelito@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Pedro', 'Fraga', 'default-user.png', 'antoniopedrofraga@gmail.com', '1234');

INSERT INTO user VALUES (NULL, 'Filipa', 'Barroso', 'default-user.png', 'pipinha@gmail.com', '1234');


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


CREATE TABLE attendance (
	email VARCHAR,
	eventId INTEGER,
	UNIQUE(email, eventId)
);

INSERT INTO attendance VALUES ('antoniopedrofraga@gmail.com', 1);
INSERT INTO attendance VALUES ('antoniopedrofraga@gmail.com', 2);




CREATE TABLE comment (
	email VARCHAR,
	eventId INTEGER,
	commentText VARCHAR
);


INSERT INTO comment VALUES ('antoniopedrofraga@gmail.com', 1, 'Great, can not wait!');
INSERT INTO comment VALUES ('antoniopedrofraga@gmail.com', 1, 'Best event ever!');


CREATE TABLE owner (
	email VARCHAR,
	eventId INTEGER,
	UNIQUE(email, eventId)
);


INSERT INTO owner VALUES ('antoniopedrofraga@gmail.com', 1);
INSERT INTO owner VALUES ('antoniopedrofraga@gmail.com', 2);
INSERT INTO owner VALUES ('pipinha@gmail.com', 3);
INSERT INTO owner VALUES ('abelito@gmail.com', 4);

