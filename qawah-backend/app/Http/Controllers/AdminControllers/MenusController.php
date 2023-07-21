<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class MenusController extends Controller
{
    public function index()
    {
        // Using Helper 
        $public_menu = \Menu::getByName('Public'); //return array
        // return $public_menu;
        return view('menus');
    }
}
