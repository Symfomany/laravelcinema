<?php

namespace Logger;

use Logger\Formatter\FormatterInterface;

class Logger
{
    private $logs;
    private $formatter;

    public function __construct(FormatterInterface $formatter)
    {
        $this->logs = [];
        $this->formatter = $formatter;
    }

    public function log($message, FormatterInterface $formatter = null)
    {
        if (null === $formatter) {
            $formatter = $this->formatter;
        }

        $this->save($formatter->format($message));
    }

    public function getLogs()
    {
        return $this->logs;
    }

    private function save($log)
    {
        $this->logs[] = $log;
    }
}
