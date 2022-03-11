@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="401" title="401: Unauthorized" heading-class="text-6xl font-bold" class="mt-12">

        <div class="text-gray-600 text-center">You are not authorized to view this page.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

