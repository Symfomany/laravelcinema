The Form Component
==================

The Form component is a variant of implementation of the Composite pattern. It
uses only one class (`Form`) to handle both single objects and collections of
objects. Each `Form` instance can be composed with children `Form` instance to
build a complex form fields tree. The `Form::submit()` method recursively
passes the submitted data from the parent form to its children elements.

Usage
-----

Building and submitting a nested forms tree:

    :::php
    <?php
    
    use Form\Form;
    
    $form = new Form('product');
    $form->add(new Form('title'));
    $form->add(new Form('description'));
    $form->add(new Form('picture'));
    
    $form->get('picture')->add(new Form('caption'));
    $form->get('picture')->add(new Form('file'));

    $data = [
        'title' => 'The title',
        'description' => 'The description',
        'picture' => [
            'caption' => 'Some caption',
        ],
    ];
    
    $files = [
        'picture' => [
            'file' => [
                'tmp_name' => 'foo',
                'error' => 0,
            ]
        ],
    ];
    
    $form->submit($data, $files);
