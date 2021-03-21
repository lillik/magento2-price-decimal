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

		/**
     * @$Val used to keep track of the way to count decimals
     */
	public $Val;
	
		/**
     * @$requestUri used to know which page is calling function so, which value return to 
     */
	public $requestUri;

    /**

     * @return \Lillik\PriceDecimal\Model\ConfigInterface
     */
    public function getConfig()
    {
        return $this->moduleConfig;
    }

    /**
     * Set the PAGE INFO string
     *
     * @param string|null $pathInfo
     * @return $this
     */
    public function getPageInfo($pathInfo = null) 
    {
        if ($pathInfo === null) {
            $requestUri = $this->getRequestUri();
            if ($requestUri == '/') {
                return $this;
            }

            // Remove the query string from REQUEST_URI
            $pos = strpos($requestUri, '?');
            if ($pos) {
                $requestUri = substr($requestUri, 0, $pos);
            }

            $baseUrl = $this->getBaseUrl();
            $pathInfo = substr($requestUri, strlen($baseUrl));
            if (!empty($baseUrl) && '/' === $pathInfo) {
                $pathInfo = '';
            } elseif ($baseUrl === null) {
                $pathInfo = $requestUri;
            }
            $pathInfo = ($pos !== false) ? substr($requestUri, $pos) : '';
            $this->requestString = $pathInfo;
        }
        $this->pathInfo = ($pathInfo == '') ? array() : explode('/', $pathInfo);
        return $this;
    }

    /**
     * @return int|mixed
     */
    public function getPricePrecision()
    {
        if ($this->getConfig()->canShowPriceDecimal()) {
        		//return $context->getLayout();
        		$Val = $this->getConfig()->getPricePrecision(); 
        		$Val =  (in_array('checkout', getPageInfo())) ? $this->getConfig()->getPricePrecisionCheckout() :  $Val;
        		$Val =  (in_array('cart', getPageInfo()))  ? $this->getConfig()->getPricePrecisionCart() :  $Val;
//        		$Val =  (strstr($_SERVER['PHP_SELF'], 'checkout') > -1 ) ? $this->getConfig()->getPricePrecisionCheckout() :  $Val;
//        		$Val =  (strstr($_SERVER['PHP_SELF'], 'cart') > -1 ) ? $this->getConfig()->getPricePrecisionCart() :  $Val;
            return $Val;
        }
        return 0;
    }
}
