<?php

namespace andy87\yii2\live_modal\collection;

use Yii;
use Exception;
use andy87\yii2\live_modal\base\LiveModal;
use andy87\yii2\live_modal\base\LiveModalRoot;

/**
 * Class LiveModalGroup
 *
 * @package yii2\frontend\components\liveModal\collection
 */
class LiveModalCollection extends LiveModalRoot
{
    /** @var LiveModalGroup[]|array  */
    protected array $listLiveModalGroup;



    /**
     * @param LiveModalGroup[]|array $listLiveModalGroup
     * @param string $endpoint
     * @param string $containerId
     * @param string $containerTemplate
     */
    public function __construct( array $listLiveModalGroup, string $endpoint, string $containerId, string $containerTemplate )
    {
        $this->listLiveModalGroup = $listLiveModalGroup;

        $this->endpoint = $endpoint;

        $this->containerId = $containerId ?? Yii::$app->params[LiveModal::PARAM_CONTAINER_ID] ?? LiveModal::COMMON_CONTAINER_ID;

        $this->containerTemplate = $containerTemplate ?? Yii::$app->params[LiveModal::PARAMS_CONTAINER_TEMPLATE] ?? LiveModal::TEMPLATE_CONTAINER;
    }

    /**
     * @return LiveModalGroup[]
     */
    public function getListLiveModalGroup(): array
    {
        return $this->listLiveModalGroup;
    }

    /**
     * @param string $requestId
     * @param string $btnText
     * @param ?string $containerId
     * @param ?string $endpoint
     * @param ?array $btnOptions
     *
     * @return string
     *
     * @throws Exception
     */
    public function displayButton( string $requestId, string $btnText = 'Открыть', ?string $containerId = null, ?string $endpoint = null, ?array $btnOptions = null ): string
    {
        if ( $endpoint ) $this->endpoint = $endpoint;

        if ( $containerId ) $this->containerId = $containerId;

        $liveModal = $this->findModalByRequestId( $requestId, $containerId, $endpoint );

        return $liveModal->displayButton( $btnText, $btnOptions, $containerId );
    }

    /**
     * @throws Exception
     */
    public function findModalByRequestId( string $requestId, ?string $containerId = null, ?string $endpoint = null ): LiveModal
    {
        foreach ( $this->listLiveModalGroup as $liveModalGroup )
        {
            foreach ( $liveModalGroup->getListLiveModalGroup() as $request_id => $className )
            {
                if ( $request_id === $requestId )
                {
                    $containerTemplate = $containerId ?? $liveModalGroup->getContainerId() ?? $this->containerId;

                    $endpoint = $endpoint ?? $liveModalGroup->getEndpoint() ?? $this->endpoint;

                    return $className::getInstance([ $requestId, $endpoint, $containerTemplate ]);
                }
            }
        }

        throw new Exception('Request ID not found');
    }

    /**
     * @param string $groupId
     * @param array $paramsWidgetModal
     *
     * @return string
     */
    public function displayContainer( string $groupId, array $paramsWidgetModal = [] ): string
    {
        $containerId = $this->listLiveModalGroup[$groupId]->getContainerId() ?? $this->containerId;

        $containerTemplate = $this->listLiveModalGroup[$groupId]->getContainerTemplate() ?? $this->containerTemplate;

        return LiveModal::constructContainer( $containerId, $containerTemplate, $paramsWidgetModal );
    }
}