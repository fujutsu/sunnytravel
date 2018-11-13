<?php
/*
    Plugin Name: Plugin Header Output
    Plugin URI:
    Description: Page Header Output
    Version: 1.0
    Author: Somebody
    Author URI: http://xxxxxx.xx/
    License: GPLv2
*/
add_action ('wp_head', 'page_header_output');
function page_header_output() { ?>

            <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-99663318-1', 'auto');
  ga('send', 'pageview');

</script>

<?php }