The Navigation Tree
===================

The Navigation component is a variant of implementation of the Composite pattern.
It uses only one class (`Item`) to handle both single objects and collections of
objects. Each `Item` instance can be composed with children `Item` instances to
build a complex navigation tree (items nesting items nesting items...).

Usage
-----

Modelizing a complex navigation tree:

    :::php
    <?php
    
    $world = new Item('World', '/', [
        new Item('Africa', '/africa', [
            new Item('Mali', '/africa/mali', [
                new Item('Bamako', '/africa/mali/bamako'),
            ]),
            new Item('Tunisia', '/africa/tunisia', [
                new Item('Hammamet', '/africa/tunisia/tunis'),
                new Item('Sfax', '/africa/tunisia/sfax'),
                new Item('Tunis', '/africa/tunisia/tunis'),
            ]),
            new Item('Arab Emirates', '/africa/arab-emirates', [
                new Item('Abu Dhabi', '/africa/arab-emirates/abu-dhabi'),
                new Item('Dubai', '/africa/arab-emirates/dubai'),
            ]),
        ]),
        new Item('America', '/america', [
            new Item('Canada', '/america/canada', [
                new Item('Quebec', '/america/canada/quebec', [
                    new Item('Quebec', '/america/canada/quebec/quebec'),
                    new Item('Montreal', '/america/canada/quebec/montreal'),
                ]),
                new Item('Ontario', '/america/canada/ontario', [
                    new Item('Ottawa', '/america/canada/ontario/ottawa'),
                    new Item('Toronto', '/america/canada/ontario/toronto'),
                ])
            ]),
            new Item('United States', '/america/united-states', [
                new Item('California', '/america/united-states/california', [
                    new Item('Los Angeles', '/america/united-states/california/los-angeles'),
                    new Item('San Francisco', '/america/united-states/california/san-francisco'),
                ]),
                new Item('Illinois', '/america/united-states/illinois', [
                    new Item('Chicago', '/america/united-states/illinois/chicago'),
                ]),
            ]),
        ]),
        new Item('Europe', '/europe', [
            // ...
        ]),
        // ...
    ]);

Rendering the World navigation tree:

    :::php
    <?php
    
    function display_menu(\Navigation\ItemInterface $item)
    {
        $label = $item->getLabel();
        $link = $item->getLink();
    
        $output = '<ul>';
        $output.= '  <li>';
        $output.= $link ? sprintf('<a href="%s">%s</a>', $link, $label) : $label;
        foreach ($item->getItems() as $child) {
            $output.= display_menu($child);
        }
        $output.= '  </li>';
        $output.= '</ul>';
    
        return $output;
    }

