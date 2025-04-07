<?php

namespace andy87\yii2\live_modal\base;

use andy87\yii2\live_modal\assets\LiveModalAsset;
use Yii;
use andy87\yii2\live_modal\service\LiveModalService;

/**
 * < Frontend > `LiveModal`
 *
 * @package yii2\frontend\components\modal\live
 *
 * @tag: #frontend #component #modal #live
 */
abstract class LiveModal extends LiveModalRoot
{
    /** @var string куда вставить контент */
    protected const PARAM_CONTAINER_ID = 'liveModalCommonContainerId';
    protected const PARAMS_CONTAINER_TEMPLATE = 'liveModalCommonContainerTemplate';

    /** @var string */
    protected const BUTTON_OPTIONS = [
        'class' => 'btn btn-success btn-sm',
    ];



    /** @var string  */
    protected string $requestId;



    /**
     * @param string $requestId
     * @param string $endpoint
     */
    public function __construct( string $requestId, string $endpoint )
    {
        $this->requestId = $requestId;

        $this->endpoint = $endpoint;

        $this->jsLibrary = LiveModalAsset::PARAM_JS_LIBRARY;
    }


    /**
     * @param string $requestId
     * @param string $btnText
     * @param string $endpoint
     * @param ?string $containerId
     * @param ?array $btnOptions
     *
     * @return string
     */
    public static function constructButton( string $requestId, string $btnText, string $endpoint, ?string $containerId = null, ?array $btnOptions = null ): string
    {
        $containerId = $containerId ?? Yii::$app->params[static::PARAM_CONTAINER_ID];

        $btnOptions = LiveModalService::constructButtonOptions( $requestId, $btnOptions ?? static::BUTTON_OPTIONS );

        $libraryData = LiveModalService::constructLibraryData( $endpoint, $containerId, [ 'request_id' => $requestId ]);

        $libraryData['request_id'] = $requestId;

        return LiveModalService::displayButton( $requestId, $libraryData, $btnText, $btnOptions );
    }

    /**
     * @param ?string $containerId
     * @param ?string $template
     * @param array $paramsWidgetModal
     *
     * @return string
     */
    public static function constructContainer( ?string $containerId = null, ?string $template = null, array $paramsWidgetModal = [] ): string
    {
        $template = $template ?? Yii::$app->params[ self::PARAMS_CONTAINER_TEMPLATE ];

        $containerId = $containerId ?? Yii::$app->params[ static::PARAM_CONTAINER_ID ];

        return LiveModalService::getContainerHtml( $template, $containerId, $paramsWidgetModal );
    }

    /**
     * @param array $params
     * @param array $options
     *
     * @return static
     */
    public static function getInstance(array $params, array $options = [] ): static
    {
        $className = static::class;

        $liveModal = new $className( ...array_values($params) );

        foreach ($options as $key => $value) {
            $liveModal->$key = $value;
        }

        return $liveModal;
    }


    /**
     * @param string $btnText
     * @param ?array $btnOptions
     * @param ?string $containerId
     *
     * @return string
     */
    public function displayButton( string $btnText, ?array $btnOptions = null, ?string $containerId = null ): string
    {
        if ($containerId) $this->containerId = $containerId;

        $libraryData = $this->getLibraryData( $this->endpoint, $this->containerId );

        $libraryData['request_id'] = $this->requestId;

        $btnOptions = LiveModalService::constructButtonOptions( $this->requestId, $btnOptions ?? static::BUTTON_OPTIONS );

        return LiveModalService::displayButton($this->requestId, $libraryData, $btnText, $btnOptions );
    }

    /**
     * @param string $endpoint
     * @param string $containerId
     *
     * @return array
     */
    protected function getLibraryData( string $endpoint, string $containerId ): array
    {
        $data = $this->getRequestData();

        return LiveModalService::constructLibraryData($endpoint, $containerId, $data);
    }

    /**
     * @return array
     */
    protected function getRequestData(): array
    {
        return [ 'request_id' => $this->requestId ];
    }

    /**
     * @param array $paramsWidgetModal
     * @param ?string $template
     *
     * @return string
     */
    public function displayContainer( array $paramsWidgetModal = [], ?string $template = null ): string
    {
        $template = $template ?? $this->containerTemplate ?? Yii::$app->params[ self::PARAMS_CONTAINER_TEMPLATE ];

        return LiveModalService::getContainerHtml( $template, $this->requestId, $paramsWidgetModal );
    }
}