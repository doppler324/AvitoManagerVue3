<?php

namespace App\Components\Avito;

use App\Models\CategoryModel;
use Illuminate\Support\Facades\Http;

trait CategoryAvitoTrait
{
    public $text = "";

    public function __construct()
    {

    }

    /**
     * Возвращает список категорий Авито
     * @return mixed
     */
    public function loadCategory($text = array(), $k = 1)
    {


    }
}
