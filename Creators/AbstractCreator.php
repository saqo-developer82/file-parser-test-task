<?php

abstract class AbstractCreator
{
    protected $required_fields;
    protected $file;
    protected $data;
    protected $headers_map = [];

    abstract public function create();

    protected function deleteFileIfExists()
    {
        if (file_exists($this->file))
        {
            unlink($this->file);
        }
    }
}
