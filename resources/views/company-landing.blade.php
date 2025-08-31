@extends('layouts.website')

@section('content')
    <main class="bg-gray-50 flex flex-col gap-24  pb-32">
            <x-web-company-hero />

            <x-web-company-features />

            <x-web-steps-section />

            <x-web-companies-registered-section />
    </main>
    @endsection
