{include file='./header.tpl'}

        <h1>Download Pancake</h1>

        <a class="btn btn-success btn-download" href="/latest">
            <span>Pancake {$latest}</span>
            <br/>
            <span>Get the latest stable build of Pancake.</span>
        </a>
        <a class="btn btn-danger btn-download" href="http://ci.pp3345.net/job/Pancake/" target="_blank">
            <span>Bleeding edge</span>
            <br/>
            <span>Get the latest bleeding edge build of Pancake. Use at your own risk!</span>
        </a>
        <a class="btn btn-info btn-download" href="/changelog">
            <span>Changelog</span>
            <br/>
            <span>Want to know what's new in Pancake? Have a look at the changelog!</span>
        </a>

        <h2>System requirements</h2>
        <ul>
            <li>Linux >= 2.6.9</li>
            <li>PHP >= 5.4.0 (PHP >= 5.4.10 recommended)</li>
            <li>i686 or x86_64 processor or Raspberry Pi</li>
            <li>OpenSSL >= 0.9.8 for HTTPS <i>(optional)</i></li>
        </ul>

        <h2>Donate</h2>
        <p>Pancake is developed by a sole person. If you love your tasty Pancake, support keeping it alive by donating a few bucks. :-)</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="89CFQ7SFX3MWY">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
        </form>

        <h2>Help!</h2>
        <p>If you encounter any problems or questions, please don't hesitate to write a mail to <a href="mailto:support@pancakehttp.net">support@pancakehttp.net</a>. I'll be glad to help you. :-)</p>
{include file='./footer.tpl'}
