<?php

namespace Templating\Exception;

class UnsupportedHelperException extends \RuntimeException
{
    private $invalidHelper;
    private $supportedHelpers;

    public function __construct($invalidHelper, array $supportedHelpers, \Exception $previous = null)
    {
        $message = sprintf(
            'Unsupported helper "%s". It must be one of %s.',
            $invalidHelper,
            implode(', ', $supportedHelpers)
        );

        parent::__construct($message, 0, $previous);

        $this->invalidHelper = $invalidHelper;
        $this->supportedHelpers = $supportedHelpers;
    }

    public function getInvalidHelper()
    {
        return $this->invalidHelper;
    }

    public function getSupportedHelpers()
    {
        return $this->supportedHelpers;
    }
}
