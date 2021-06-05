<?php

use frontend\helpers\WordHelper;

/**
 * @var DateInterval $dateInterval
 */
?>

<?php if ($dateInterval->y): ?>
    <?= $dateInterval->y; ?>  <?= WordHelper::pluralForm($dateInterval->y, 'год', 'года', 'лет'); ?> <span>назад</span>
<?php endif; ?>
<?php if ($dateInterval->m): ?>
    <?= $dateInterval->m; ?>  <?= WordHelper::pluralForm($dateInterval->m, 'месяц', 'месяца', 'месяцев') . ' '; ?> <span>назад</span>
<?php endif; ?>
<?php if ($dateInterval->d): ?>
    <?= $dateInterval->d; ?>  <?= WordHelper::pluralForm($dateInterval->d, 'день', 'дня', 'дней') . ' '; ?> <span>назад</span>
<?php endif; ?>
<?php if ($dateInterval->h): ?>
    <?= $dateInterval->h; ?>  <?= WordHelper::pluralForm($dateInterval->h, 'час', 'часа', 'часов'); ?> <span>назад</span>
<?php endif; ?>
