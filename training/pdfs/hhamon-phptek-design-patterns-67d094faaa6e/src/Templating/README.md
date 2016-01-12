The Templating Component
========================

The `Templating` component showcases different kind of adapters to adapt third
party templating libraries like Twig or Plates to an existing legacy application
that uses a `PhpEngine` custom template engine. The goal of the Adapter pattern
here is to provide a clever way to migrate some PHP templates to Twig templates
without changing a single line of PHP code in the actual application classes.

Usage
-----

The following snippet is the current template engine API used by the application:

    :::php
    <?php
    
    use Templating\Helper\DateHelper;
    use Templating\Helper\TextHelper;
    use Templating\PhpEngine;
    
    $engine = new PhpEngine(__DIR__.'/views');
    $engine->addHelper(new TextHelper());
    $engine->addHelper(new DateHelper());
    
    $engine->evaluate('blog.tpl', [ 'posts' => $posts ]);

Adapting the Twig template engine instead is as easy as pie with a new
`TwigEngineAdapter` class:

    :::php
    <?php
    
    use Templating\TwigEngineAdapter;
    
    $loader = new \Twig_Loader_Filesystem(__DIR__.'/views');
    $twig = new \Twig_Environment($loader);
    
    $engine = new TwigEngineAdapter($twig);
    $engine->evaluate('blog.twig', [ 'posts' => $posts ]);

Same for supporting the Plates template engine:

    :::php
    <?php
    
    use League\Plates\Engine as Plates;
    use Templating\PlatesEngineAdapter;
    
    $plates = new Plates(__DIR__.'/views');
    $plates->setFileExtension(null);
    $plates->addData([ 'foo' => 'bar' ]);
    
    $engine = new PlatesEngineAdapter($plates);
    $engine->evaluate('blog.tpl', [ 'posts' => 'posts' ]);

And supporting all in one to have more flexibility is as easy as creating a
Composite template engine that embeds the three engines (PHP, Twig & Plates).

    :::php
    <?php
    
    // ...
    use Templating\ChainEngine;
    use Templating\PlatesEngineAdapter;
    use Templating\TwigEngineAdapter;
    
    // ...
    
    $engine = new ChainEngine();
    $engine->add(new PlatesEngineAdapter($plates));
    $engine->add(new TwigEngineAdapter($twig));
    $engine->add($php);
    
    $engine->evaluate('blog.tpl', [ 'posts' => $posts ]);  // Plates
    $engine->evaluate('blog.twig', [ 'posts' => $posts ]); // Twig
    $engine->evaluate('blog.php', [ 'posts' => $posts ]);  // PHP

