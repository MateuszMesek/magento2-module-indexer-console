<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput;

use Magento\Framework\Indexer\DimensionalIndexerInterface;
use Magento\Framework\Indexer\DimensionFactory;
use MateuszMesek\Console\Console\ValueResolver\ValueResolverInterface;
use Traversable;

class OnDimensionalIndexer
{
    private ValueResolverInterface $inputDimensions;
    private DimensionFactory $dimensionFactory;

    public function __construct(
        ValueResolverInterface $inputDimensions,
        DimensionFactory $dimensionFactory
    )
    {
        $this->inputDimensions = $inputDimensions;
        $this->dimensionFactory = $dimensionFactory;
    }

    public function aroundExecuteByDimensions(
        DimensionalIndexerInterface $dimensionalIndexer,
        callable $proceed,
        array $dimensions,
        Traversable $entityIds = null
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
