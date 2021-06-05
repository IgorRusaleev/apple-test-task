<?php

namespace frontend\widgets;

use DateTime;
use frontend\models\Apple;
use yii\base\Widget;

class EstimatedTimeWidget extends Widget
{
    /** @var string */
    public string $timestamp;

    public function run()
    {
        $currentTimeStamp = new DateTime();
        $diffTimeStamp = new DateTime($this->timestamp);
        $dateInterval = $currentTimeStamp->diff($diffTimeStamp);

        return $this->render('estimated-time-widget-view', ['dateInterval' => $dateInterval]);
    }
}