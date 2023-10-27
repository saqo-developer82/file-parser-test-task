<?php

class CreatorFactory
{
    public static function createCreator($file, $data = [])
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'csv':
                require_once 'CSVCreator.php';

                return new CSVCreator($file, $data);
            default:
                throw new Exception('Unsupported file type');
        }
    }
}
