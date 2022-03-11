@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="503" title="503: Service Unavailable" heading-class="text-6xl font-bold" class="mt-12">

        <div class="text-gray-600 text-center">This service is currently unavailable. Try again soon.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

