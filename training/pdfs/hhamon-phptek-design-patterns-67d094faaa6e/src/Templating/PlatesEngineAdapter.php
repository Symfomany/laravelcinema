<?php

namespace Templating;

use League\Plates\Engine as Plates;
use Templating\Exception\TemplateNotFoundException;
use Templating\Exception\UnsupportedTemplateException;

class PlatesEngineAdapter implements EngineInterface
{
    /** @var Plates */
    private $plates;

    public function __construct(Plates $plates)
    {
        $this->plates = $plates;
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
        return $this->plates->exists($template);
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
        return 'tpl' === pathinfo($template, PATHINFO_EXTENSION);
    }

    /**
     * Loads the template.
     *
     * @param string $template The template relative path
     * @param array  $vars     The template variables
     *
     * @return TemplateInterface
     *
     * @throws TemplateNotFoundException    When template does not exist
     * @throws UnsupportedTemplateException When template format is not supported
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
                'Template %s does not exist.',
                $template
            ));
        }

        return new Template(
            $this->plates->path($template),
            array_merge($this->plates->getData(), $vars)
        );
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

        return $this->plates->render($template, $reference->getVariables());
    }
}
