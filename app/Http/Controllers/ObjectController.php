<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 12.02.2017
 * Time: 19:07
 */

namespace App\Http\Controllers;

/**
 * Class ObjectController
 * @package App\Http\Controllers
 */
class ObjectController extends Controller
{
    /**
     * ObjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return redirect()->action(
            $_POST['object-type'] . 'Controller@creator', ['id' => null]
        );
    }
}