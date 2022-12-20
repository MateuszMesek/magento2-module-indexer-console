<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput\StoreIds;

use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use MateuszMesek\Console\Console\ValueResolver\ValueResolverInterface;

class OnStoreManager
{
    public function __construct(
        private readonly State                  $state,
        private readonly ValueResolverInterface $inputStoreIds
    )
    {
    }

    public function afterGetStores(
        StoreManagerInterface $storeManager,
        array                 $stores,
                              $withDefault = false,
                              $codeKey = false
    ): array
    {
        if (!$this->state->isEnabled()) {
            return $stores;
        }

        $storeIds = $this->inputStoreIds->get();

        if (null === $storeIds) {
            return $stores;
        }

        return array_filter(
            $stores,
            static function (StoreInterface $store) use ($storeIds) {
                $storeId = (int)$store->getId();

                return in_array($storeId, $storeIds, true);
            }
        );
    }
}
