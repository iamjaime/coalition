<?php

namespace App\Utils;

use App\Contracts\ReadWriteContract;

class ReadWriteFile implements ReadWriteContract
{

    /**
     * Handles reading the JSON file.
     *
     * @param $path
     * @return mixed
     */
    public function readJSON($path)
    {
        $jsonString = file_get_contents(base_path($path));
        $data = json_decode($jsonString, true);

        return $data;
    }

    /**
     * Handles writing to a JSON file.
     *
     * @param $jsonToWrite
     * @param $path
     * @return bool|int|mixed
     */
    public function writeJSON($jsonToWrite, $path)
    {
        $newJsonString = json_encode($jsonToWrite, JSON_PRETTY_PRINT);
        $write = file_put_contents(base_path($path), stripslashes($newJsonString));

        return $write;
    }
}
