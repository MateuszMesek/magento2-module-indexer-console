<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput\StoreIds;

use Magento\Framework\Indexer\DimensionProviderInterface;
use MateuszMesek\Console\Console\ValueResolver\ValueResolverInterface;
use Traversable;

class OnIndexerDimensionProvider
{
    public function __construct(
        private readonly State                  $state,
        private readonly ValueResolverInterface $inputStoreIds
    )
    {
    }

    public function aroundGetIterator(
        DimensionProviderInterface $dimensionProvider,
        callable                   $proceed
    ): Traversable
    {
        if (null === $this->inputStoreIds->get()) {
            yield from $proceed();

            return;
        }

        $dimensions = [];

        try {
            $this->state->enable();

            foreach ($proceed() as $name => $dimension) {
                $dimensions[$name] = $dimension;
            }
        } finally {
            $this->state->disable();
        }

        yield from $dimensions;
    }
}
