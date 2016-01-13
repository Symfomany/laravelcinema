<?php

namespace Logger\Formatter;

class PlainTextFormatter implements FormatterInterface
{
    public function format($message)
    {
        return sprintf('[%s] %s', date('Y-m-d H:i:s'), $message);
    }
}
