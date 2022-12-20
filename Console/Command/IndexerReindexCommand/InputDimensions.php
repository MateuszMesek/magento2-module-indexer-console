<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Console\Command\IndexerReindexCommand;

use Symfony\Component\Console\Input\InputOption;

class InputDimensions extends InputOption implements InputInterface
{
    public const NAME = 'dimensions';

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
