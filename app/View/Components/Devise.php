<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cookie;

class Devise extends Component
{
    /**
     * Create a new component instance.
     */
   

    public function __construct()
    {
        
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
       
        $pays =  request()->cookie('countryName') ?? "TN";
        if($pays == "TN"){
            $devise = "DT";
        }else{
            $devise = "€";
        }
        return view('components.devise', ['devise' => $devise]);
    }


    
}
