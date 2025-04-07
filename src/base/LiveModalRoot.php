<?php

namespace andy87\yii2\live_modal\base;

use andy87\yii2\live_modal\assets\LiveModalAsset;
use andy87\yii2\live_modal\traits\RootTrait;

/**
 * Class LiveModalRoot
 *
 * @package yii2\frontend\components\liveModal\base
 */
class LiveModalRoot
{
    use RootTrait;

    protected string $endpoint;

    protected string $containerId;

    protected string $containerTemplate;

    protected string $jsLibrary = LiveModalAsset::PARAM_JS_LIBRARY;
}