<?php

namespace App\View\Components\Adminlte;

use Illuminate\View\Component;

class FooterLayout extends Component
{
    /**
     * Manthabill v.2.0
     * Date: 18-12-2021
     * Author:AlexisDev
     * Email: alexistdev@gmail.com
     * Phone: 0813-7982-3241
     */

    public $footertag;
    public $footersite;

    public function __construct($footertag,$footersite)
    {
        $this->footertag = $footertag;
        $this->footersite = $footersite;
    }


    public function render()
    {
        return view('components.adminlte.footer-layout');
    }
}
