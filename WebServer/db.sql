create database if not exists card_game;

CREATE USER if not exists 'kmospan' @'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'kmospan' @'localhost';

use card_game;
create table if not exists users (
    id int primary key not null AUTO_INCREMENT,
    username varchar(16) not null unique,
    email varchar(128) not null unique,
    password varchar(64) not null
);

create table if not exists cards (
    id int primary key not null AUTO_INCREMENT,
    name varchar(16) not null unique,
    damage int not null,
    img text not null,
    type enum("healer", "dps")
);

create table if not exists games (
    id int primary key not null AUTO_INCREMENT,
    user1_id int not null unique,
    user2_id int not null unique,
    FOREIGN KEY (user1_id) REFERENCES users(id),
    FOREIGN KEY (user2_id) REFERENCES users(id)
);