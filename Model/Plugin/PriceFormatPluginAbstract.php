<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model\Plugin;

use Lillik\PriceDecimal\Model\ConfigInterface;
use Lillik\PriceDecimal\Model\PricePrecisionConfigTrait;

abstract class PriceFormatPluginAbstract
{

    use PricePrecisionConfigTrait;

    /** @var ConfigInterface  */
    protected $moduleConfig;

    /**
     * @param \Lillik\PriceDecimal\Model\ConfigInterface $moduleConfig
     */
    public function __construct(
        ConfigInterface $moduleConfig
    ) {
        $this->moduleConfig  = $moduleConfig;
    }
}
