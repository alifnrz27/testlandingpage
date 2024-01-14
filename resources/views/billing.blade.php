@extends('layouts.app')

@section('content')

    <style>
        @media(prefers-color-scheme: dark){ .bg-dots{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(200,200,255,0.15)'/%3E%3C/svg%3E");}}@media(prefers-color-scheme: light){.bg-dots{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,50,0.10)'/%3E%3C/svg%3E")}}
    </style>

        <header class="site-header has-inline-mobile-toggle" id="masthead" aria-label="Site" itemtype="https://schema.org/WPHeader" itemscope="">
        <div class="inside-header grid-container flex justify-between" style="padding-top:20px">
            <div class="site-branding-container">
                <div class="site-logo">
                    <a href="https://dewabiz.com/" rel="home" class="flex gap-2 items-center">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_1062)">
                            <path d="M39.9448 21.4998H32.8002C26.5593 21.4998 21.5002 26.559 21.5002 32.7998V39.9444C31.3501 39.214 39.2144 31.3497 39.9448 21.4998Z" fill="white"/>
                            <path d="M18.5003 39.9444V32.7998C18.5003 26.559 13.4411 21.4998 7.20026 21.4998H0.0556641C0.785998 31.3497 8.65036 39.214 18.5003 39.9444Z" fill="white"/>
                            <path d="M39.9448 18.4998C39.2144 8.64987 31.3501 0.78551 21.5002 0.0551758V7.19977C21.5002 13.4406 26.5593 18.4998 32.8002 18.4998H39.9448Z" fill="white"/>
                            <path d="M18.5003 0.0551758C8.65036 0.78551 0.785998 8.64987 0.0556641 18.4998H7.20026C13.4411 18.4998 18.5003 13.4406 18.5003 7.19977V0.0551758Z" fill="white"/>
                            <path d="M13.583 19.9998C16.3555 18.6145 18.615 16.355 20.0002 13.5825C21.3855 16.355 23.6449 18.6145 26.4175 19.9998C23.6449 21.385 21.3855 23.6445 20.0002 26.417C18.615 23.6445 16.3555 21.385 13.583 19.9998Z" fill="#FFDE81"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_15_1062">
                            <rect width="40" height="40" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <div class="text-[16px] font-bold text-white">
                            Customer Loyalty
                        </div>
                    </a>
                </div>
                <div class="site-branding">
                    <p class="site-description" itemprop="description">Host Your Imagination</p>
                </div>
            </div>
            <div class="gb-container gb-container-86sdb48f top_toggle">
                <a class="gb-button gb-button-a6cdc417 slideout-toggle custom-slideout-toggle"><span class="gb-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 23 23" height="23" width="23"><path fill="white" d="M15.8167 2.86668L15.8167 3.17501C15.8167 4.36209 14.8455 5.33334 13.6584 5.33334L2.86675 5.33334C1.67966 5.33334 0.708414 4.36209 0.708414 3.17501L0.708414 2.86668C0.708414 1.67959 1.67966 0.708343 2.86675 0.708343L13.6584 0.708343C14.8455 0.708343 15.8167 1.67959 15.8167 2.86668ZM22.2917 11.5C22.2917 12.6871 21.3205 13.6583 20.1334 13.6583L2.86675 13.6583C1.67966 13.6583 0.708414 12.6871 0.708414 11.5C0.708414 10.3129 1.67966 9.34168 2.86675 9.34168L20.1334 9.34168C21.3205 9.34168 22.2917 10.3129 22.2917 11.5ZM9.95841 20.1333C9.95841 21.3204 8.98716 22.2917 7.80008 22.2917L2.86675 22.2917C1.67966 22.2917 0.708413 21.3204 0.708413 20.1333C0.708413 18.9463 1.67966 17.975 2.86675 17.975L7.80008 17.975C8.98716 17.975 9.95841 18.9463 9.95841 20.1333Z"></path></svg></span></a>
            </div>
            <div>
                <a class="gb-button gb-button-169c0c68" href="{{ route('register') }}"><span class="gb-button-text">Daftar</span><span class="gb-icon"><svg viewbox="0 0 16 16" class="bi bi-box-arrow-in-right" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" fill-rule="evenodd"></path><path d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" fill-rule="evenodd"></path></svg></span></a>
                @auth
                <a style="background-color: rgb(156 163 175 / var(--tw-bg-opacity));" class="gb-button gb-button-169c0c68 bg-gray-400" href="https://{{ $url }}/owner/login"><span class="gb-button-text">Dashoard</span></a>
                <a style="background-color: rgb(156 163 175 / var(--tw-bg-opacity));" class="gb-button gb-button-169c0c68 bg-gray-400" href="{{ route('billing') }}"><span class="gb-button-text">Billing</span></a>
                @else
                <a style="background-color: rgb(34 197 94 / var(--tw-bg-opacity));" class="gb-button gb-button-169c0c68 bg-green-500" href="{{ route('login') }}"><span class="gb-button-text">Login</span></a>
                @endif
            </div>
        </div>
        </header>
        <div class="site grid-container container hfeed" id="page">
            <div class="site-content" id="content">
                <div class="content-area" id="primary">
                    <main class="site-main" id="main"><article id="post-952" class="post-952 page type-page status-publish has-post-thumbnail" itemtype="https://schema.org/CreativeWork" itemscope="">
                    <div class="inside-article">
                        <div class="entry-content" itemprop="text">
                            <div class="gb-container gb-container-810232ea hero-bg">
                                <div class="gb-container gb-container-05b48212">
                                    <div class="gb-container gb-container-817472ee">
                                        <h1 class="gb-headline gb-headline-fb9f7042 gb-headline-text gb-headline-f6604367 gb-headline-f66df367 gb-headline-7301dfe8">Tanggal Expired Billing Anda</em></strong></h1>
                                        <p class="gb-headline gb-headline-359741ed gb-headline-text gb-headline-79df3c34 gb-headline-792c3c34">
                                            {{ $expired_date }}
                                        </p>
                                    </div>
                                    <div class="gb-container gb-container-00503323">
                                        {{-- <figure class="gb-block-image gb-block-image-83e79a88"><img fetchpriority="high" decoding="async" width="600" height="815" class="gb-image gb-image-83e79a88" src="./DewaBiz.com_ Web Hosting, Server &amp; Domain Murah_files/wp-heading.png" alt="" title="wp-heading" srcset="https://dewabiz.com/wp-content/uploads/2023/08/wp-heading.png 600w, https://dewabiz.com/wp-content/uploads/2023/08/wp-heading-221x300.png 221w, https://dewabiz.com/wp-content/uploads/2023/08/wp-heading-18x24.png 18w, https://dewabiz.com/wp-content/uploads/2023/08/wp-heading-27x36.png 27w, https://dewabiz.com/wp-content/uploads/2023/08/wp-heading-35x48.png 35w" sizes="(max-width: 600px) 100vw, 600px"></figure> --}}
                                        <svg width="250" height="250" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_15_1062)">
                                            <path d="M39.9448 21.4998H32.8002C26.5593 21.4998 21.5002 26.559 21.5002 32.7998V39.9444C31.3501 39.214 39.2144 31.3497 39.9448 21.4998Z" fill="white"/>
                                            <path d="M18.5003 39.9444V32.7998C18.5003 26.559 13.4411 21.4998 7.20026 21.4998H0.0556641C0.785998 31.3497 8.65036 39.214 18.5003 39.9444Z" fill="white"/>
                                            <path d="M39.9448 18.4998C39.2144 8.64987 31.3501 0.78551 21.5002 0.0551758V7.19977C21.5002 13.4406 26.5593 18.4998 32.8002 18.4998H39.9448Z" fill="white"/>
                                            <path d="M18.5003 0.0551758C8.65036 0.78551 0.785998 8.64987 0.0556641 18.4998H7.20026C13.4411 18.4998 18.5003 13.4406 18.5003 7.19977V0.0551758Z" fill="white"/>
                                            <path d="M13.583 19.9998C16.3555 18.6145 18.615 16.355 20.0002 13.5825C21.3855 16.355 23.6449 18.6145 26.4175 19.9998C23.6449 21.385 21.3855 23.6445 20.0002 26.417C18.615 23.6445 16.3555 21.385 13.583 19.9998Z" fill="#FFDE81"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_15_1062">
                                            <rect width="40" height="40" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                </div>
                                <div class="gb-shapes">
                                    <div class="gb-shape gb-shape-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1200 218" preserveaspectratio="none"><path d="M0 218h1200v-31.3l-40 4.4c-40 4.8-120 13.1-200 0-80-13.6-160-48.6-240-66.7-80-17.8-160-17.8-240-8.8-80 8.6-160 26.9-240 8.8-80-17.7-160-71.1-200-97.7L0 0v218z"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </article></main>
                </div>
            </div>
        </div>
        <nav id="generate-slideout-menu" class="main-navigation slideout-navigation offside offside--right" itemtype="https://schema.org/SiteNavigationElement" itemscope="">
        <div class="inside-navigation grid-container grid-parent">
            <button class="slideout-exit has-svg-icon"><span class="gp-icon pro-close">
            <svg viewbox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
            <path d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z"></path>
            </svg>
            </span><span class="screen-reader-text">Close</span></button>
            <div class="main-nav">
                <ul id="menu-mobile-off-canvas" class=" slideout-menu">
                    <li id="menu-item-48799" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48799">
                        <a href="{{ route('register') }}" class="menu-image-title-after menu-image-not-hovered"><span class="menu-image-title-after menu-image-title">Register</span><span class="description"></span></a>
                    </li>
                    @auth
                    <li id="menu-item-48799" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48799">
                        <a href="https://{{ $url }}/dashboard" class="menu-image-title-after menu-image-not-hovered"><span class="menu-image-title-after menu-image-title">Dashboard</span><span class="description"></span></a>
                    </li>
                    <li id="menu-item-48799" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48799">
                        <a href="{{ route('billing') }}" class="menu-image-title-after menu-image-not-hovered"><span class="menu-image-title-after menu-image-title">Billing</span><span class="description"></span></a>
                    </li>
                    @else
                    <li id="menu-item-48799" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48799">
                        <a href="{{ route('login') }}" class="menu-image-title-after menu-image-not-hovered"><span class="menu-image-title-after menu-image-title">Login</span><span class="description"></span></a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
        </nav>
        <div class="slideout-overlay"></div>
@endsection
