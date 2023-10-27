<?php

class ParserFactory
{
    public static function createParser($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'csv':
                require_once 'CSVParser.php';
                return new CSVParser($file);
            case 'tsv':
                require_once 'TSVParser.php';
                return new TSVParser($file);
            default:
                throw new Exception('Unsupported file type');
        }
    }
}
