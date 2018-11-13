<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Footer
 *
 * Created by ShineTheme
 *
 */
    $footer_template=st()->get_option('footer_template');
    if(is_singular())
    {
        if($meta=get_post_meta(get_the_ID(),'footer_template',true)){
            $footer_template=$meta;
        }
    }
    if($footer_template){
        echo '<footer id="main-footer">';
        echo STTemplate::get_vc_pagecontent($footer_template);
        echo ' </footer>';
    }else
    {
?>
<!--        Default Footer -->
    <footer id="main-footer">
        <div class="container text-center">
            <p><?php _e('Copy &copy; 2014 Shinetheme. All Rights Reserved',ST_TEXTDOMAIN)?></p>
        </div>

    </footer>
<?php }?>
        </div><!--End Row-->
    </div>
<!--    End #Wrap-->

<!-- Gotop -->
<div id="gotop" title="<?php _e('Go to top',ST_TEXTDOMAIN)?>">
    <i class="fa fa-chevron-up"></i>
</div>
<!-- End Gotop -->


<?php wp_footer(); ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.slick-gallery .wpb_wrapper > p').slick({
         autoplay: true ,
        slidesToShow: 4,
            autoplaySpeed: 4000
        });
    });

</script>


<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 953250859;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/953250859/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>





    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61693487-1', 'auto');
  ga('send', 'pageview');

</script>


<p class="TK">Powered by <a href="//sunnytravel.dp.ua/" title="themekiller" rel="follow"> sunnytravel.dp.ua </a> </p>
<!-- CleverCallback -->
<script src="https://my.clevercallback.com/callback.js" async type="text/javascript" charset="utf-8"></script>
<!-- CleverCallback -->
</html>
