<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div id="app">
        <inertia-app :initial-page="{{ json_encode($page) }}" resolve-component="{{ $resolveComponent }}" />
    </div>
    <script src="{{ mix('js/bootstrap.js') }}"></script>
</body>
</html>