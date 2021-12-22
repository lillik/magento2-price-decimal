<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model;

trait PricePrecisionConfigTrait
{


    /**
     * @return \Lillik\PriceDecimal\Model\ConfigInterface
     */
    public function getConfig()
    {
        return $this->moduleConfig;
    }

    /**
     * @return int|mixed
     */
    public function getPricePrecision()
    {
        if ($this->getConfig()->canShowPriceDecimal()) {
            return $this->getConfig()->getPricePrecision();
        }

        return 0;
    }

    /**
     * @return int|mixed
     */
    public function getPricePrecisionCurrency()
    {
        if (!$this->getConfig()->canShowPriceDecimal()) {
            return 0;
        }

        if (!$this->getConfig()->getDifferentForCurrency()) {
            return $this->getConfig()->getPricePrecision();
        }

        return $this->getConfig()->getPricePrecisionCurrency();
    }
}
