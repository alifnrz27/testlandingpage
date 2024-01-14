<?php

namespace App\Http\Controllers;
use App\Models\Portofolio;
use App\Models\Partner;
use App\Models\subdomain;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data['url'] = "";
        if (auth()->check()) {
            $subdomain = subdomain::where([
                'id' => auth()->user()->subdomain_id
            ])->first();

            $subdomainOrDomain = $subdomain->name;
            $data['url'] = $subdomain->name;
        }
        $data['partners'] = Partner::get();
        $data['clp'] = Portofolio::where(['type' => 1])->with(['features'])->get();
        $data['enterprise'] = Portofolio::where(['type' => 2])->with(['features'])->get();
        return view('welcome', $data)->extends('layouts.auth');
    }

}
