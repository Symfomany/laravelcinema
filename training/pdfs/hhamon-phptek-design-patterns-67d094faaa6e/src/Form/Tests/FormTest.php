<?php

namespace Form\Tests;

use Form\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSimpleForm()
    {
        $form = new Form('product');

        $this->assertSame('product', $form->getName());
        $this->assertNull($form->get('foo'));
        $this->assertNull($form->getParent());
        $this->assertNull($form->getData());
        $this->assertNull($form->getFiles());
        $this->assertTrue($form->isRoot());
        $this->assertFalse($form->isSubmitted());
    }

    public function testSubmitSimpleForm()
    {
        $form = new Form('product');
        $form->submit(
            ['foo' => 'bar'],
            ['tmp' => '/foo.png']
        );

        $this->assertSame('product', $form->getName());
        $this->assertNull($form->getParent());
        $this->assertSame(['foo' => 'bar'], $form->getData());
        $this->assertSame(['tmp' => '/foo.png'], $form->getFiles());
        $this->assertTrue($form->isRoot());
        $this->assertTrue($form->isSubmitted());
    }

    public function testSubmitAdvancedForm()
    {
        $submittedData = [
            'title'       => 'The title',
            'description' => 'The description',
        ];

        $title = new Form('title');
        $description = new Form('description');

        $form = new Form('product');
        $form->add($title);
        $form->add($description);
        $form->submit($submittedData);

        $this->assertSame($title, $form->get('title'));
        $this->assertSame($description, $form->get('description'));
        $this->assertNull($title->get('foo'));
        $this->assertNull($description->get('foo'));

        $this->assertNull($form->getParent());
        $this->assertSame($form, $title->getParent());
        $this->assertSame($form, $description->getParent());

        $this->assertSame('product', $form->getName());
        $this->assertSame('title', $title->getName());
        $this->assertSame('description', $description->getName());

        $this->assertTrue($form->isRoot());
        $this->assertFalse($title->isRoot());
        $this->assertFalse($description->isRoot());

        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($title->isSubmitted());
        $this->assertTrue($description->isSubmitted());

        $this->assertSame($submittedData, $form->getData());
        $this->assertSame('The title', $title->getData());
        $this->assertSame('The description', $description->getData());

        $this->assertNull($form->getFiles());
        $this->assertNull($title->getFiles());
        $this->assertNull($description->getFiles());
    }

    public function testSubmitDeepNestedForm()
    {
        $form = new Form('product');
        $form->add(new Form('title'));
        $form->add(new Form('description'));
        $form->add(new Form('picture'));

        $form->get('picture')->add(new Form('caption'));
        $form->get('picture')->add(new Form('file'));

        $data = [
            'title'       => 'The title',
            'description' => 'The description',
            'picture'     => [
                'caption' => 'Some caption',
            ],
        ];

        $files = [
            'picture' => [
                'file' => [
                    'tmp_name' => 'foo',
                    'error'    => 0,
                ],
            ],
        ];

        $form->submit($data, $files);

        // Check root data
        $this->assertSame($data, $form->getData());
        $this->assertSame($files, $form->getFiles());

        // Check title data
        $this->assertSame('The title', $form->get('title')->getData());
        $this->assertNull($form->get('title')->getFiles());

        // Check description data
        $this->assertSame('The description', $form->get('description')->getData());
        $this->assertNull($form->get('description')->getFiles());

        // Check picture data
        $this->assertSame($data['picture'], $form->get('picture')->getData());
        $this->assertSame($files['picture'], $form->get('picture')->getFiles());

        // Check caption data
        $this->assertSame('Some caption', $form->get('picture')->get('caption')->getData());
        $this->assertNull($form->get('picture')->get('caption')->getFiles());

        // Check file data
        $this->assertNull($form->get('picture')->get('file')->getData());
        $this->assertSame($files['picture']['file'], $form->get('picture')->get('file')->getFiles());
    }

    /** @expectedException \Form\FormException */
    public function testSubmitWrongData()
    {
        $form = new Form('product');
        $form->add(new Form('title'));
        $form->add(new Form('description'));
        $form->submit('foo');
    }
}
