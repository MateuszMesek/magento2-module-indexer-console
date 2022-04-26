<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\ValueParser;

use InvalidArgumentException;
use MateuszMesek\Console\ValueParser\JsonValueParser;

class InputDimensions extends JsonValueParser
{
    public function parse($input)
    {
        $output = parent::parse($input);

        if (!is_array($output) || empty($output['name']) || empty($output['value'])) {
            throw new InvalidArgumentException('Invalid dimensions input value');
        }

        return $output;
    }
}
