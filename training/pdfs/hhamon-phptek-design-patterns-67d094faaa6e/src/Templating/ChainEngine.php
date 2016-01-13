<?php

namespace Templating;

use Templating\Exception\UnsupportedTemplateException;

class ChainEngine implements EngineInterface
{
    /** @var EngineInterface[] */
    private $engines;

    public function __construct(array $engines = [])
    {
        $this->engines = [];
        foreach ($engines as $engine) {
            $this->add($engine);
        }
    }

    public function add(EngineInterface $engine)
    {
        $this->engines[] = $engine;
    }

    /**
     * Returns the supported engine.
     *
     * @param string $template
     *
     * @return EngineInterface
     */
    private function getEngine($template)
    {
        foreach ($this->engines as $engine) {
            if ($engine->supports($template)) {
                return $engine;
            }
        }

        throw new UnsupportedTemplateException(sprintf(
            'Template %s is not supported by any of the chained engines.',
            $template
        ));
    }

    public function exists($template)
    {
        return $this->getEngine($template)->exists($template);
    }

    public function supports($template)
    {
        $engine = null;
        try {
            $engine = $this->getEngine($template);
        } catch (UnsupportedTemplateException $e) {
            // Nothing to do here
        }

        return null !== $engine;
    }

    public function loadTemplate($template, array $vars = [])
    {
        return $this->getEngine($template)->loadTemplate($template, $vars);
    }

    public function evaluate($template, array $vars = [])
    {
        return $this->getEngine($template)->evaluate($template, $vars);
    }
}
