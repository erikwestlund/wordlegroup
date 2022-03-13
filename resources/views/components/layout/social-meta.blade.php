@push('meta')
<meta property="og:title" content="{{ $title }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:url" content="{{ $url }}">

<meta property="og:description" content="{{ Str::length($slot->toHtml()) != 0 ? $slot : $description }}">
<meta property="og:type" content="{{ $type }}">
@endpush
