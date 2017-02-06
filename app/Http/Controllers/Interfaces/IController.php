<?php

namespace App\Http\Controllers\Interfaces;

interface IController
{
    /**
     * IController constructor.
     */
    public function __construct();

    /**
     * @param $iObjectID
     * @return mixed
     */
    public function single($iObjectID);

    /**
     * @param $iObjectID
     * @return mixed
     */
    public function save($iObjectID);

    /**
     * @param $iObjectID
     * @return mixed
     */
    public function editor($iObjectID);
}