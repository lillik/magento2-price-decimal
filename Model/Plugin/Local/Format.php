<?php
/**
 *
 * @package package Lillik\PriceDecimal\Model\Plugin\Local
 *
 * @author  Lilian Codreanu <lilian.codreanu@gmail.com>
 * Includes: differentCurrencies from quintenbuis  (2021-03-14)
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
		$precision = $this->getPricePrecisionCurrency();
		if ($this->getConfig()->isEnable()) {
			$result['precision'] 			= $precision;
			$result['precisionCart']  		= $this->getConfig()->getPricePrecisionCart();
			$result['precisionCheckout'] 	= $this->getConfig()->getPricePrecisionCheckout();
			$result['requiredPrecision'] 	= $precision;
		}

		return $result;
	}
}
