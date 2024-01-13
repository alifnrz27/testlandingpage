<?php

namespace App\Http\Controllers;
use App\Models\Portofolio;
use App\Models\Partner;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data['partners'] = Partner::get();
        $data['clp'] = Portofolio::where(['type' => 1])->with(['features'])->get();
        $data['enterprise'] = Portofolio::where(['type' => 2])->with(['features'])->get();
        return view('welcome', $data)->extends('layouts.auth');
    }
}
