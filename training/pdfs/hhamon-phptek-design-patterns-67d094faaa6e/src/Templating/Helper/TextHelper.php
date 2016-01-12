<?php

namespace Templating\Helper;

class TextHelper implements HelperInterface
{
    public function getName()
    {
        return 'text';
    }

    public function paragraphs($text)
    {
        $text = trim($text);
        $text = nl2br(preg_replace("#\\n{2,}#", '</p><p>', $text));
        $text = str_replace("\n", '', $text);

        return sprintf('<p>%s</p>', $text);
    }
}
