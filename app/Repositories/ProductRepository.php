<?php

namespace App\Repositories;

use App\Contracts\ReadWriteContract;
use App\Contracts\Repositories\ProductRepository as ProductInterface;

class ProductRepository implements ProductInterface
{
    public $readerWriter;

    public function __construct(ReadWriteContract $readWrite)
    {
        $this->readerWriter = $readWrite;
    }


    /**
     * Handles saving the Product to a file
     *
     * @param $path
     * @param $data
     * @return mixed
     */
    public function saveToFile($path, $data)
    {
       $products = collect($data['products'])->sortByDesc('created_at')->values()->all();
       $data['products'] = $products;

       $existingJSON = $this->readerWriter->readJSON($path);

       foreach($data as $key => $val){
           $existingJSON[$key] = $val;
       }

       $writeToJSON = $this->readerWriter->writeJSON($existingJSON, $path);

       return $writeToJSON;
    }


    /**
     * Handles reading the JSON from the file
     *
     * @param $path
     * @return mixed
     */
    public function readFromFile($path)
    {
        $existingJSON = $this->readerWriter->readJSON($path);
        return $existingJSON;
    }
}
