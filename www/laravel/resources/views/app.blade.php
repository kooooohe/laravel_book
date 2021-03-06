@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Vue TODO</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script>
            window.Laravel = {};
            window.Laravel.csrfToken = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        <div id="app">
        </div>
        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
        <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>
@endsection
