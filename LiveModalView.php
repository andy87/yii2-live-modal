<?php

namespace andy87\yii2\live_modal;

use andy87\base\LiveModal;

/**
 * Class LiveModalView
 *
 * Пример того какие классы можно создавать, чтобы использовать компонент LiveModal
 */
class LiveModalView extends LiveModal
{
    protected string $containerId = 'liveModalViewContainer';

    protected string $containerTemplate = '@app/views/modal/liveModalViewContainer.php';
}