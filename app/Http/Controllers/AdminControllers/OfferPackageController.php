<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfferPackages;

class OfferPackageController extends Controller
{
    public function index()
    {
        $list = OfferPackages::all();
        return view('Offer_package.index',compact('list'));
    }
}
