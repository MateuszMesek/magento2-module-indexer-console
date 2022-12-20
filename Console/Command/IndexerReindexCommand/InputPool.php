<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Command\IndexerReindexCommand;

use Magento\Framework\ObjectManager\TMap;
use Magento\Framework\ObjectManager\TMapFactory;
use Traversable;

class InputPool
{
    private TMap $inputs;

    public function __construct(
        TMapFactory $TMapFactory,
        array       $inputs = []
    )
    {
        $this->inputs = $TMapFactory->createSharedObjectsMap([
            'type' => InputInterface::class,
            'array' => $inputs
        ]);
    }

    /**
     * @return \Traversable|\MateuszMesek\IndexerConsole\Command\IndexerReindexCommand\InputInterface[]
     */
    public function getAll(): Traversable
    {
        foreach ($this->inputs->getIterator() as $input) {
            yield $input;
        }
    }
}
