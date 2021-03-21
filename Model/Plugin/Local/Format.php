<?php
/**
 *
 * @package package Lillik\PriceDecimal\Model\Plugin\Local
 *
 * @author  Lilian Codreanu <lilian.codreanu@gmail.com>
 */

namespace Lillik\PriceDecimal\Model\Plugin\Local;

use Lillik\PriceDecimal\Model\Plugin\PriceFormatPluginAbstract;

class Format extends PriceFormatPluginAbstract
{

    /**
     * {@inheritdoc}
     *
     * @param $subject
     * @param $result
     *
     * @return mixed
     */
    public function afterGetPriceFormat($subject, $result)
    {
        $precision = $this->getPricePrecision();

        if ($this->getConfig()->isEnable()) {
            $result['precision'] 			= $precision;
            $result['precisionCart']  		= $this->getConfig()->getPricePrecisionCart();
            $result['precisionCheckout'] 	= $this->getConfig()->getPricePrecisionCheckout();
            $result['requiredPrecision'] 	= $precision;
        }

        return $result;
    }
}
