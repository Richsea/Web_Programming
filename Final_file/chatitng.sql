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


