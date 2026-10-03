<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Tower Realty Austin'))</title>
    @stack('head')
    <style>
        /* Refined hero entrance shared by every public website page. */
        .twr-wrap--anim .twr-hero .twr-anim,
        .twr-wrap--anim .twr-phero .twr-anim,
        .twr-ab--anim .twr-ab-hero .twr-ab-anim,
        .twr-ag--anim .twr-ag-hero .twr-ag-anim,
        .twr-co--anim .twr-co-hero .twr-co-anim,
        .twr-la--anim .twr-la-hero .twr-la-anim {
            opacity: 0;
            filter: blur(9px);
            transform: translateY(30px) scale(.985);
            transition-property: opacity, filter, transform;
            transition-duration: 1s;
            transition-timing-function: cubic-bezier(.16, 1, .3, 1);
            transition-delay: var(--d, 0s);
            will-change: opacity, filter, transform;
        }

        .twr-wrap--anim .twr-hero .twr-anim.is-in,
        .twr-wrap--anim .twr-phero .twr-anim.is-in,
        .twr-ab--anim .twr-ab-hero .twr-ab-anim.is-in,
        .twr-ag--anim .twr-ag-hero .twr-ag-anim.is-in,
        .twr-co--anim .twr-co-hero .twr-co-anim.is-in,
        .twr-la--anim .twr-la-hero .twr-la-anim.is-in {
            opacity: 1;
            filter: blur(0);
            transform: none;
        }

        @keyframes twrRise {
            from { opacity: 0; filter: blur(9px); transform: translateY(30px) scale(.985); }
            to { opacity: 1; filter: blur(0); transform: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            .twr-wrap--anim .twr-hero .twr-anim,
            .twr-wrap--anim .twr-phero .twr-anim,
            .twr-ab--anim .twr-ab-hero .twr-ab-anim,
            .twr-ag--anim .twr-ag-hero .twr-ag-anim,
            .twr-co--anim .twr-co-hero .twr-co-anim,
            .twr-la--anim .twr-la-hero .twr-la-anim {
                opacity: 1 !important;
                filter: none !important;
                transform: none !important;
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
