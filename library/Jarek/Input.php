<?php
/**
 * Input filter class
 *
 * @author jarek
 */
namespace Jarek;

class Input
{
    const INTEGER = 1;
    const FLOAT   = 2;
    const STRING  = 4;
    const REGEXP  = 8;
 

    /**
     * Filter input
     *
     * @param  integer  $pattern
     * @param  string   $value
     * @param  string   $pattern
     * @return Input
     */
    public static function filter($type, $value, $pattern = null)
    {
        switch ($type) {
            case Input::INTEGER:
                $value = (int) $value;
                break;
            case Input::FLOAT:
                $value = (float) $value;
                break;
            case Input::STRING:
                $value = preg_replace('/[^a-zA-Z0-9\s]/u', '', (string) $value);
                break;
            case Input::REGEXP:
                $value = preg_replace($pattern, '', (string) $value);
                break;
        }
        return $value;
    }
}
