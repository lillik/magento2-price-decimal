<?php
/**
 *
 * @package Lillik\PriceDecimal\Model
 *
 * @author  Lilian Codreanu <lilian.codreanu@gmail.com>
 */

namespace Lillik\PriceDecimal\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Framework\App\State;

class Config implements ConfigInterface
{
    const XML_PATH_PRICE_PRECISION
        = 'catalog_price_decimal/general/price_precision';

    const XML_PATH_CAN_SHOW_PRICE_DECIMAL
        = 'catalog_price_decimal/general/can_show_decimal';

    const XML_PATH_GENERAL_ENABLE
        = 'catalog_price_decimal/general/enable';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Framework\App\State
     */
    private $state;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        State $state
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->state = $state;
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
     *
     * @param string $path
     * @param string $scopeType
     *
     * @return mixed
     */
    public function getValueByPath($path, $scopeType = \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
    {
        return $this->getScopeConfig()->getValue($path, $scopeType);
    }

    /**
     * @return mixed
     */
    public function isEnable()
    {
        if ($this->isAdmin()) {
            return $this->getValueByPath(self::XML_PATH_GENERAL_ENABLE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        }

        return $this->getValueByPath(self::XML_PATH_GENERAL_ENABLE);
    }

    /**
     * @return mixed
     */
    public function canShowPriceDecimal()
    {
        return $this->getValueByPath(self::XML_PATH_CAN_SHOW_PRICE_DECIMAL);
    }

    /**
     * Return Price precision from store config
     *
     * @return mixed
     */
    public function getPricePrecision()
    {
        return $this->getValueByPath(self::XML_PATH_PRICE_PRECISION);
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        $areaCode = $this->state->getAreaCode();

        return $areaCode == \Magento\Framework\App\Area::AREA_ADMINHTML;
    }
}
