show databases

create database sanya


use sanya

show tables



CREATE TABLE IF NOT EXISTS game(
    id INT AUTO_INCREMENT,
    s_name TEXT,
    s_description TEXT,
    i_publisher_id INT,
    d_published_date DATE,
    i_series_id INT,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS genre(
    id INT AUTO_INCREMENT,
    s_name TEXT,
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS genre_to_game(
    id INT AUTO_INCREMENT,
    i_game_id INT,
    i_genre_id INT,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS publisher(
    id INT AUTO_INCREMENT,
    s_name TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS review(
    id INT AUTO_INCREMENT,
    i_game_id INT,
    s_comment TEXT,
    i_mark INT,
    d_first_played DATE,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS series(
    id INT AUTO_INCREMENT,
    s_name TEXT,
    PRIMARY KEY (id)
);

ALTER TABLE game ADD COLUMN i_series_id INT

insert into game (s_name, s_description, i_publisher_id, d_published_date, i_series_id) values ('metro last lights', 'hz kto', 4, '10.10.2007', 3);

insert into genre (s_name) values ('strategy')

insert into series (s_name) values ('stalker')

select * from series

insert into publisher (s_name) values ('Mojang')

select * from publisher;
select * from game;

insert into genre_to_game (i_game_id, i_genre_id) values (1, 1);
insert into genre_to_game (i_game_id, i_genre_id) values (2, 1);
insert into genre_to_game (i_game_id, i_genre_id) values (3, 1);
insert into genre_to_game (i_game_id, i_genre_id) values (4, 2);
insert into genre_to_game (i_game_id, i_genre_id) values (4, 7);

select * from genre_to_game

select * from game
select * from review

insert into genre_to_game (i_game_id, i_genre_id) VALUES (7, 1);

insert into review (i_game_id, s_comment, i_mark, d_first_played) VALUES (7, 'very difficult', 3, '3.11.2018');
insert into review (i_game_id, s_comment, i_mark, d_first_played) VALUES (3, 'baggy game', 2, '14.10.2019');
insert into review (i_game_id, s_comment, i_mark, d_first_played) VALUES (4, 'too many cheaters', 3, '5.10.2019');

select * from review

# ==================================================
select id, s_name, d_published_date from game where (select count(*) from review where (i_game_id = game.id)) = 0; # игры, на которые ещё нет отзывов
# ==================================================

insert into game (s_name, s_description, i_publisher_id, d_published_date) values ('stalker', 'walking in Chernobyl', 4, '4.5.2011')

select * from genre where s_name = 'rpg';
select i_game_id from genre_to_game where i_genre_id in (select id from genre where s_name = 'strelyalka');

# ==================================================
select *
from game inner join review on game.id = review.i_game_id
where game.id in(
                 select i_game_id from genre_to_game where i_genre_id in (
                     select id from genre where s_name = 'strelyalka'
))
order by review.i_mark desc limit 3;
# ==================================================

select * from genre
select * from publisher

# ==================================================
select series.s_name, count(*) from game inner join series on game.i_series_id = series.id where i_publisher_id in (select id from publisher where publisher.s_name = 'valve') group by game.i_series_id;
# ==================================================

select * from game where i_publisher_id in (select id from publisher where publisher.s_name = 'valve');

select * from publisher
select * from game
insert into game (s_name, s_description, i_publisher_id, d_published_date) values ('minecraft', '', 5, '4.5.2011')
