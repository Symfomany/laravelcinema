<?php

namespace Form;

interface FormInterface
{
    public function isRoot();
    public function isSubmitted();
    public function getName();
    public function getParent();
    public function getData();
    public function getFiles();
    public function submit($data = null, array $files = null);
    public function add(FormInterface $child);
} 
