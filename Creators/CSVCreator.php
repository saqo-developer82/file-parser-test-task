<?php
require_once 'AbstractCreator.php';

class CSVCreator extends AbstractCreator
{
    public function __construct($file, $data = [])
    {
        $this->file = $file;
        $this->data = $data;
        $this->headers_map = [
            'make'      => 'brand_name',
            'model'     => 'model_name',
            'condition' => 'condition_name',
            'grade'     => 'grade_name',
            'capacity'  => 'gb_spec_name',
            'color'     => 'colour_name',
            'network'   => 'network_name',
            'count'     => 'count'
        ];

        $this->deleteFileIfExists();
    }

    public function create()
    {
        if (($handle = fopen($this->file, "w")) !== false) {
            fputcsv($handle, array_keys($this->headers_map)); // Write headers

            foreach ($this->data as $data) {
                fputcsv($handle, $data);
            }

            fclose($handle);
        }
    }
}
