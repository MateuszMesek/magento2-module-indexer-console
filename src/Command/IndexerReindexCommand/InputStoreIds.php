<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Command\IndexerReindexCommand;

use MateuszMesek\Console\Input\InputRangeOption;

class InputStoreIds extends InputRangeOption implements InputInterface
{
    public const NAME = 'store-ids';

    public function __construct(
        string $name = self::NAME,
               $shortcut = null,
        int    $mode = self::VALUE_OPTIONAL,
        string $description = '',
               $default = null
    )
    {
        parent::__construct($name, $shortcut, $mode, $description, $default);
    }
}
