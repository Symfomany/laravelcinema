<?php

namespace Templating;

use Templating\Exception\ReservedKeywordException;
use Templating\Exception\TemplateNotFoundException;
use Templating\Exception\UnsupportedHelperException;
use Templating\Exception\UnsupportedTemplateException;
use Templating\Helper\EscapeHelper;
use Templating\Helper\HelperInterface;

class PhpEngine implements EngineInterface, \ArrayAccess
{
    /**
     * A list of HelperInterface instances.
     *
     * @var HelperInterface[]
     */
    private $helpers;

    /**
     * The directory where templates are located.
     *
     * @var string
     */
    private $directory;

    /**
     * Constructor.
     *
     * @param string $directory The directory that stores templates
     */
    public function __construct($directory)
    {
        $this->addHelper(new EscapeHelper());
        $this->directory = $directory;
    }

    /**
     * Registers a new template helper.
     *
     * @param HelperInterface $helper
     */
    public function addHelper(HelperInterface $helper)
    {
        $this->helpers[$helper->getName()] = $helper;
    }

    /**
     * Returns a single helper instance.
     *
     * @param string $name The helper name
     * @return HelperInterface
     */
    private function getHelper($name)
    {
        if (!isset($this->helpers[$name])) {
            throw new UnsupportedHelperException($name, array_keys($this->helpers));
        }

        return $this->helpers[$name];
    }

    /**
     * Escapes a value.
     *
     * @param string $content The value to escape
     *
     * @return string The escaped value
     */
    public function escape($content)
    {
        return $this->getHelper('escape')->escape($content);
    }

    /**
     * Returns whether or not the given template exists.
     *
     * @param string $template
     *
     * @return bool
     */
    public function exists($template)
    {
        return is_readable($this->getTemplatePath($template));
    }

    /**
     * Returns whether or not the given template is supported.
     *
     * @param string $template
     *
     * @return bool
     */
    public function supports($template)
    {
        $ext = strtolower(pathinfo($template, PATHINFO_EXTENSION));

        return in_array($ext, [ 'php', 'tpl' ]);
    }

    /**
     * Computes the template absolute path.
     *
     * @param string $template The template relative path
     *
     * @return string
     */
    private function getTemplatePath($template)
    {
        return realpath($this->directory.'/'.ltrim($template, '/'));
    }

    /**
     * Loads the template.
     *
     * @param string $template The template relative path
     * @param array  $vars     The template variables
     *
     * @return TemplateInterface
     */
    public function loadTemplate($template, array $vars = [])
    {
        if (!$this->supports($template)) {
            throw new UnsupportedTemplateException(sprintf(
                'Template %s is not supported by this engine.',
                $template
            ));
        }

        if (!$this->exists($template)) {
            throw new TemplateNotFoundException(sprintf(
                'Template %s cannot be found under %s directory.',
                $template,
                $this->directory
            ));
        }

        return new Template($this->getTemplatePath($template), $vars);
    }

    /**
     * Evaluates the template with its variables.
     *
     * @param string $template The template relative path
     * @param array  $vars     The template variables
     *
     * @return string
     */
    public function evaluate($template, array $vars = [])
    {
        $reference = $this->loadTemplate($template, $vars);

        if ($reference->has('view')) {
            throw new ReservedKeywordException(sprintf(
                'Template %s cannot have a variable called "view" as it is a reserved keyword.',
                $template
            ));
        }

        $reference->set('view', $this);

        extract($reference->getVariables());
        ob_start();
        include $reference->getPath();

        return ob_get_clean();
    }

    /**
     * Returns whether or not the helper exists.
     *
     * @param string $helper The helper name
     *
     * @return bool
     */
    public function offsetExists($helper)
    {
        return isset($this->helpers[$helper]);
    }

    /**
     * Returns the helper by its name.
     *
     * @param string $helper The helper name
     *
     * @return HelperInterface
     */
    public function offsetGet($helper)
    {
        return $this->getHelper($helper);
    }

    /**
     * Registers a new helper.
     *
     * Actually, this operation is not supported.
     *
     * @param string $helper The helper name
     * @param mixed  $value  The helper instance
     *
     * @throws \BadMethodCallException
     */
    public function offsetSet($helper, $value)
    {
        throw new \BadMethodCallException('Use addHelper() to register a new helper.');
    }

    /**
     * Unregisters an existing helper.
     *
     * Actually, this operation is not supported.
     *
     * @param string $helper The helper name
     *
     * @throws \BadMethodCallException
     */
    public function offsetUnset($helper)
    {
        throw new \BadMethodCallException('Helpers cannot be unregistered.');
    }
}
