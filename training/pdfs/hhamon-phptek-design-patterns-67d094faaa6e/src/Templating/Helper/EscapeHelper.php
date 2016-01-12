<?php

namespace Templating\Helper;

class EscapeHelper implements HelperInterface
{
    public function escape($value)
    {
        if (is_string($value)) {
            return htmlspecialchars($value, ENT_QUOTES|ENT_HTML5, 'UTF-8');
        }

        return $value;
    }

    public function getName()
    {
        return 'escape';
    }
}
