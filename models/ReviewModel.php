<?php
// IDE почему-то не дала назвать мне модель просто Review
namespace Models;

use DBConnection;

// модель оказывается нужно еще загружать класслоадером
// эта модель нигде не используется
class ReviewModel
{
    public static function getReviews(int $offset) : array {
        $db = new DBConnection();
        $sql = <<< END
            select review.id       as review_id,
            review.create_datetime as review_create_datetime,
            review.trailer_link    as review_trailer_link,
            review.poster_blob     as review_poster_blob,
            review.header          as review_header,
            review.content         as review_content,
            user.login             as user_login
            from review
                left join user on review.user_id = user.id
            where review.id <= $offset
            order by review.id desc
            limit 10
        END;
        return $db->query($sql);
    }
}