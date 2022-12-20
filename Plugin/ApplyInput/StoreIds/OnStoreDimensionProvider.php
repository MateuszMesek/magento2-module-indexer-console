<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput\StoreIds;

use Magento\Framework\Indexer\DimensionFactory;
use Magento\Store\Model\StoreDimensionProvider;
use MateuszMesek\Console\Console\ValueResolver\ValueResolverInterface;
use Traversable;

class OnStoreDimensionProvider
{

    public function __construct(
        private readonly ValueResolverInterface $inputStoreIds,
        private readonly DimensionFactory       $dimensionFactory
    )
    {
    }

    public function aroundGetIterator(
        StoreDimensionProvider $storeDimensionProvider,
        callable               $proceed
    ): Traversable
    {
        $storeIds = $this->inputStoreIds->get();

        if (null === $storeIds) {
            yield from $proceed();

            return;
        }

        foreach ($storeIds as $storeId) {
            $dimension = $this->dimensionFactory->create(StoreDimensionProvider::DIMENSION_NAME, (string)$storeId);

            yield [$dimension->getName() => $dimension];
        }
    }
}
