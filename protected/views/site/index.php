<section class="featured">
    <section class="hero-image">
            <?php $this->widget('ext.displayHeroImage.displayHeroImage', array (
                'location' => 'homepage',
            )); ?>
    </section>
</section>
<section class="content">
    <section class="content-body zero-font">
        <section class="left50">
            <?php $this->widget('ext.smallSermonList.smallSermonList'); ?>
            <section class="item homepage">
                <h3>Twitter</h3>
                <section class="item-right">
                    <a class="twitter-timeline" data-dnt=true href="https://twitter.com/iitubf" data-widget-id="248774763600805888">Tweets by @iitubf</a>
                    <script>!function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//platform.twitter.com/widgets.js";
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
                    <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fiitubf&amp;width=352&amp;colorscheme=light&amp;show_faces=true&amp;stream=true&amp;header=false&amp;height=555" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:360px; height:555px;" allowTransparency="true"></iframe>
                </section>
            </section>
        </section>
    </section>
</section>
