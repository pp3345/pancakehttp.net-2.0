<?xml version="1.0" encoding="utf-8"?>

<rss version="2.0">
    <channel>
        <title>Pancake</title>
        <link>http://pancakehttp.net/</link>
        <description>Pancake release feed</description>
        <language>en</language>
        <copyright>Yussuf Khalil</copyright>

        {foreach $versions as $version}
            <item>
                <title>Pancake {$version->version}</title>
                <description>{$version->longDescription}</description>
                <link>http://pancakehttp.net/changelog#{$version->version}</link>
                <author>Yussuf Khalil</author>
                <pubDate>{$version->release|date_format:"%Y-%m-%d"}</pubDate>
            </item>
        {/foreach}
    </channel>
</rss>
