<script
    type="text/javascript"
    baseUrl="{{ url()->to('/') }}"
    src="{{ asset('themes/velocity_ozan/assets/js/ozan.js') }}">
</script>

<script
    type="text/javascript"
    baseUrl="{{ url()->to('/') }}"
    src="{{ asset('themes/velocity_ozan/assets/js/main.js') }}">
</script>

<script
    type="text/javascript"
    src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}">
</script>

<script
    type="text/javascript"
    src="{{ asset('themes/velocity/assets/js/jquery.ez-plus.js') }}">
</script>
<script type="text/javascript">
    (() => {
        window.showAlert = (messageType, messageLabel, message) => {
            if (messageType && message !== '') {
                let alertId = Math.floor(Math.random() * 1000);

                let html = `<div class="alert ${messageType} alert-dismissible" id="${alertId}">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>${messageLabel ? messageLabel + '!' : ''} </strong> ${message}.
                </div>`;

                $('#alert-container').append(html).ready(() => {
                    window.setTimeout(() => {
                        $(`#alert-container #${alertId}`).remove();
                    }, 5000);
                });
            }
        }

        let messageType = '';
        let messageLabel = '';

        @if ($message = session('success'))
            messageType = 'alert-success';
            messageLabel = "{{ __('velocity::app.shop.general.alert.success') }}";
        @elseif ($message = session('warning'))
            messageType = 'alert-warning';
            messageLabel = "{{ __('velocity::app.shop.general.alert.warning') }}";
        @elseif ($message = session('error'))
            messageType = 'alert-danger';
            messageLabel = "{{ __('velocity::app.shop.general.alert.error') }}";
        @elseif ($message = session('info'))
            messageType = 'alert-info';
            messageLabel = "{{ __('velocity::app.shop.general.alert.info') }}";
        @endif

        if (messageType && '{{ $message }}' !== '') {
            window.showAlert(messageType, messageLabel, '{{ $message }}');
        }

        window.serverErrors = [];
        @if (isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif

        window._translations = @json(app('Webkul\Velocity\Helpers\Helper')->jsonTranslations());
    })();
</script>

@stack('scripts')

<script>
    {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
</script>
<script type='text/javascript'>
    (function(d, w, m) {
        window.supportAPIMethod = m;
        var s = d.createElement('script');
        s.type ='text/javascript'; s.id = 'supportScript'; s.charset = 'utf-8';
        s.async = true;
        var id = 'e6c2dd844d696688cf46bdbb93796ee0';
        s.src = '//me-talk.ru/support/support.js?h='+id;
        var sc = d.getElementsByTagName('script')[0];
        w[m] = w[m] || function() { (w[m].q = w[m].q || []).push(arguments); };
        if (sc) sc.parentNode.insertBefore(s, sc);
        else d.documentElement.firstChild.appendChild(s);
    })(document, window, 'MeTalk');
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter85380733 = new Ya.Metrika({
                    id:85380733,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true,
                    ecommerce:"dataLayer"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6HSL6DZ02W"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-6HSL6DZ02W');
</script>