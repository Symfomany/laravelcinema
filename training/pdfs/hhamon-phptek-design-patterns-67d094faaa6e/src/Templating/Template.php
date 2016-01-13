<?php

namespace Templating;

class Template implements TemplateInterface
{
    /**
     * The template real path.
     *
     * @var string
     */
    private $path;

    /**
     * The template variables.
     *
     * @var array
     */
    private $vars;

    /**
     * Constructor.
     *
     * @param string $path The template absolute path
     * @param array  $vars The template variables
     */
    public function __construct($path, array $vars = [])
    {
        $this->path = $path;
        $this->vars = $vars;
    }

    /**
     * Returns the real template path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the template variables.
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->vars;
    }

    /**
     * Returns whether or not the template has the
     * given variable name.
     *
     * @param string $name The variable name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->vars[$name]);
    }

    /**
     * Sets a variable name.
     *
     * @param string $name  The variable name
     * @param mixed  $value The variable value
     */
    public function set($name, $value)
    {
        $this->vars[$name] = $value;
    }
}
