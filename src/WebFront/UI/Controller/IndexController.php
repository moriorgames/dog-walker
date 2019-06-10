<?php

namespace WebFront\UI\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function handle(): Response
    {
        $port = getenv('PORT');
        $content = <<< HTML
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <title>React App</title>
    <style>
        .button__container {
    margin-top: 200px;
            text-align: center
        }

        .button {
    background-color: green;
            border: none;
            color: #fff;
            font-size: 16px;
            height: 40px;
            width: 200px
        }

        body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        code {
    font-family: source-code-pro, Menlo, Monaco, Consolas, Courier New, monospace
        }
    </style>
</head>
<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="root">
    <div>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/click_me">ClickMe</a></li>
        </ul>
        <hr>
        <div class="button__container">
            <button class="button">Click Me</button>
            <p>Application: PHP Backend: $port</p></div>
    </div>
</div>
</body>
</html>
HTML;

        return new Response($content);
    }
}
