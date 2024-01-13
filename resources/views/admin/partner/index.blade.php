@extends('layouts.app')

@section('content')

    <x-layouts.navbar/>
    <div class="w-full min-h-screen md:flex text-black bg-white dark:bg-dark-primary justify-between">
        <livewire:admin.partner />
    </div>

@endsection
