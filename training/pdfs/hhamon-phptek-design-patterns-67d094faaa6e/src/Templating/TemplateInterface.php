<?php

namespace Templating;

interface TemplateInterface
{
    /**
     * Returns the template real path.
     *
     * @return string
     */
    public function getPath();

    /**
     * Returns the template variables.
     *
     * @return array
     */
    public function getVariables();

    /**
     * Returns whether or not the template has the
     * given variable name.
     *
     * @param string $name The variable name
     *
     * @return bool
     */
    public function has($name);

    /**
     * Sets a variable name.
     *
     * @param string $name  The variable name
     * @param mixed  $value The variable value
     */
    public function set($name, $value);
}
