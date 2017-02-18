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
     * @return mixed
     */
    public static function baseSave($sModel, $sName)
    {
        $sFullPath = 'App\Http\Controllers\\' . ucfirst($sModel) . 'Controller';
        if (file_exists($sFullPath)) {
            return $sFullPath::save($sModel, $sName);
        }

        return Controller::save($sModel, $sName);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function save($sModel, $sName)
    {
        $aParent = explode('-', $_POST['parent']);
        $sParent = 'fk_' . $aParent[0];
        $sFullModelPath = 'App\Models\\' . ucfirst($sModel);

        $aPostUser = array();
        $aTags = array();

        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];

        $oObject = $sFullModelPath::where('url', $sName)->get()->first();

        $oObject->name = $_POST['title'];
        $oObject->description = $_POST['description'];
        $oObject->shortDescription = $_POST['short-description'];
        $oObject->$sParent = $aParent[1];

        $oObject->knownBy()->sync($aPostUser);
        if (count($aTags) >= 1) $oObject->tags()->sync($aTags);

        $oObject->save();

        return redirect()->route('single', [$sModel, $oObject->url]);
    }

    /**
     * @param $sModel
     * @return mixed
     */
    public static function baseCreate($sModel)
    {
        $sFullPath = 'App\Http\Controllers\\' . ucfirst($sModel) . 'Controller';
        if (file_exists($sFullPath)) {
            return $sFullPath::create($sModel);
        }

        return Controller::create($sModel);
    }

    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aParent = explode('-', $_POST['parent']);
        $sFullModelPath = 'App\Models\\' . ucfirst($sModel);

        $aTags = array();
        $aPostUser = array();

        if (isset($_POST['tags'])) $aTags = $_POST['tags'];
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $sFullModelPath::create([
            'fk_' . $aParent[0] => $aParent[1],
            'name' => $_POST['title'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL($sFullModelPath, $_POST['title'])
        ]);

        $oObject = $sFullModelPath::all()->last();
        $oObject->knownBy()->sync($aPostUser);

        if (count($aTags) >= 1) $oObject->tags()->sync($aTags);

        return redirect()->route('single', [$sModel, $oObject->url]);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return mixed|string
     */
    public static function createURL($sModel, $sName)
    {
        $sURL = str_replace(' ', '-', strtolower($sName));
        $iURLCount = $sModel::where('name', $sURL)->get()->count();
        if ($iURLCount >= 1) {
            $sURL .= '-' . ++$iURLCount;
        }

        return $sURL;
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
     * @param null $sParentModel
     * @param null $sParameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($sModel, $sParentModel = null, $sParameter = null)
    {
        if (isset($_POST['object-type'])) $sModel = $_POST['object-type'];
        $sFullModel = 'App\Models\\' . ucfirst($sModel);

        if ($sParentModel == null) $sParentModel = $sFullModel::first()->parent->getModel();

        $sParentURL = $sParameter;
        if ($sModel == 'realm') {
            $sParentModel = 'dashboard';
            $sParentURL = '';
        }

        return view('create.' . strtolower($sModel), [
            'sModel' => $sModel,
            'sParentModel' => $sParentModel,
            'sParentURL' => $sParentURL,
            'sParameter' => $sParameter,
            'oObject' => new $sFullModel
        ]);
    }
}
