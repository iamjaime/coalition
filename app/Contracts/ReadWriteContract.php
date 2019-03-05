<?php

namespace App\Contracts;

interface ReadWriteContract
{
    /**
     * Handles reading a JSON file's contents.
     *
     * @param $path
     * @return mixed
     */
    function readJSON($path);


    /**
     * Handles writing to a JSON file.
     *
     * @param $jsonToWrite
     * @param $path
     * @return mixed
     */
    function writeJSON($jsonToWrite, $path);
}
