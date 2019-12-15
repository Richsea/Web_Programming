CREATE DATABASE CHATTING;

CREATE TABLE MEMBERS(
	member_id char(10) not null,
    member_pw char(15) not null,
    admin_check bool default false,
    constraint id_pk primary key (member_id)
);

CREATE TABLE CHATTINGLIST(
    room_name varchar(20) not null,
    member_num int(10),
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

/* 
INSERT INTO aa values(null, 'test', 'hi');
SELECT important FROM id_CHATTINGLIST WHERE room_name = 'r_name'
UPDATE test_CHATTINGLIST SET important="1" WHERE room_name = "aa";
DELETE FROM test_chattinglist WHERE room_name = 'aa';
SELECT member_num FROM chattinglist WHERE member_num = 1 and room_name = 'aa';
*/
