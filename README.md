# Artlogic Frontend Task

**Time Spent:** `4-5Hrs` (Note that I have not written CSS for at least 3-4 years, hence needed to spent a bit more time)

**Preview Task:** [distractionless.com/artlogic](https://distractionless.com/artlogic)

### Notes:

- The page is hosted on my personal Linode Server using Laravel PHP Framework.
- PHP Laravel is only used for getting the `data.json` file which can be found in the [/public](https://github.com/code-karma/distractionless/tree/master/public) folder (the background image is there as well).
- The source code containing the **HTML/JS/CSS** for the task (all embeeded in one page with no external .js/.css files) can be found here: [/resources/views/artlogic.blade.php](https://github.com/code-karma/distractionless/blob/master/resources/views/artlogic.blade.php)
- Even though it was mentioned not to use any css frameworks, I did use a very basic `normalize.css` grid for the centered container only.
- I used Vanilla JS only.
- I used Blade Templating tags (executed on the server side) to loop through the `data.json` building the FAQ Content. I thought that using JS for that is not very SEO friendly:)

### PHP Code used to grab `data.json`

```PHP
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
```


