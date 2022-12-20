<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\UpdateConsoleInputList;

use Magento\Indexer\Console\Command\IndexerReindexCommand;
use MateuszMesek\IndexerConsole\Console\Command\IndexerReindexCommand\InputPool;

class OnIndexerReindexCommand
{
    public function __construct(
        private readonly InputPool $inputPool
    )
    {
    }

    public function afterGetInputList(
        IndexerReindexCommand $indexerReindexCommand,
        array                 $inputList
    ): array
    {
        foreach ($this->inputPool->getAll() as $input) {
            $inputList[] = $input;
        }

        return $inputList;
    }
}
