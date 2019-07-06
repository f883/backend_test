select *
from game inner join review on game.id = review.i_game_id
where game.id in(
                 select i_game_id from genre_to_game where i_genre_id in (
                     select id from genre where s_name = 'strelyalka'
))
order by review.i_mark desc limit 3;