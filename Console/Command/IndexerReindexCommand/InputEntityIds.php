<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Console\Command\IndexerReindexCommand;

use MateuszMesek\Console\Console\Input\InputRangeOption;

class InputEntityIds extends InputRangeOption implements InputInterface
{
    public const NAME = 'entity-ids';

    public function __construct(
        string $name = self::NAME,
        $shortcut = null,
        int $mode = self::VALUE_OPTIONAL,
        string $description = '',
        $default = null
    )
    {
        parent::__construct($name, $shortcut, $mode, $description, $default);
    }
}
