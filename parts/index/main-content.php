<?php
require $_SERVER['DOCUMENT_ROOT'] . '/components/DB.php';
?>
<main class="main-content">
    <?php
    // количество выведенных обзоров
    $offset = 10;

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
            limit 10;
        END;
    $reviews = $db->fetchAll($sql);
    ?>
    <?php foreach ($reviews as $review): ?>
        <div class="card">
            <a class="card__link" href="/layouts/detail_review.php?id=<?= $review['review_id'] ?>">
                <img src="data:image/jpeg;base64, <?= base64_encode($review['review_poster_blob']) ?>"
                     class="img-<?= $review['review_id'] ?>"
                     alt="Нет фото"/>
                <div class="card__info">
                    <span class="card__name"><?= $review['review_header'] ?></span>
                    <div class="card__second-row">
                            <span class="card__upload-date">
                                <?= date('d M Y', strtotime($review['review_create_datetime'])) ?>
                            </span>
                        <span class="card__author"><?= $review['user_login'] ?></span>
                    </div>

                </div>
            </a>
        </div>
    <?php endforeach; ?>
</main>