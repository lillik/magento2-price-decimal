<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config implements ConfigInterface
{

    const XML_PATH_PRICE_PRECISION
        = 'catalog_price_decimal/general/price_precision';

    const XML_PATH_CAN_SHOW_PRICE_DECIMAL
        = 'catalog_price_decimal/general/can_show_decimal';

    const XML_PATH_GENERAL_ENABLE
        = 'catalog_price_decimal/general/enable';

    const XML_PATH_DIFFERENT_CURRENCY
        = 'catalog_price_decimal/general/different';

    const XML_PATH_PRICE_PRECISION_CURRENCY
        = 'catalog_price_decimal/general/price_precision_currency';


    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {

        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function getScopeConfig()
    {
        return $this->scopeConfig;
    }

    /**
     * Return Config Value by XML Config Path
     * @param $path
     * @param $scopeType
     *
     * @return mixed
     */
    public function getValueByPath($path, $scopeType = 'website')
    {
        return $this->getScopeConfig()->getValue($path, $scopeType);
    }

    /**
     * @return mixed
     */
    public function isEnable()
    {
        return $this->getValueByPath(self::XML_PATH_GENERAL_ENABLE, 'website');
    }

    /**
     * @return mixed
     */
    public function canShowPriceDecimal()
    {
        return $this->getValueByPath(self::XML_PATH_CAN_SHOW_PRICE_DECIMAL, 'website');
    }

    /**
     * Return Price precision from store config
     *
     * @return int
     */
    public function getPricePrecision(): int
    {
        return (int) $this->getValueByPath(self::XML_PATH_PRICE_PRECISION, 'website');
    }

    /**
     * Returns if the currency decimal is different
     *
     * @return bool
     */
    public function getDifferentForCurrency(): bool
    {
        return (bool) $this->getValueByPath(self::XML_PATH_DIFFERENT_CURRENCY, 'website');
    }

    /**
     * Return Price precision for currency from store config
     *
     * @return int
     */
    public function getPricePrecisionCurrency(): int
    {
        return (int) $this->getValueByPath(self::XML_PATH_PRICE_PRECISION_CURRENCY, 'website');
    }
}
