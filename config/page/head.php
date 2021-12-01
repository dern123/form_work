<?php

    // <!-- Facebook Pixel Code Start --!>
    if ($dataConfig['turnOnFacebookPixel'] === 'true')
        echo "<!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '" . $_SESSION['data']['FacebookPixel'] . "');
            setTimeout(function() {fbq('track', 'PageView'); }, 30000);
        </script>
        <noscript><img height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id=" . $_SESSION['data']['FacebookPixel'] . "&ev=PageView&noscript=1' /></noscript>
        <!-- End Facebook Pixel Code -->";
    // <!-- Facebook Pixel Code End --!>

    // <!-- Tiktok Pixel Code Start --!>
    if ($dataConfig['turnOnTiktokPixel'] === 'true')
        echo "<!-- Tiktok Pixel Code Start --!>
        <script>
            (function() {
                var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;
                ta.src = 'https://analytics.tiktok.com/i18n/pixel/sdk.js?sdkid=" . $_SESSION['data']['TiktokPixel'] . "';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ta, s);
            })();
        </script>
        <!-- Tiktok Pixel Code End --!>";
    // <!-- Tiktok Pixel Code End --!>

    // <!-- Replain Code Start --!>
    if ($dataConfig['turnOnReplain'] === 'true')
        echo "<!-- Replain Code -->
        <script>
            window.replainSettings = { id: '". $dataConfig['idReplain'] ."' };
            (function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
            var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
            })('https://widget.replain.cc/dist/client.js');
        </script>
        <!-- Replain Code End --!>";
    // <!-- Replain Code End --!>

?>