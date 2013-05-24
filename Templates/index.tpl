{include file='./header.tpl'}

            <div class="jumbo-center">
                <h1>This is Pancake.</h1>

                <p class="lead">
                    Pancake is modern. Pancake is fast. Pancake is tasty.
                </p>

                <a class="btn btn-large btn-success" href="/latest">
                    Download now
                </a>
            </div>

            <div class="row">
                <div class="span3">
                    <h2>What is Pancake?</h2>
                    <p>
                        Pancake is a lightweight and modern HTTP server that comes with its own PHP Server API and interfaces for FastCGI and AJP13.
                        With its modern server architecture Pancake is capable of handling very high concurrency loads along with many other features - try it out!
                    </p>
                </div>
                <div class="span3">
                    <h2>CodeCache</h2>
                    <p>
                        Pancake offers the best PHP execution performance you've ever seen. Optimizing your web application for usage with CodeCache technology will result in a significant performance improvement.
                    </p>
                </div>
                <div class="span3">
                    <a href="/rss" class="pull-right" style="margin-top: 14px"><img src="/img/rss.png" alt="RSS" /></a>
                    <h2>Latest releases</h2>
                    {foreach $versions as $version}
                        <a href="/changelog#{$version->version}" class="version-small">
                            <h4>{$version->version}</h4>
                            {$version->shortDescription}
                        </a>
                        <hr />
                    {/foreach}
                </div>
            </div>

{include file='./footer.tpl'}
