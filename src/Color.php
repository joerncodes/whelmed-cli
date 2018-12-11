<?php

namespace WhelmedCli;

class Color
{
    public function red($string)
    {
        return "\033[0;31m " . $string . " ";
    }

    public function white($string)
    {
        return "\033[1;37m " . $string . " ";
    }

    public function green($string)
    {
        return "\033[0;32m " . $string . " ";
    }

    public function darkgray($string)
    {
        return "\033[0;90m " . $string . " ";
    }

    public function cyan($string)
    {
        return "\033[0;36m " . $string . " ";
    }
}
