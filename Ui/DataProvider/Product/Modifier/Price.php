<?php

declare(strict_types=1);

namespace Lillik\PriceDecimal\Ui\DataProvider\Product\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Lillik\PriceDecimal\Model\ConfigInterface;
use Lillik\PriceDecimal\Model\PricePrecisionConfigTrait;

class Price extends AbstractModifier
{
    use PricePrecisionConfigTrait;

    /**
     * @var LocatorInterface
     */
    private $locator;
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;
    /**
     * @var ConfigInterface
     */
    private $moduleConfig;

    /**
     * Price constructor.
     *
     * @param LocatorInterface       $locator
     * @param DataPersistorInterface $dataPersistor
     * @param ConfigInterface        $moduleConfig
     */
    public function __construct(
        LocatorInterface $locator,
        DataPersistorInterface $dataPersistor,
        ConfigInterface $moduleConfig
    ) {

        $this->locator = $locator;
        $this->dataPersistor = $dataPersistor;
        $this->moduleConfig = $moduleConfig;
    }

    public function modifyData( array $data )
    {
        if ($this->moduleConfig->isEnable()) {
          if (!$this->locator->getProduct()->getId() && $this->dataPersistor->get('catalog_product')) {
              return $this->resolvePersistentData($data);
          }
          $productId = $this->locator->getProduct()->getId();
          $productPrice =  $this->locator->getProduct()->getPrice();
          $data[$productId][self::DATA_SOURCE_DEFAULT]['price'] = $this->formatPrice($productPrice);
        }
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function modifyMeta( array $meta )
    {
        return $meta;
    }

    /**
     * Format price to have only two decimals after delimiter
     *
     * @param mixed $value
     * @return string
     * @since 101.0.0
     */
    protected function formatPrice($value)
    { 
        return $value !== null ? number_format((float)$value, (int) $this->getPricePrecision(), '.', '') : '';
    }

    /**
     * Resolve data persistence
     *
     * @param array $data
     * @return array
     */
    private function resolvePersistentData(array $data)
    {
        $persistentData = (array)$this->dataPersistor->get('catalog_product');
        $this->dataPersistor->clear('catalog_product');
        $productId = $this->locator->getProduct()->getId();

        if (empty($data[$productId][self::DATA_SOURCE_DEFAULT])) {
            $data[$productId][self::DATA_SOURCE_DEFAULT] = [];
        }

        $data[$productId] = array_replace_recursive(
            $data[$productId][self::DATA_SOURCE_DEFAULT],
            $persistentData
        );

        return $data;
    }
}
