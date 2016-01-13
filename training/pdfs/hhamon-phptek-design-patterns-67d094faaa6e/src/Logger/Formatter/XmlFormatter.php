<?php

namespace Logger\Formatter;

class XmlFormatter implements FormatterInterface
{
    public function format($message)
    {
        return '<log time="'.date('Y-m-d H:i:s').'">'.$message.'</log>';
    }
}
