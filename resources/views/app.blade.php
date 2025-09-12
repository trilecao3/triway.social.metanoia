<!DOCTYPE html>
<html lang="vi">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GYNPWR882L"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-GYNPWR882L');
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Metanoia III') }}</title>

        <meta property="og:site_name" content="{{ config('app.name', 'Metanoia III') }}" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="2400" />
        <meta property="og:image:height" content="1260" />
        <meta property="og:url" content="https://triway.social/metanoia" />
        <link rel="canonical" href="https://triway.social/metanoia" />
        <meta property="og:title" content="Sự Kiện Metanoia III – The Tri Way x Triway Social" />
        <meta name="twitter:title" content="Sự Kiện Metanoia III – The Tri Way x Triway Social">
        <meta name="description" content="Tham gia sự kiện Metanoia III của The Tri Way ngày 26.10.2025. Nơi ý tưởng chuyển mình, con người gặp gỡ và sự đổi thay bắt đầu. Website: triway.social/metanoia" />
        <meta property="og:description" content="Tham gia sự kiện Metanoia III của The Tri Way ngày 26.10.2025. Nơi ý tưởng chuyển mình, con người gặp gỡ và sự đổi thay bắt đầu. Website: triway.social/metanoia" />
        <meta name="twitter:description" content="Tham gia sự kiện Metanoia III của The Tri Way ngày 26.10.2025. Nơi ý tưởng chuyển mình, con người gặp gỡ và sự đổi thay bắt đầu. Website: triway.social/metanoia">
        <meta property="og:image" content="https://triway.social/metanoia/images/KV_Metanoia_III_OG_link_preview_image.jpg" />
        <meta name="twitter:image" content="https://triway.social/metanoia/images/KV_Metanoia_III_OG_link_preview_image.jpg">
          
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <link rel="manifest" href="/favicons/site.webmanifest">

        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased text-black">
        @inertia
    </body>
</html>
