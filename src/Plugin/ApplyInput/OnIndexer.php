<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput;

use Magento\Indexer\Model\Indexer;
use MateuszMesek\Console\ValueResolver\ValueResolverInterface;

class OnIndexer
{
    private ValueResolverInterface $inputEntityIds;

    public function __construct(
        ValueResolverInterface $inputEntityIds
    )
    {
        $this->inputEntityIds = $inputEntityIds;
    }

    public function aroundReindexAll(
        Indexer $indexer,
        callable $proceed
    ): void
    {
        $ids = $this->inputEntityIds->get();

        if (empty($ids)) {
            $proceed();

            return;
        }

        $indexer->reindexList($ids);
    }
}
