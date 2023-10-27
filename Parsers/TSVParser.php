<?php
require_once 'AbstractParser.php';

class TSVParser extends AbstractParser
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->required_fields = ['brand_name', 'model_name'];
    }

    public function parse()
    {
        $products = [];
        if (($handle = fopen($this->file, "r")) !== false) {
            $headers = fgetcsv($handle, 0, "\t");
            $rowNumber = 1;

            while (($data = fgetcsv($handle, 0, "\t")) !== false) {
                $product = [];

                foreach ($headers as $index => $header) {
                    if (in_array($header, $this->required_fields) && empty($data[$index])) {
                        throw new Exception("Row $rowNumber: $header is a required field.");
                    }

                    $product[$header] = $data[$index];
                }

                // Track unique combinations
                $product_key = md5(implode('; ', $product));
                if (!isset($products[$product_key])) {
                    $products[$product_key] = array_merge($product, ['count' => 1]);
                } else {
                    ++$products[$product_key]['count'];
                }

                ++$rowNumber;
            }

            fclose($handle);
        } else {
            throw new Exception("Unable to open file: $this->file");
        }

        return $products;
    }
}
