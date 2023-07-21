<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PageSections;
use App\InnerBanner;
use App\Slider;

class PageController extends Controller
{
  
    public function index()
    {
        $data = PageSections::where("page_id",1)->get();
        $dt["slider"] = Slider::first();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        return view('front.views.home',$dt);
    }
    public function Premium_Features()
    {
        $data = PageSections::where("page_id",3)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
       return view('front.views.Premium_Features',$dt);
    }
    public function qavah_gold()
    {
        $data = PageSections::where("page_id",4)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
       return view('front.views.qavah_gold',$dt);
    }
    public function qavah_platinum()
    {
        $data = PageSections::where("page_id",5)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        // return $dt;
       return view('front.views.qavah_platinum',$dt);
    }
    public function qavah_live()
    {
        $data = PageSections::where("page_id",6)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        // return $dt;
       return view('front.views.qavah_live',$dt);
    }
    public function qavah_court()
    {
        $data = PageSections::where("page_id",7)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        // return $dt;
       return view('front.views.qavah_court',$dt);
    }
    public function about()
    {
        $data = PageSections::where("page_id",10)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        // return $dt;
       return view('front.views.about',$dt);
    }
    public function support()
    {
        $data = PageSections::where("page_id",9)->get();
        $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        // return $dt;
       return view('front.views.support',$dt);
    }
    public function safty()
    {
        $data = PageSections::where("page_id",8)->get();
         $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        
        // return $dt;
       return view('front.views.safty',$dt);
    }
    public function terms()
    {
        $data = PageSections::where("page_id",11)->get();
         $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        
       return view('front.views.terms   ',$dt);
    }
    public function privacy()
    {
        $data = PageSections::where("page_id",12)->get();
         $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        
       return view('front.views.privacy   ',$dt);
    }
    public function contact()
    {
        $data = PageSections::where("page_id",13)->get();
         $dt["sections"] = $data->pluck('id', 'section_name')->mapWithKeys(function ($id, $section_name) use ($data) {
            foreach ($data as $section) {
                if ($section->section_name === $section_name) {
                    return [$section_name => $section];
                }
            }
        });
        
       return view('front.views.contact',$dt);
    }
}
