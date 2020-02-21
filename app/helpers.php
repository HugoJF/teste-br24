<?php

if (!function_exists('rename_array')) {
    /**
     * Returns a human readable file size
     *
     * @param $original
     * @param $renames
     *
     * @return array
     *
     */
    function rename_array($original, $renames)
    {
        $result = [];

        foreach ($original as $key => $value) {
            $newKey = $renames[ $key ] ?? $key;
            $result[ $newKey ] = $original[ $key ];
        }

        return $result;
    }
}
