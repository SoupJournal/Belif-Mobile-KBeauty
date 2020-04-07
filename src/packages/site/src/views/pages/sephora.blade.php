<!doctype html>
<html lang="en">
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        {{ HTML::style($assetPath . '/css/sephora.css') }}

        <title>Sephora</title>

    </head>

    <body>

        <!-- Global site tag (gtag.js) - Google Ads: 711349582 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-711349582"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'AW-711349582');
        </script>

        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '220888885086120');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=220888885086120&ev=PageView&noscript=1"
            /></noscript>
        <!-- End Facebook Pixel Code -->

        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="top-spacer">&nbsp;</div>
                    <h1>BELIF</h1>
                    <h2>The True Cream Aqua Bomb Aloe Vera</h2>
                    <h3>limited edition &bull; exclusive</h3>

                    <div class="image">
                        &nbsp;
                    </div>

                    <div class="price">$38.00</div>
                    <div class="description">SIZE 1.68 oz/ 50mL</div>
                </div>
                <div class="row justify-content-md-center buttons">
                    <button class="button red"><a href="{{ $redirectUrl }}">BUY FROM SEPHORA</a></button>
                    <button class="button"><a href="#">BUY FROM BELIFUSA.COM</a></button>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>