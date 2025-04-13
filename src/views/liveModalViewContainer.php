<?php

use yii\bootstrap5\Modal;
use yii2\common\components\View;
use andy87\models\dto\ConfigWidgetModal;
use andy87\yii2\live_modal\base\LiveModal;

/**
 * @var View $this
 *
 * @var ConfigWidgetModal $configWidgetModal
 */

$modal = Modal::begin([
    'id' => $configWidgetModal->id,
    'title' => $configWidgetModal->title,
    'size' => $configWidgetModal->size,
    'options' => [
        'class' => LiveModal::COMMON_CONTAINER_CLASS,
    ],
]);

// Динамически загружаемый контент из endpoint'а: /api/modal/get-html-create

$modal->end();