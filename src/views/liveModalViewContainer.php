<?php

use andy87\models\dto\ConfigWidgetModal;
use yii\bootstrap5\Modal;
use yii2\common\components\View;

/**
 * @var View $this
 *
 * @var ConfigWidgetModal $configWidgetModal
 */

$modal = Modal::begin([
    'id' => $configWidgetModal->id,
    'title' => $configWidgetModal->title,
    'size' => $configWidgetModal->size,
]);

    // Динамически загружаемый контент из endpoint'а: /api/modal/get-html-create

$modal->end();