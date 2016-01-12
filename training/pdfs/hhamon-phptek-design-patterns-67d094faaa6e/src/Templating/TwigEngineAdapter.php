<?php

namespace Templating;

use Templating\Exception\TemplateNotFoundException;
use Templating\Exception\UnsupportedTemplateException;

class TwigEngineAdapter implements EngineInterface
{
    /** @var \Twig_Environment */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
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
        try {
            $this->twig->loadTemplate($template);
        } catch (\Exception $e) {
            return false;
        }

        return true;
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
        $extension = strtolower(pathinfo($template, PATHINFO_EXTENSION));

        return in_array($extension, [ 'twig', 'tpl' ]);
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

        try {
            $reference = $this->twig->resolveTemplate($template);
        } catch (\Twig_Error_Loader $exception) {
            throw new TemplateNotFoundException(
                sprintf('Template %s does not exist.', $template),
                $exception
            );
        } catch (\Exception $exception) {
            throw new UnsupportedTemplateException(
                sprintf('Invalid template %s provided.', $template),
                $exception
            );
        }

        return new Template(
            $reference->getTemplateName(),
            $this->twig->mergeGlobals($vars)
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

        return $this->twig->render($template, $reference->getVariables());
    }
}
