<?php

namespace App\View\Components\Adminlte;

use Illuminate\View\Component;

class Userlayout extends Component
{

    /**
     * Manthabill v.2.0
     * Date: 18-12-2021
     * Author:AlexisDev
     * Email: alexistdev@gmail.com
     * Phone: 0813-7982-3241
     */

    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }


    public function render()
    {
        return view('components.adminlte.userlayout');
    }
}
