<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{--    ************** Bootstrap CSS ***************--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{--    ************** DataTable CSS ***************--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    {{--    ************** Dashboard CSS & Customization ***************--}}
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
    <style>
        .row>*{
            flex-shrink: unset!important;
        }
    </style>
</head>
<body>
