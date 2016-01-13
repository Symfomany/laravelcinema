<?php

namespace Templating;

use Templating\Exception\TemplateNotFoundException;
use Templating\Exception\UnsupportedTemplateException;

interface EngineInterface
{
    /**
     * Returns whether or not the given template exists.
     *
     * @param string $template
     *
     * @return bool
     */
    public function exists($template);

    /**
     * Returns whether or not the given template is supported.
     *
     * @param string $template
     *
     * @return bool
     */
    public function supports($template);

    /**
     * Loads the template.
     *
     * @param string $template The template relative path
     * @param array  $vars     The template variables
     *
     * @throws TemplateNotFoundException    When template does not exist
     * @throws UnsupportedTemplateException When template format is not supported
     *
     * @return TemplateInterface
     */
    public function loadTemplate($template, array $vars = []);

    /**
     * Evaluates the template with its variables.
     *
     * @param string $template The template relative path
     * @param array  $vars     The template variables
     *
     * @return string
     */
    public function evaluate($template, array $vars = []);
}
