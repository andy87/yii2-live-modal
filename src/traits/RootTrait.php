<?php

namespace andy87\yii2\live_modal\traits;

/**
 * Trait RootTrait
 */
trait RootTrait
{
    /**
     * @param string $endpoint
     *
     * @return $this
     */
    public function setEndpoint( string $endpoint ): static
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @param string $containerId
     *
     * @return $this
     */
    public function setContainerId( string $containerId ): static
    {
        $this->containerId = $containerId;

        return $this;
    }

    /**
     * @param string $containerTemplate
     *
     * @return $this
     */
    public function setContainerTemplate( string $containerTemplate ): static
    {
        $this->containerTemplate = $containerTemplate;

        return $this;
    }

    /**
     * @param string $jsLibrary
     *
     * @return $this
     */
    public function setJsLibrary( string $jsLibrary ): static
    {
        $this->jsLibrary = $jsLibrary;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getEndpoint(): ?string
    {
        return $this?->endpoint;
    }

    /**
     * @return ?string
     */
    public function getContainerId(): ?string
    {
        return $this?->containerId;
    }

    /**
     * @return ?string
     */
    public function getContainerTemplate(): ?string
    {
        return $this?->containerTemplate;
    }

    /**
     * @return ?string
     */
    public function getJsLibrary(): ?string
    {
        return $this?->jsLibrary;
    }
}