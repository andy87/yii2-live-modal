<?php

namespace andy87\yii2\live_modal\collection;


use andy87\yii2\live_modal\base\LiveModal;
use andy87\yii2\live_modal\traits\RootTrait;

/**
 * Class LiveModalGroup
 */
class LiveModalGroup
{
    use RootTrait;

    /** @var LiveModal[]|array  */
    protected array $listLiveModal;

    protected ?string $endpoint = null;

    protected ?string $containerId = null;

    protected ?string $containerTemplate = null;

    protected ?string $jsLibrary = null;



    /**
     * @param LiveModal[]|array $listLiveModal
     *
     * @return void
     */
    public function __construct( array $listLiveModal )
    {
        $this->listLiveModal = $listLiveModal;
    }

    /**
     * @return LiveModal[]
     */
    public function getListLiveModalGroup(): array
    {
        return $this->listLiveModal;
    }
}