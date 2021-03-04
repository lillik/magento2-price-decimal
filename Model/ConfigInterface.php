<?php
/**
 *
 * @package Lillik\PriceDecimal\Model
 *
 * @author  Lilian Codreanu <lilian.codreanu@gmail.com>
 */


namespace Lillik\PriceDecimal\Model;

interface ConfigInterface
{
    /**
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function getScopeConfig();

    /**
     * @return mixed
     */
    public function isEnable();
}
