<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">

    <link rel="stylesheet" href="{{bagisto_asset('css/font.css')}}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/main.css') }}">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">--}}

    @if ($favicon = core()->getCurrentChannel()->favicon_url)
        <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
        <link rel="icon" sizes="16x16" href="{{ bagisto_asset('images/favicon.ico') }}" />
    @endif

    @yield('head')

    @section('seo')
        @if (! request()->is('/'))
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @endif
    @show

    @stack('css')

    {!! view_render_event('bagisto.shop.layout.head') !!}

    <style>
        {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}

        /*.faq-section {
          background: #fdfdfd;
          min-height: 100vh;
          padding: 10vh 0 0;
        }
        .faq-title h2 {
          position: relative;
          margin-bottom: 45px;
          display: inline-block;
          font-weight: 600;
          line-height: 1;
        }
        .faq-title h2::before {
          content: "";
          position: absolute;
          left: 50%;
          width: 60px;
          height: 2px;
          background: #E91E63;
          bottom: -25px;
          margin-left: -30px;
        }
        .faq-title p {
          padding: 0 190px;
          margin-bottom: 10px;
        }

        .faq {
          background: #FFFFFF;
          box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
          border-radius: 4px;
          width: 60%;
        }

        .faq .card {
          border: none;
          background: none;
          border-bottom: 1px dashed #CEE1F8;
        }

        .faq .card .card-header {
          padding: 0px;
          border: none;
          background: none;
          -webkit-transition: all 0.3s ease 0s;
          -moz-transition: all 0.3s ease 0s;
          -o-transition: all 0.3s ease 0s;
          transition: all 0.3s ease 0s;
        }

        .faq .card .card-header:hover {
          background: #f5f5f5;
          padding-left: 10px;
          color:white;
        }

        .faq .card .card-header .faq-title {
          width: 100%;
          text-align: left;
          padding: 0px;
          padding-left: 30px;
          padding-right: 30px;
          font-weight: 400;
          font-size: 15px;
          letter-spacing: 1px;
          color: #3B566E;
          text-decoration: none !important;
          -webkit-transition: all 0.3s ease 0s;
          -moz-transition: all 0.3s ease 0s;
          -o-transition: all 0.3s ease 0s;
          transition: all 0.3s ease 0s;
          cursor: pointer;
          padding-top: 20px;
          padding-bottom: 20px;
        }

        .faq .card .card-header .faq-title .badge {
          display: inline-block;
          width: 20px;
          height: 20px;
          line-height: 14px;
          float: left;
          -webkit-border-radius: 100px;
          -moz-border-radius: 100px;
          border-radius: 100px;
          text-align: center;
          background: blue;
          color: #fff;
          font-size: 12px;
          margin-right: 20px;
        }

        .faq .card i {
          right: 2%;
          top: 40%;
        }


        .faq .card .card-body {
          padding: 30px;
          padding-left: 35px;
          padding-bottom: 16px;
          font-weight: 400;
          font-size: 16px;
          color: #6F8BA4;
          line-height: 28px;
          letter-spacing: 1px;
          border-top: 1px solid #F3F8FF;
          text-align: left;
          padding-top: 10px;
        }

        .faq .card .card-body p {
          margin-bottom: 14px;
        }

*/
    </style>

</head>


<body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">

<div id="app">

{!! view_render_event('bagisto.shop.layout.body.before') !!}

    {!! view_render_event('bagisto.shop.layout.header.before') !!}
    @include('shop::layouts.header.index')

    {!! view_render_event('bagisto.shop.layout.header.after') !!}


        <flash-wrapper ref='flashes'></flash-wrapper>


    {!! view_render_event('bagisto.shop.layout.content.before') !!}

    @yield('content-wrapper')

    {!! view_render_event('bagisto.shop.layout.content.after') !!}

    {!! view_render_event('bagisto.shop.layout.footer.before') !!}
    @include('shop::layouts.footer.footer')
    {!! view_render_event('bagisto.shop.layout.footer.after') !!}
    </div>
    <script type="text/javascript">
        window.flashMessages = [];

        @if ($success = session('success'))
            window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
        @elseif ($warning = session('warning'))
            window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
        @elseif ($error = session('error'))
            window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }];
        @elseif ($info = session('info'))
            window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}" }];
        @endif

        window.serverErrors = [];

        @if (isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif
    </script>
    <script type="text/javascript" src="{{ bagisto_asset('js/shop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
{{--    <script src="{{ bagisto_asset('js/jquery.js')}}"></script>--}}
    <script src="{{ bagisto_asset('js/slick.min.js')}}"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>--}}
    <script src="{{ bagisto_asset('js/main.js')}}"></script>

    @stack('scripts')

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    <div class="modal-overlay"></div>

    <script>
        {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
    </script>

</body>

</html>
