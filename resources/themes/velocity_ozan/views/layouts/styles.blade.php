<link rel="stylesheet" href="{{ asset('themes/velocity_ozan/assets/css/bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('themes/velocity_ozan/assets/css/velocity.css') }}" />

<link rel="stylesheet" href="{{ asset('themes/velocity_ozan/assets/css/font.css') }}">

@stack('css')

<style>
    {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
</style>