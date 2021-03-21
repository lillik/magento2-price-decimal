<?php
/**
 * @category   Evozon
 * @package    Magento_Evozon
 * @copyright  Copyright (c) 2018 Evozon (http://www.evozon.com)
 * @author     Lilian Codreanu <lilian.codreanu@evozon.com>
 */

namespace Lillik\PriceDecimal\Block\System\Config\Form\Field;


class Precision implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('0')],
            ['value' => 1, 'label' => __('1')],
            ['value' => 2, 'label' => __('2')],
            ['value' => 3, 'label' => __('3')],
            ['value' => 4, 'label' => __('4')],
        ];
    }
}