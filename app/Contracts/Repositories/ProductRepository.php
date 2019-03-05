<?php

namespace App\Contracts\Repositories;

interface ProductRepository
{

    /**
     * Handles saving to a file.
     *
     * @param $path
     * @param $data
     * @return mixed
     */
    public function saveToFile($path, $data);


    /**
     * Handles reading the file
     *
     * @param $path
     * @return mixed
     */
    public function readFromFile($path);

}
