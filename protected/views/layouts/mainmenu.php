<?php /* @var $this Controller */ ?>

<!--mainmenu-->
<nav class="top-bar" data-topbar data-options="is_hover: true">
    <ul class="title-area">
        <li class="name">
            <h1><a href="<?php echo Yii::app()->createUrl('/site/index'); ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1>
        </li>

        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <ul class="left">
            <li>
                <a href="<?php echo Yii::app()->createUrl('/site/index'); ?>">Home</a>
            </li>

            <li>
                <a href="<?php echo Yii::app()->createUrl(''); ?>">Contact us</a>
            </li>

            <li class="has-form">
                <div class="ya-site-form ya-site-form_inited_no" onclick="return {
                        'action':'http://yandex.ru/sitesearch','arrow':false,'bg':'transparent','fontsize':12,'fg':'#000000','language':'ru','logo':'rb',
                        'publicname':'Search','suggest':true,'target':'_self','tld':'ru','type':2,'usebigdictionary':true,/*'searchid':2166227,*/'webopt':false,'websearch':false,
                        'input_fg':'#000000','input_bg':'#ffffff','input_fontStyle':'normal','input_fontWeight':'normal','input_placeholder':'Search',
                        'input_placeholderColor':'#999999','input_borderColor':'#ccffff'
                        }">

                    <div class="row collapse ">
                        <form action="http://yandex.ru/sitesearch" method="get" target="_self">
                            <input type="hidden" name="searchid" value="2166227"/>
                            <input type="hidden" name="l10n" value="ru"/>
                            <input type="hidden" name="reqenc" value=""/>
                            <div class="large-8 small-9 columns">
                                <input type="text" name="text" value=""/>
                            </div>
                            <div class="large-4 small-3 columns">
                                <input class="alert button expand" type="submit" value="Search"/>
                            </div>
                        </form>

                        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/yandex_search.js"></script>
                    </div>
                </div>
            </li>
        </ul>

        <!-- Right Nav Section -->
        <ul class="right">
            <?php if(!Yii::app()->user->isGuest): ?>
                <li>
                    <!-- user role -->
                    <a href="<?php echo Yii::app()->createUrl(''); ?>"><?php echo Yii::app()->user->role; ?></a>
                </li>
                <li>
                    <!-- user profile -->
                    <a href="<?php echo Yii::app()->createUrl(''); ?>"><?php echo Yii::app()->user->username; ?></a>
                </li>
                <li>
                    <!-- sign out -->
                    <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Logout</a>
                </li>
            <?php else: ?>
                <li>
                    <!-- sign in -->
                    <a href="<?php echo Yii::app()->createUrl('site/login'); ?>">Sign In</a>
                </li>
                <li>
                    <!-- sign up -->
                    <a href="<?php echo Yii::app()->createUrl('site/registrate'); ?>">Sign Up</a>
                </li>
            <?php endif; ?>

        </ul>

    </section>
</nav>   <!--mainmenu-->