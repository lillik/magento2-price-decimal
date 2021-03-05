<?php
/**
 *
 * @package Lillik\PriceDecimal\Model
 * @author  Lilian Codreanu <lilian.codreanu@gmail.com>
 * includes Roy Nilsson's modifications ( Aug 2020 ) 
 * includes Patriboom's modifications   ( Mar 2021 ) 
 */

namespace Lillik\PriceDecimal\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;

class Config implements ConfigInterface
{

	const XML_PATH_GENERAL_ENABLE 			= 'catalog_price_decimal/general/enable';
	const XML_PATH_CAN_SHOW_PRICE_DECIMAL 	= 'catalog_price_decimal/general/can_show_decimal';
	const XML_PATH_DISABLE_FOR_ACTIONS 		= 'catalog_price_decimal/general/disable_for_actions';

	const XML_PATH_PRICE_PRECISION 			= 'catalog_price_decimal/general/price_precision';
	const XML_PATH_PRICE_PRECISIONCART 		= 'catalog_price_decimal/general/price_precisionCart';
	const XML_PATH_PRICE_PRECISIONCHECKOUT = 'catalog_price_decimal/general/price_precisionCheckout';


    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

	/**
     * @var \Magento\Framework\App\RequestInterface
     */
    private $request;
    
    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct( ScopeConfigInterface $scopeConfig, RequestInterface $request ) 
		{
        $this->scopeConfig = $scopeConfig;
        $this->request = $request;
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
      //return $this->getValueByPath(self::XML_PATH_GENERAL_ENABLE, 'website');
		return $this->getValueByPath(self::XML_PATH_GENERAL_ENABLE, 'website') && !$this->isDisabledForAction(); 
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
     * @return mixed
     */
    public function getPricePrecision()
    {
        return $this->getValueByPath(self::XML_PATH_PRICE_PRECISION, 'website');
    }
    public function getPricePrecisionCart()
    {
        return $this->getValueByPath(self::XML_PATH_PRICE_PRECISIONCART, 'website');
    }
    public function getPricePrecisionCheckout()
    {
        return $this->getValueByPath(self::XML_PATH_PRICE_PRECISIONCHECKOUT, 'website');
    }

    private function isDisabledForAction()
    {
        $currentAction = $this->request->getModuleName() . '_' . $this->request->getControllerName() . '_' . $this->request->getActionName();
        foreach (explode(',', $this->getValueByPath(self::XML_PATH_DISABLE_FOR_ACTIONS, 'website')) as $action) {
            if (trim($action) == $currentAction) {
                return true;
            }
        }
        return false;
    }
}
