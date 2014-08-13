<section class="featured">
    <section class="hero-image">
        <?php
        $this->widget('ext.displayHeroImage.displayHeroImage', array(
            'location' => 'homepage',
        ));
        ?>
    </section>
</section>
<section class="content">
    <section class="content-body zero-font">
        <section class="left50">
<?php $this->widget('ext.smallSermonList.smallSermonList'); ?>
            <section class="item homepage">
                <h3>Twitter</h3>
                <section class="item-right">
                    <a class="twitter-timeline" href="https://twitter.com/iitubf" data-widget-id="499377545481973760" width="395" height="297">Tweets by @iitubf</a>
                    <script>!function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = p + "://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");</script>

                </section>
            </section>
        </section>
        <section class="right50">
<?php $this->widget('ext.smallBlogList.smallBlogList'); ?>
            <section class="item homepage">
                <h3>Facebook</h3>
                <section class="item-right">
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id))
                                return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like-box" data-href="https://www.facebook.com/iitubf" data-width="395" data-height="579" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="false"></div>
                </section>
            </section>
        </section>
    </section>
</section>
