@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="500" title="500: Server Error" heading-class="text-6xl font-bold" class="mt-12">
        <x-layout.social-meta/>

        <div class="text-gray-600 text-center">Something went wrong. The site administrators have been notified.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

