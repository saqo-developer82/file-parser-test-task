<?php

abstract class AbstractParser
{
    protected $required_fields;
    protected $file;
    protected $data;
    protected $headers_map;

    abstract public function parse();

    protected function createFileIfNotExists()
    {
        if (! file_exists($this->file)) {
            $file = fopen($this->file, 'w');

            if ($file === false) {
                die("Failed to create the file.");
            }

            fclose($file);
            echo "The file has been created.";
        } else {
            echo "The file already exists.";
        }
    }
}
