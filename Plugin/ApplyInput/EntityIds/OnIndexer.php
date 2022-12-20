<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput\EntityIds;

use Magento\Indexer\Model\Indexer;
use MateuszMesek\Console\Console\ValueResolver\ValueResolverInterface;

class OnIndexer
{
    public function __construct(
        private readonly ValueResolverInterface $inputEntityIds
    )
    {
    }

    public function aroundReindexAll(
        Indexer  $indexer,
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
