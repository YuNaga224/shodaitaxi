create database shodaitaxi;

create user 'shodaitaxi_dev'@'localhost' identified by 'shodai1121';
grant all on shodaitaxi.* to 'shodaitaxi_dev'@'localhost';

create table users(
    id varchar(20) primary key,
    pwd varchar(60) not null,
    nickname varchar(10) not null,
    relate_carpool varchar(20) not null default 'none',
    user_num int(1) not null default 0
);

create table carpool(
    id int(10) auto_increment not null primary key,
    rep_id varchar(20) not null,
    user_1 varchar(10) not null default 'EHG23hNRVe',
    user_2 varchar(10) not null default 'EHG23hNRVe',
    user_3 varchar(10) not null default 'EHG23hNRVe',
    user_4 varchar(10) not null default 'EHG23hNRVe',
    selected_date varchar(50) not null,
    release_flg int(1) not null default 0,
    selected_jr varchar(50) not null
);

create table chat(
    id int(10) primary key auto_increment,
    carpool_id int(10) not null,
    nickname varchar(10) not null,
    body varchar(50) not null
);