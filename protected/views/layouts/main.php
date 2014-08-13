<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <title><?php echo $this->pageTitle; ?></title>
        <?php if ($this->siteDescription) : ?>
            <meta name="description" content="<?php echo $this->siteDescription; ?>">
            <?php endif; ?>
            <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
            <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.defuscate.js'); ?>
            <script>
                $(document).ready(function() {
                    $('.obfuscated').defuscate();
                });
            </script>
            <script>
                (function(i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function() {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-5732686-1', 'auto');
                ga('send', 'pageview');

            </script>
            <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset_uni.css"/>
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome/css/font-awesome.min.css"/>
            <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/universal.css"/>
            <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/nav.css"/>
            <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/footer.css"/>
            <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    </head>

    <body>
        <header>
            <nav>
                <section class="logo">
                    <a class="logo-image" href="<?php echo Yii::app()->createUrl('/site/index'); ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/common/iitubf_logo.svg"/>
                    </a>
                </section>
                <section class="main">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Sermons', 'url' => array('/site/sermons')),
                            array('label' => 'Blog', 'url' => array('/site/blog')),
                            array('label' => 'Daily Bread', 'url' => array('/site/dailybread')),
                        ),
                    ));
                    ?>
                </section>
                <section class="about">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Contact', 'url' => array('/site/contact')),
                            array('label' => 'About', 'url' => array('/site/about')),
                            array('label' => 'Resources', 'url' => array('/site/resources')),
                        ),
                    ));
                    ?>
                </section>
            </nav>
        </header>

<?php echo $content; ?>

        <div class="clear"></div>

        <footer>
            <section class="main-footer">
                <section class="left-footer">
                    <section>
                        <p>University Bible Fellowship at IIT</p>
                        <p>3148 S Indiana Avenue<br/>
                            Chicago, IL 60616<br/>
                            <span class="obfuscated">iitubf( at )gmail.com</span></p>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/common/worship_in_the_godbox_logo.svg"/>
                        <p>&copy;<?php echo date('Y'); ?> IIT UBF</p>
                    </section>
                </section>
                <section class="middle-footer">
                    <section>
                        <p><i class="fa fa-facebook"></i><a href="http://www.facebook.com/iitubf">IIT UBF</a></p>
                        <p><i class="fa fa-twitter"></i><a href="http://www.twitter.com/iitubf">@iitubf</a></p>
                    </section>
                </section>
                <section class="right-footer">
                    <section>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/common/iitubf_update_logo.svg"/>
                        <p>Sign up for our weekly newsletter.</p>
                        <!-- Begin MailChimp Signup Form -->
                        <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
                            <style type="text/css">
                                #mc_embed_signup{clear:left; }
                                #mc_embed_signup .mc-field-group {min-height: inherit;}
                                #mc_embed_signup .mc-field-group input {
                                    padding: 3px 0;
                                }
                                #mc_embed_signup .mc-field-group label {
                                    font-size: 13px;
                                }
                                #mc_embed_signup .left50, #mc_embed_signup .right50 {
                                    display: inline-block;
                                    width: 46.4%;
                                    margin-right: 10px;
                                    vertical-align: top;
                                }
                                /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                                   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                            </style>
                            <div id="mc_embed_signup">
                                <form action="http://iitubf.us5.list-manage1.com/subscribe/post?u=48f6c762e0ed4066a87626bd7&amp;id=635a9b89ec" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                    <div class="mc-field-group">
                                        <label for="mce-EMAIL">Email Address </label>
                                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                                    </div>
                                    <div class="mc-field-group left50">
                                        <label for="mce-FNAME">First Name </label>
                                        <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
                                    </div>
                                    <div class="mc-field-group right50">
                                        <label for="mce-LNAME">Last Name </label>
                                        <input type="text" value="" name="LNAME" class="required" id="mce-LNAME">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_48f6c762e0ed4066a87626bd7_635a9b89ec" value=""></div>
                                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                </form>
                            </div>
                            <script type="text/javascript">
                                var fnames = new Array();
                                var ftypes = new Array();
                                fnames[0] = 'EMAIL';
                                ftypes[0] = 'email';
                                fnames[1] = 'FNAME';
                                ftypes[1] = 'text';
                                fnames[2] = 'LNAME';
                                ftypes[2] = 'text';
                                try {
                                    var jqueryLoaded = jQuery;
                                    jqueryLoaded = true;
                                } catch (err) {
                                    var jqueryLoaded = false;
                                }
                                var head = document.getElementsByTagName('head')[0];
                                if (!jqueryLoaded) {
                                    var script = document.createElement('script');
                                    script.type = 'text/javascript';
                                    script.src = '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
                                    head.appendChild(script);
                                    if (script.readyState && script.onload !== null) {
                                        script.onreadystatechange = function() {
                                            if (this.readyState == 'complete')
                                                mce_preload_check();
                                        }
                                    }
                                }

                                var err_style = '';
                                try {
                                    err_style = mc_custom_error_style;
                                } catch (e) {
                                    err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
                                }
                                var head = document.getElementsByTagName('head')[0];
                                var style = document.createElement('style');
                                style.type = 'text/css';
                                if (style.styleSheet) {
                                    style.styleSheet.cssText = err_style;
                                } else {
                                    style.appendChild(document.createTextNode(err_style));
                                }
                                head.appendChild(style);
                                setTimeout('mce_preload_check();', 250);

                                var mce_preload_checks = 0;
                                function mce_preload_check() {
                                    if (mce_preload_checks > 40)
                                        return;
                                    mce_preload_checks++;
                                    try {
                                        var jqueryLoaded = jQuery;
                                    } catch (err) {
                                        setTimeout('mce_preload_check();', 250);
                                        return;
                                    }
                                    var script = document.createElement('script');
                                    script.type = 'text/javascript';
                                    script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
                                    head.appendChild(script);
                                    try {
                                        var validatorLoaded = jQuery("#fake-form").validate({});
                                    } catch (err) {
                                        setTimeout('mce_preload_check();', 250);
                                        return;
                                    }
                                    mce_init_form();
                                }
                                function mce_init_form() {
                                    jQuery(document).ready(function($) {
                                        var options = {errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function() {
                                            }, onfocusout: function() {
                                            }, onblur: function() {
                                            }};
                                        var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
                                        $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
                                        options = {url: 'http://iitubf.us5.list-manage.com/subscribe/post-json?u=48f6c762e0ed4066a87626bd7&id=635a9b89ec&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                                            beforeSubmit: function() {
                                                $('#mce_tmp_error_msg').remove();
                                                $('.datefield', '#mc_embed_signup').each(
                                                        function() {
                                                            var txt = 'filled';
                                                            var fields = new Array();
                                                            var i = 0;
                                                            $(':text', this).each(
                                                                    function() {
                                                                        fields[i] = this;
                                                                        i++;
                                                                    });
                                                            $(':hidden', this).each(
                                                                    function() {
                                                                        var bday = false;
                                                                        if (fields.length == 2) {
                                                                            bday = true;
                                                                            fields[2] = {'value': 1970};//trick birthdays into having years
                                                                        }
                                                                        if (fields[0].value == 'MM' && fields[1].value == 'DD' && (fields[2].value == 'YYYY' || (bday && fields[2].value == 1970))) {
                                                                            this.value = '';
                                                                        } else if (fields[0].value == '' && fields[1].value == '' && (fields[2].value == '' || (bday && fields[2].value == 1970))) {
                                                                            this.value = '';
                                                                        } else {
                                                                            if (/\[day\]/.test(fields[0].name)) {
                                                                                this.value = fields[1].value + '/' + fields[0].value + '/' + fields[2].value;
                                                                            } else {
                                                                                this.value = fields[0].value + '/' + fields[1].value + '/' + fields[2].value;
                                                                            }
                                                                        }
                                                                    });
                                                        });
                                                $('.phonefield-us', '#mc_embed_signup').each(
                                                        function() {
                                                            var fields = new Array();
                                                            var i = 0;
                                                            $(':text', this).each(
                                                                    function() {
                                                                        fields[i] = this;
                                                                        i++;
                                                                    });
                                                            $(':hidden', this).each(
                                                                    function() {
                                                                        if (fields[0].value.length != 3 || fields[1].value.length != 3 || fields[2].value.length != 4) {
                                                                            this.value = '';
                                                                        } else {
                                                                            this.value = 'filled';
                                                                        }
                                                                    });
                                                        });
                                                return mce_validator.form();
                                            },
                                            success: mce_success_cb
                                        };
                                        $('#mc-embedded-subscribe-form').ajaxForm(options);


                                    });
                                }
                                function mce_success_cb(resp) {
                                    $('#mce-success-response').hide();
                                    $('#mce-error-response').hide();
                                    if (resp.result == "success") {
                                        $('#mce-' + resp.result + '-response').show();
                                        $('#mce-' + resp.result + '-response').html(resp.msg);
                                        $('#mc-embedded-subscribe-form').each(function() {
                                            this.reset();
                                        });
                                    } else {
                                        var index = -1;
                                        var msg;
                                        try {
                                            var parts = resp.msg.split(' - ', 2);
                                            if (parts[1] == undefined) {
                                                msg = resp.msg;
                                            } else {
                                                i = parseInt(parts[0]);
                                                if (i.toString() == parts[0]) {
                                                    index = parts[0];
                                                    msg = parts[1];
                                                } else {
                                                    index = -1;
                                                    msg = resp.msg;
                                                }
                                            }
                                        } catch (e) {
                                            index = -1;
                                            msg = resp.msg;
                                        }
                                        try {
                                            if (index == -1) {
                                                $('#mce-' + resp.result + '-response').show();
                                                $('#mce-' + resp.result + '-response').html(msg);
                                            } else {
                                                err_id = 'mce_tmp_error_msg';
                                                html = '<div id="' + err_id + '" style="' + err_style + '"> ' + msg + '</div>';

                                                var input_id = '#mc_embed_signup';
                                                var f = $(input_id);
                                                if (ftypes[index] == 'address') {
                                                    input_id = '#mce-' + fnames[index] + '-addr1';
                                                    f = $(input_id).parent().parent().get(0);
                                                } else if (ftypes[index] == 'date') {
                                                    input_id = '#mce-' + fnames[index] + '-month';
                                                    f = $(input_id).parent().parent().get(0);
                                                } else {
                                                    input_id = '#mce-' + fnames[index];
                                                    f = $().parent(input_id).get(0);
                                                }
                                                if (f) {
                                                    $(f).append(html);
                                                    $(input_id).focus();
                                                } else {
                                                    $('#mce-' + resp.result + '-response').show();
                                                    $('#mce-' + resp.result + '-response').html(msg);
                                                }
                                            }
                                        } catch (e) {
                                            $('#mce-' + resp.result + '-response').show();
                                            $('#mce-' + resp.result + '-response').html(msg);
                                        }
                                    }
                                }

                            </script>
                            <!--End mc_embed_signup-->
                    </section>
                </section>
            </section>
        </footer>
    </body>
</html>