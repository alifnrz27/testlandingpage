<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use App\Models\subdomain;

class BillingController extends Controller
{
    public function index()
    {
        $bussinessOwner = User::where(['subdomain_id'=> auth()->user()->subdomain_id, 'role_id' => 2])->first();
        $brand = Brand::where('user_id', $bussinessOwner->id)->first();

        $data['url'] = "";
        if (auth()->check()) {
            $subdomain = subdomain::where([
                'id' => auth()->user()->subdomain_id
            ])->first();

            $subdomainOrDomain = $subdomain->name;
            $data['url'] = $subdomain->name;
        }
        $data['expired_date'] = $brand->expired_date;

        return view('billing', $data)->extends('layouts.auth');
    }
}
