<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput\Dimensions;

use Magento\Framework\Indexer\DimensionalIndexerInterface;
use Magento\Framework\Indexer\DimensionFactory;
use MateuszMesek\Console\Console\ValueResolver\ValueResolverInterface;
use Traversable;

class OnDimensionalIndexer
{
    public function __construct(
        private readonly ValueResolverInterface $inputDimensions,
        private readonly DimensionFactory       $dimensionFactory
    )
    {
    }

    public function aroundExecuteByDimensions(
        DimensionalIndexerInterface $dimensionalIndexer,
        callable                    $proceed,
        array                       $dimensions,
        Traversable                 $entityIds = null
    ): void
    {
        $inputDimensions = $this->inputDimensions->get();

        if (!empty($inputDimensions)) {
            $dimensions = [];

            foreach ($inputDimensions as $name => $value) {
                $dimension = $this->dimensionFactory->create($name, $value);

                $dimensions[$name] = $dimension;
            }
        }

        $proceed($dimensions, $entityIds);
    }
}
