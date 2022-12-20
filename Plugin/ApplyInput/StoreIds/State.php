<?php declare(strict_types=1);

namespace MateuszMesek\IndexerConsole\Plugin\ApplyInput\StoreIds;

class State
{
    private int $level = 0;

    public function enable(): void
    {
        $this->level++;
    }

    public function disable(): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        $this->level--;
    }

    public function isEnabled(): bool
    {
        return $this->level > 0;
    }
}
