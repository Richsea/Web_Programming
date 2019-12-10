CREATE DATABASE CHATTING;

CREATE TABLE MEMBERS(
	member_id char(10) not null,
    member_pw char(15) not null,
    admin_check bool default false,
    constraint id_pk primary key (member_id)
);
