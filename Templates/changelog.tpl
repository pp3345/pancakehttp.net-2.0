{include file='./header.tpl'}

            <a class="pull-right" href="#" id="hide-minor">Hide minor releases</a>
            <h1>Changelog</h1>

            {foreach $versions as $version}
                {if $version->major}
                    {$class = "major"}
                {else}
                    {$class = "minor"}
                {/if}
                <div class="{$class}" id="{$version->version}">
                    <h2>Pancake {$version->version} ({$version->release|date_format:"%Y-%m-%d"})</h2>
                    {if $version->longDescription}
                        <span>{$version->longDescription}</span>
                        <br/><br/>
                    {/if}

                    <ul>
                    {foreach $version->getChangelog() as $change}
                        <li>{$change->content}</li>
                    {/foreach}
                    </ul>
                </div>
            {/foreach}

{include file='./footer.tpl'}
