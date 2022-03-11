@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="429" title="429: Too Many Requests" heading-class="text-6xl font-bold" class="mt-12">

        <div class="text-gray-600 text-center">You are requesting pages too fast.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

