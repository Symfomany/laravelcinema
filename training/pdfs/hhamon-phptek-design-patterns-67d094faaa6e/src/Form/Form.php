<?php

namespace Form;

class Form implements FormInterface
{
    private $data;
    private $files;
    private $name;
    private $parent;
    private $children;
    private $submitted;

    public function __construct($name)
    {
        $this->name = $name;
        $this->submitted = false;
        $this->children = [];
    }

    public function add(FormInterface $child)
    {
        $name = $child->getName();

        $this->children[$name] = $child;
        $child->parent = $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function get($name)
    {
        return isset($this->children[$name]) ? $this->children[$name] : null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function submit($data = null, array $files = null)
    {
        $this->data = $data;
        $this->files = $files;

        if (!is_array($data) && count($this->children)) {
            throw new FormException('A form with nested children must receive an array of data.');
        }

        foreach ($this->children as $name => $child) {
            $childData = isset($data[$name]) ? $data[$name] : null;
            $childFiles = isset($files[$name]) ? $files[$name] : null;
            $child->submit($childData, $childFiles);
        }

        $this->submitted = true;
    }

    public function isSubmitted()
    {
        return $this->submitted;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function isRoot()
    {
        return null === $this->parent;
    }
} 
