@extends('layouts.app')

@section('content')
    <x-layout.page-container heading="419" title="419: Session Expired" heading-class="text-6xl font-bold" class="mt-12">

        <div class="text-gray-600 text-center">Refresh the page.</div>

        <x-error-page.call-to-action />

    </x-layout.page-container>
@endsection

