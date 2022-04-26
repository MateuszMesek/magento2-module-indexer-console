<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\UpdateConsoleInputList;

use Magento\Indexer\Console\Command\IndexerReindexCommand;
use MateuszMesek\IndexerConsole\Command\IndexerReindexCommand\InputPool;

class OnIndexerReindexCommand
{
    private InputPool $inputPool;

    public function __construct(
        InputPool $inputPool
    )
    {
        $this->inputPool = $inputPool;
    }

    public function afterGetInputList(
        IndexerReindexCommand $indexerReindexCommand,
        array $inputList
    ): array
    {
        foreach ($this->inputPool->getAll() as $input) {
            $inputList[] = $input;
        }

        return $inputList;
    }
}
