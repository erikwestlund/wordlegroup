@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="403" title="403: Forbidden" heading-class="text-6xl font-bold" class="mt-12">

        <div class="text-gray-600 text-center">This page is private.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

