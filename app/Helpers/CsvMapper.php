<?php


namespace App\Helpers;

use League\Csv\Reader;

class CsvMapper
{
    public static function csvToArray(string $file, array $fields_map, array $custom_fields = []): array
    {
        $result = [];

        $reader = Reader::createFromPath($file, 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();

        foreach ($records as $offset => $record) {
            $product = [];
            $product['product_hash'] = uniqid('', true);
            foreach ($fields_map as $key => $value) {
                $product[$key] = self::clearInput($key, $record[$value]);
            }
            $product['custom'] = [];
            foreach ($custom_fields as $label => $column) {
                $product['custom'][] = [
                    'column_name' => self::clearInput('column_name', $label),
                    'column_value' => self::clearInput('column_value', $record[$column]),
                    'p_hash' => $product['product_hash']
                ];
            }
            $result[] = $product;
        }

        return $result;
    }

    private static function clearInput($type, $value)
    {
        switch ($type) {
            case 'price':
                return floatval(number_format($value, 2, '.', ''));
            case 'description':
                return self::filterString($value, 65535);
            case 'product_url':
                return filter_var(self::filterString($value), FILTER_VALIDATE_URL);
            case 'column_name':
                return self::filterString($value, 128);
            default:
                return self::filterString($value);
        }
    }

    private static function filterString($value, int $length = 255)
    {
        return mb_substr(
            escapeshellcmd(
                htmlspecialchars(
                    trim(strval($value))
                )
            ),
            0,
            $length
        );
    }
}
