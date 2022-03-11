@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="404" title="404: Not Found" heading-class="text-6xl font-bold" class="mt-12">

        <div class="text-gray-600 text-center">This page could not be found.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

