<?php declare(strict_types=1);

namespace andy87\yii2\live_modal\assets;

use Yii;
use yii\web\View;
use yii\web\AssetBundle;

/**
 * < Frontend > `AppAsset`
 *
 *      Main frontend application asset bundle.
 *
 * @package yii2\frontend\assets
 *
 * @tag #assets #app
 */
class LiveModalAsset extends AssetBundle
{
    /** @var string Название переменной в JS, где хранятся данные кнопок, открывающих модальные окна */
    public const PARAM_JS_LIBRARY = 'liveModalLibraryData';

    public const PARAM_JS_HANDLERS = 'liveModalLibraryHandlers';


    /** @var int  */
    public const POSITION =  View::POS_HEAD;


    /** @var ?string Переопределение registerJs POSITION через `container` -> `definition` */
    public ?string $position = null;


    public $sourcePath = __DIR__ . '/dist';



    public $css = [ 'css/live-modal.css' ];

    public $js = [ 'js/live-modal.js' ];


    public $jsOptions = [
        'position' => View::POS_END
    ];


    /** @var AssetBundle[]|array Зависимости */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];


    /**
     * Инициализация
     *
     * @return void
     */
    public function init(): void
    {
        parent::init();

        $this->registerJsDependence();
    }

    /**
     * @return void
     */
    private function registerJsDependence(): void
    {
        $this->creteBoilerplateJsObject( self::PARAM_JS_LIBRARY );

        $this->creteBoilerplateJsObject( self::PARAM_JS_HANDLERS );
    }

    /**
     * @param string $name
     *
     * @return void
     */
    private function creteBoilerplateJsObject( string $name ): void
    {
        Yii::$app->view->registerJs( "window.$name = {};", self::POSITION );

    }
}
