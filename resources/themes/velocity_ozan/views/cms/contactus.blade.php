@extends('shop::layouts.master')

@section('page_title')
    @lang('velocity::app.contactus.title')
@endsection

@section('head')
    <meta name="title" content="@lang('velocity::app.contactus.title')" />
@endsection

@section('content-wrapper')
    <!-- Contact ============================= -->
    <section class="contact">
        <div class="auto__container">
            <div class="contact_wrap offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                <div class="contact_title">
                    @lang('velocity::app.contactus.title')
                </div>
                <div class="row col-12">
                    @if(isset($message))
                        <div class="alert alert-info">
                            {{$message}}
                        </div>
                    @endif
                </div>
                <form action="{{route('velocity.contact.send')}}" class="contact_form" method="POST">
                    @csrf
                    <div class="contact_input">
                        <label for="name">@lang('velocity::app.contactus.name')</label>
                        <input type="text" name="name" id="name" placeholder="@lang('velocity::app.contactus.name_placeholder')">
                    </div>

                    <div class="contact_input">
                        <label for="mail">@lang('velocity::app.contactus.contact')</label>
                        <input type="text" name="contact" id="mail" placeholder="@lang('velocity::app.contactus.contact_placeholder')">
                    </div>

                    <div class="contact_input">
                        <label for="subject">@lang('velocity::app.contactus.subject')</label>
                        <input type="text" name="subject" id="subject" placeholder="@lang('velocity::app.contactus.subject_placeholder')">
                    </div>

                    <div class="contact_input">
                        <label for="gapja">@lang('velocity::app.contactus.gapja')</label>
                        <img src="data:image/jpg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDABYPERMRDhYTEhMZFxYaITckIR4eIUQwMyg3UEZUU09GTUxYY39sWF54X0xNbpZweIOHjpCOVmqcp5uKpn+Ljon/2wBDARcZGSEdIUEkJEGJW01biYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYn/wAARCAA5ASwDASIAAhEBAxEB/8QAGwABAAIDAQEAAAAAAAAAAAAAAAQGAgMFAQf/xAAtEAABBAIBAwMEAQQDAAAAAAAAAQIDBAUREiExQQYTURUiYXEUMjORwUKx0f/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwC3AAAAAAAAAAACNZv1au/enYxU8KpWcPlfez88kljUTto1HL00BbwYxyMkbyY5HJ8opovXq9CJJLD+LVXSASQaq1iO1A2aFyOY5NoptAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABVREVVXSJ3UDl5DP0cfN7Mr3OkTu1ib0Q4vV2Pe/i9ksf5VCvZGzSZ6hW1HynjR+3tXyv4N2VzMF6FyMxaJpP7ip1T/AF2rWYbUSSwSI9i+UIF/PUqE3szOdz8oidjkehXOWOyiqvFFTSeCd6sq134uSd7GpK3XF2uoEC76gtXrCV8Q1da6v0bvTOTt2bcte49XOYnYk+lKcEWMZOxPvkT7lU4N219J9TvmZ1Zv7kTyigWezgqVmV8srFc935KjjcZDPnJacjla1qrxVC80b9a/D7leRHJ5TyhV/UdGxQyDclTRdL1dpOygd3GYl2OWRI7DnMcnRHeFORmP50tR8ORqq9jV22WLro5CepMglps3Lt3Z4UuuLvsydJs3Djvo5qgc30l7bab2R2PcRF3x8tO+U7LwS4HJNvVOkMi/c3wWfHXYr9Vk8S9FTqnwoEoAAAAAAAAAAAAAAAAAAAAAAIi5GD6ilFOSy8eS6ToiASwAAAAAAADCaP3YXxquke1W7/AGZgD55CyfB5J62aSTInbabT9opLv52zkKzoKlH22qn3qjdqXdWtd/UiL+0PGxsbvixqb76QD5/gZ8nFKkFNio17vuVWnczTsreY6lHT+zpuRfJZUa1vZET9IegVnD4PIwM4z21jj10Y1TY30lWdIr7E8krl+SxACJj8bWx0asrs477r5UlKiOTTkRU+FPQBEdjaTn81rR8vniez0o31nQxKsO+u2dNKSgBVclhMtLA6NtxJ41/4u7nPxs2RwEjkmrPdE7uhejxzGvTTmoqflAIWLykOSjV0SOare6KhOMIoYoUX22NZvvpDMAAAAAAAAAAAAAAAAARsjZWpRlnam1Y3aEk4mT+qyPnrsrMmryt0xyORFb+wMcYly5AlyW8vsyN2rGprj+lI2CoMs/y7k75ducrWSc1ReKfk2WGvw/pxtZVR1iT7GtRe6r8Hterk5cfDSSFtSJE1I9X7cqfhEAxp5p9THTSWnOm4yKyFfLzRk7OXgxzbr7aQPe5OMDWp2X/Zuv4y1Hk6S1ayTVYG9Gq5ERHfKmOXx+Us5GpIxjJeC8l3/bb17a7qB0qqWocMx1izxkVvOSR/VWp+Dm4Z1+xRs2LV6RlRdqx6656TzvwhJytDIWq0FJJObZX8rEvZGomuiJ8f+GWbo2p6lfG0GIyBekj96RrU8AQMFZyE+PsTWbjm1I9qkq9Xrr4Un+l325cV7tmSSRXyKrHPXaq3p/vZpzuOtfS62PxsXKJF1JpUTonz+ztU2Sx12skaxmk0jGdmprtvyBvAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADGWRIo3PciqjU3pqbX/BkAKrNa+oeo6z5oLEdWD+hXRO+535+Ov/AEWoAAAAAAAAAD//2Q==">
                        <input type="text" name="gapja" id="gapja" placeholder="@lang('velocity::app.contactus.gapja_placeholder')">
                    </div>

                    <div class="contact_message">
                        <label for="message">@lang('velocity::app.contactus.message')</label>
                        <textarea id="message" name="message" placeholder="@lang('velocity::app.contactus.message_placeholder')"></textarea>
                    </div>

                    <button class="contact_btn" type="submit">
                        @lang('velocity::app.contactus.send')
                    </button>
                </form>
            </div>
        </div>
    </section>
    <!-- Contact end ========================= -->
@endsection