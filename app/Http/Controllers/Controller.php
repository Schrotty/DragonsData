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
        $iURLCount = $sModel::where('url', $sURL)->get()->count();
        if ($iURLCount >= 1) {
            $sURL .= '-' . ++$iURLCount;
        }

        return $sURL;
    }

    /**
     * @param $sModel
     * @param $sName
     * @return mixed
     */
    public static function save($sModel, $sName)
    {
        $sFullPath = 'App\Http\Controllers\\' . ucfirst($sModel) . 'Controller';
        return $sFullPath::save($sModel, $sName);
    }

    /**
     * @param $sModel
     * @return mixed
     */
    public static function create($sModel)
    {
        $sFullPath = 'App\Http\Controllers\\' . ucfirst($sModel) . 'Controller';
        return $sFullPath::create($sModel);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($sModel, $sName)
    {
        $sFullModel = 'App\Models\\' . ucfirst($sModel);
        $oObject = $sFullModel::where('url', $sName)->get()->first();

        return view(strtolower($sModel), [
            'oObject' => $oObject, 'sModel' => $sModel
        ]);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($sModel, $sName)
    {
        $sFullModel = 'App\Models\\' . ucfirst($sModel);
        $oObject = $sFullModel::where('url', $sName)->get()->first();

        return view('edit.' . strtolower($sModel), [
            'oObject' => $oObject, 'sModel' => $sModel, 'sParentModel' => $oObject->getModel(), 'sParentURL' => $oObject->url
        ]);
    }

    /**
     * @param $sModel
     * @param $sParameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($sModel, $sParameter = null)
    {
        if (isset($_POST['object-type'])) $sModel = $_POST['object-type'];
        $sFullModel = 'App\Models\\' . ucfirst($sModel);
        $sParentModel = $sFullModel::first()->parent->getModel();
        $sParentURL = $sParameter;
        if ($sModel == 'realm') {
            $sParentModel = 'dashboard';
            $sParentURL = '';
        }

        return view('create.' . strtolower($sModel), [
            'sModel' => $sModel, 'sParentModel' => $sParentModel, 'sParentURL' => $sParentURL, 'sParameter' => $sParameter
        ]);
    }
}
