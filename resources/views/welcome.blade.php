@extends('layouts.website')

@section('content')
    <main class="bg-gray-50 flex flex-col gap-24 pt-20 pb-32">
            <x-web-hero-section />

            <x-web-features-section />

            <x-web-steps-section />

            <x-web-gallery-section />
    </main>
    @endsection
