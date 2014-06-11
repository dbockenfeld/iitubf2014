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
                <h3>Blog</h3>
                <section class="item-right">
                    <article class="blog">
                        <p class="home-blog-title">Uncommon</p>
                        <p class="home-blog-date">March 19, 2014</p>
                        <p class="home-blog-author">Author: Dan Bockenfeld</p>
                        <p class="home-blog-summary">We are happy to announce our 2014 Easter Event entitled Uncommon, which will be happening on April 19-20 on the campus of the Illinois Institute of Technology.</p>
                    </article>
                    <article class="blog">
                        <p class="home-blog-title">Limitless</p>
                        <p class="home-blog-date">October 3, 2013</p>
                        <p class="home-blog-author">Author: Dan Bockenfeld</p>
                        <p class="home-blog-summary">God's love is amazing. It doesn't have any limits and just when you think that there isn't any more room, God shows you just how much more there is.</p>
                    </article>
                </section>
            </section>
            <section class="item homepage">
                <h3>Facebook</h3>
                <section class="item-right">
                    <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fiitubf&amp;width=352&amp;colorscheme=light&amp;show_faces=true&amp;stream=true&amp;header=false&amp;height=555" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:360px; height:555px;" allowTransparency="true"></iframe>
                </section>
            </section>
        </section>
    </section>
</section>
