CREATE DATABASE CHATTING;

CREATE TABLE MEMBERS(
	member_id char(10) not null,
    member_pw char(15) not null,
    admin_check bool default false,
    constraint id_pk primary key (member_id)
);

CREATE TABLE CHATTINGLIST(
    room_name varchar(20) not null,
    PRIMARY KEY (room_name)
);


/*
CREATE TABLE room_name (
    message_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id char(10) not null,
    message TEXT,
    PRIMARY KEY (message_id)
);
*/

/*
CREATE TABLE id_CHATTINGLIST(
    room_name varchar(20) not null,
    important TINYINT(1) DEFAULT 0,
    PRIMARY KEY (room_name)
);
*/

-- INSERT INTO aa values(null, 'test', 'hi');
