<?php

namespace andy87\yii2\live_modal\service;

use andy87\yii2\live_modal\assets\LiveModalAsset;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use andy87\yii2\live_modal\models\dto\ConfigWidgetModal;

/**
 * Class LiveModalService
 *
 * @package yii2\frontend\components\liveModal\service
 */
class LiveModalService
{
    /**
     * @param string $template
     * @param string $containerId
     * @param array $paramsWidgetModal
     *
     * @return string
     */
    public static function getContainerHtml( string $template, string $containerId, array $paramsWidgetModal ): string
    {
        $configWidgetModal = new ConfigWidgetModal();

        if (count($paramsWidgetModal)) {
            foreach ($paramsWidgetModal as $key => $value) {
                $configWidgetModal->$key = $value;
            }
        }

        $configWidgetModal->id = $containerId;

        return self::renderContainerHtml( $template, $configWidgetModal );
    }

    /**
     * @param string $template
     * @param ConfigWidgetModal $configWidgetModal
     *
     * @return string
     */
    protected static function renderContainerHtml( string $template, ConfigWidgetModal $configWidgetModal ): string
    {
        return Yii::$app->view->renderFile( $template, $configWidgetModal->release() );
    }


    /**
     * @param string $endpoint
     * @param string $containerId
     * @param ?array $data
     *
     * @return array
     */
    public static function constructLibraryData( string $endpoint, string $containerId, ?array $data = null ): array
    {
        $library = [
            'endpoint' => $endpoint,
            'container' => $containerId,
        ];

        if ($data) $library['data'] = $data;

        return $library;
    }



    /**
     * @param string $requestId
     * @param ?array $btnOptions
     *
     * @return array
     */
    public static function constructButtonOptions( string $requestId, ?array $btnOptions = null): array
    {
        return array_merge($btnOptions, [
            'data-live-modal' => $requestId
        ]);
    }

    /**
     * @param string $jsLibrary
     * @param string $requestId
     * @param array $requestData
     *
     * @return void
     */
    public static function registerJs( string $requestId, array $requestData ): void
    {
        $jsLibrary = LiveModalAsset::PARAM_JS_LIBRARY;

        $json = Json::htmlEncode($requestData);

        Yii::$app->view->registerJs( "window.{$jsLibrary}['$requestId'] = $json;" );
    }


    /**
     * @param string $jsLibrary
     * @param string $requestId
     * @param array $libraryData
     * @param string $btnText
     * @param array $btnOptions
     *
     * @return string
     */
    public static function displayButton( string $requestId, array $libraryData, string $btnText, array $btnOptions = [] ): string
    {
        LiveModalService::registerJs( $requestId, $libraryData );

        return Html::button( $btnText, $btnOptions );
    }
}