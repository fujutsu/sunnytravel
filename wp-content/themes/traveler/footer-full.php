<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Footer custom full
 *
 * Created by ShineTheme
 *
 */
    if(is_page_template("template-login.php")){
        if(has_nav_menu('login')){
            wp_nav_menu(array('theme_location'=>'login',
                "container"=>"",
                'items_wrap'      => '<ul class="%2$s footer-links">%3$s</ul>',
            ));
        }
    }
    if(is_page_template("template-commingsoon.php")){

        echo get_post_meta(get_the_ID(),'footer_social',true);

    }
    if(is_404()){
        if(has_nav_menu('login')){
            wp_nav_menu(array('theme_location'=>'login',
                "container"=>"",
                'items_wrap'      => '<ul class="%2$s footer-links">%3$s</ul>',
            ));
        }
    }
?>
          </div>
       </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
<!-- CleverCallback -->
<script src="https://my.clevercallback.com/callback.js" async type="text/javascript" charset="utf-8"></script>
<!-- CleverCallback -->
</div>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111428196-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111428196-1');
</script>
</body>
</html>
