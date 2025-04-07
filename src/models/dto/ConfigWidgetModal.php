<?php

namespace andy87\yii2\live_modal\models\dto;

/**
 * < Frontend > `ConfigWidgetModal`
 *
 * @package yii2\frontend\components\liveModal\models\dto
 *
 * @tag: #frontend #component #live #modal #dto
 */
class ConfigWidgetModal
{
    /** @var string */
    public string $id;

    /**
     * @param string $title
     * @param string $size
     */
    public function __construct( public string $title = '', public string $size = '' )
    {

    }

    /**
     * @return array
     */
    public function release(): array
    {
        return [
            'configWidgetModal' => $this
        ];
    }
}