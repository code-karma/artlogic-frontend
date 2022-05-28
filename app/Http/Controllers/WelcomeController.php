<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class WelcomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $url = 'https://distractionless.com/data.json';

    public static function getJsonData() {
        $json = json_decode(file_get_contents(self::$url), true);
        //var_dump($json);
        return $json;
    }

    /**
     * Show the application splash screen.
     *
     * @return Response
     */
    public function showApp()
    {
        $data = self::getJsonData();
        return view('artlogic', ['params' => $data]);
    }
}
