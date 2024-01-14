<?php

namespace App\Http\Controllers;
use App\Models\Portofolio;
use App\Models\Partner;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data['url'] = "";
        if (auth()->check()) {
            $data['url'] = getSubdomainOrDomainFromURL();
        }
        $data['partners'] = Partner::get();
        $data['clp'] = Portofolio::where(['type' => 1])->with(['features'])->get();
        $data['enterprise'] = Portofolio::where(['type' => 2])->with(['features'])->get();
        return view('welcome', $data)->extends('layouts.auth');
    }

    public function getSubdomainOrDomainFromURL() {
        $host = $_SERVER['HTTP_HOST'];
        $domainParts = explode('.', $host);

        // Menghilangkan "www" jika ada
        if ($domainParts[0] === 'www') {
            array_shift($domainParts);
        }

        // Mengambil subdomain pertama atau domain utama
        // $subdomainOrDomain = $domainParts[0];
        $subdomainOrDomain = implode(".", $domainParts);

        return $subdomainOrDomain;
    }
}
