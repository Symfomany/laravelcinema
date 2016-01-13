The Writer Component
===================

The `Writer` component is an implementation of the Decorator pattern to modelize
a multfunction pen capable of writing a text in bold, italic, uppercase,
lowercase characters. It' also able to ban injurious words, write in reverse way,
writes a text with underline... Any combination of applicable formatters is
possible without limitation. The multifunction pen is extensible at will!

Usage
-----

The formatters simply decorates the `Pen` concrete instance successively:

    :::php
    <?php
    
    use Writer\BoldWriter;
    use Writer\ItalicWriter;
    use Writer\UppercaseWriter;
    use Writer\Pen;
    
    $pen = new ItalicWriter(new BoldWriter(new UppercaseWriter(new Pen())));
    echo $pen->write('Hello World!');
    
    $pen = new BoldWriter(new ItalicWriter(new UppercaseWriter(new Pen())));
    echo $pen->write('Hello World!');
    
    $pen = new UppercaseWriter(new ItalicWriter(new BoldWriter(new Pen())));
    echo $pen->write('Hello World!');

Output Result
-------------

The previous snippet of code outputs something similar to the following one:

    <em><strong>HELLO WORLD!</strong></em>
    <strong><em>HELLO WORLD!</em></strong>
    <EM><STRONG>HELLO WORLD!</STRONG></EM>
