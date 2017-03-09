<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\{
    Auth\Access\AuthorizesRequests, Bus\DispatchesJobs, Validation\ValidatesRequests
};
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $sModel
     * @param $sName
     * @return mixed|string
     */
    public static function createURL($sModel, $sName)
    {
        $sURL = str_replace(' ', '-', strtolower($sName));
        $sFullModel = 'App\Models\\' . ucfirst($sModel);
        $iURLCount = $sFullModel::where('name', $sURL)->get()->count();
        if ($iURLCount >= 1) {
            $sURL .= '-' . ++$iURLCount;
        }

        return $sURL;
    }
}
