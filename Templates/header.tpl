<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Pancake HTTP Server</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="description" content="Pancake is a lightweight and fast web server created by Yussuf Khalil, mainly written in C, PHP and Moody." />
    <meta name="keywords" content="Pancake, HTTP, Server, Web, WWW, PHP, Zend, Zend Engine, IP, pp3345, Yussuf Khalil, SAPI, TCP, Unix, Linux, Sockets, PHP Acceleration, PHP Speed, Fast PHP, Technology" />

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/js/pancake.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" href="/css/bootstrap-responsive.min.css" media="screen" />
    <link rel="stylesheet" href="/css/pancakehttp.css" media="screen" />
    <link rel="shortcut icon" href="/img/logo-grey-tiny.png" type="image/png">

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-32694681-1']);
        _gaq.push(['_setDomainName', 'pancakehttp.net']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</head>
<body>


<div class="container">
    <div class="masthead">
        <ul class="nav nav-pills pull-right">
            {foreach $navElements as $text => $uri}
                {if $uri == $navElementActive}
                    <li class="active"><a href="{$uri}">{$text}</a></li>
                {else}
                    <li><a href="{$uri}">{$text}</a></li>
                {/if}

            {/foreach}
        </ul>
        <a id="logo" href="/"></a>
    </div>

    <hr />
