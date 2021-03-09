<?php
/**
 *
 * @package Lillik\PriceDecimal
 *
 * @author  Lilian Codreanu <lilian.codreanu@gmail.com>
 */

namespace Lillik\PriceDecimal\Model;

trait PricePrecisionConfigTrait
{

	public static $Val = 2;

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
        		//return $context->getLayout();
        		$Val = $this->getConfig()->getPricePrecision(); 
        		$Val =  (strstr($_SERVER['PHP_SELF'], 'checkout') > -1 ) ? $this->getConfig()->getPricePrecisionCheckout() :  $Val;
        		$Val =  (strstr($_SERVER['PHP_SELF'], 'cart') > -1 ) ? $this->getConfig()->getPricePrecisionCart() :  $Val;
            return $Val;
        }

        return 0;
    }
}
