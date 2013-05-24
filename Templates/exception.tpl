<!doctype html>
<html>
    <head>
        <title>Exception</title>
        <style>
            body {
                margin: 50px;
                border: 2px solid #f00;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        An unexpected exception occured while trying to build the page you requested.
        <br/><br/>
        {get_class($exception)}
        <br/>
        {$exception->getMessage()}
        <br/><br/>
        Stack trace:
        <br/>
        <pre>{$exception->getTraceAsString()}</pre>
    </body>
</html>
