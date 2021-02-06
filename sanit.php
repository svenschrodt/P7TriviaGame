<?php
class Sanitizer
{

    /**
     * Ensuring, that array key exists, initialized with default value if not
     *
     * @param array $data
     * @param array $keys
     * @param string $default
     */
    public static function ensureArrayHasKeys(array &$data, array $keys, $default = '')
    {
        print_r($data);
        foreach ($keys as $key) {
            echo "$key\n";

            if(!array_key_exists($key, $data)) {
                $data[$key] = $default;
            }
        }
    }

}


$dta = ['id'=>'Foo', 'clss' => 'new', 'bar' =>'sure1', 'baz' => 'sure2'];
Sanitizer::ensureArrayHasKeys($dta, ['bar', 'baz', 'eagle'], 'is a Bird');

echo '<pre>';
var_dump($dta, true);