<?php

class Excerpt
{
    public function doExcerpt($string, $length, $replacer)
    {
        if (strlen($string) > $length) {
            return (preg_match('/^(.*),\W.*$/', substr($string, 0, $length + 1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
        }

        return $string;
    }
}
