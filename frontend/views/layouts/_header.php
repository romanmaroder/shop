<?php

use frontend\widgets\CategoriesWidget;
use frontend\widgets\MainNavCategoriesWidget;
use yii\helpers\Html;
use yii\helpers\Url;


?>


<header class='header'>

    <!-- Top Bar -->

    <div class='top_bar'>
        <div class='container'>
            <div class='row'>
                <div class='col d-flex flex-row align-items-center'>
                    <div class='top_bar_contact_item'>
                        <div class='top_bar_icon'><img src=<?= Yii::getAlias('@web/images/phone.png') ?> alt=''>
                        </div>
                        +38 068 005 3570
                    </div>
                    <div class='top_bar_contact_item'>
                        <div class='top_bar_icon'><img src=<?= Yii::getAlias('@web/images/mail.png') ?> alt=''>
                        </div>
                        <a href='mailto:fastsales@gmail.com'>fastsales@gmail.com</a></div>
                    <div class='top_bar_content ml-auto'>
                        <div class='top_bar_menu'>
                            <ul class='standard_dropdown top_bar_dropdown'>
                                <li>
                                    <a href='#'>English<i class='fas fa-chevron-down'></i></a>
                                    <ul>
                                        <li><a href='#'>Italian</a></li>
                                        <li><a href='#'>Spanish</a></li>
                                        <li><a href='#'>Japanese</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'>$ US dollar<i class='fas fa-chevron-down'></i></a>
                                    <ul>
                                        <li><a href='#'>EUR Euro</a></li>
                                        <li><a href='#'>GBP British Pound</a></li>
                                        <li><a href='#'>JPY Japanese Yen</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class='top_bar_user'>
                            <div class='user_icon'>
                                <img src=<?= Yii::getAlias('@web/images/user.svg') ?> alt=''>
                            </div>
                            <?php
                            if (Yii::$app->user->isGuest)  : ?>
                                <div class="top_bar_signup"><a href="<?= Url::to(['/auth/signup/request']) ?>">Signup</a></div>
                                <div><a href="<?= Url::to(['/auth/auth/login']) ?>">Login</a></div>
                            <?php
                            else : ?>
                                <?php
                                echo '<div class="top_bar_logout">' . Html::beginForm(['/auth/auth/logout'], 'post')
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'border-0']
                                    )
                                    . Html::endForm() . '</div>'; ?>
                            <?php
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main -->

    <div class='header_main'>
        <div class='container'>
            <div class='row'>
                <!-- Logo -->
                <div class='col-lg-2 col-sm-3 col-3 order-1'>
                    <div class='logo_container'>
                        <div class='logo'><a href='<?= Html::encode(Url::home()); ?>'>OneTech</a></div>
                    </div>
                </div>

                <!-- Search -->
                <div class='col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right'>
                    <div class='header_search'>
                        <div class='header_search_content'>
                            <div class='header_search_form_container'>
                                <form action='#' class='header_search_form clearfix'>
                                    <input type='search' required='required' class='header_search_input'
                                           placeholder='Search for products...'>
                                    <div class='custom_dropdown'>
                                        <div class='custom_dropdown_list'>
                                            <span class='custom_dropdown_placeholder clc'>All Categories</span>
                                            <i class='fas fa-chevron-down'></i>
                                            <ul class='custom_list clc'>
                                                <li><a class='clc' href='#'>All Categories</a></li>
                                                <li><a class='clc' href='#'>Computers</a></li>
                                                <li><a class='clc' href='#'>Laptops</a></li>
                                                <li><a class='clc' href='#'>Cameras</a></li>
                                                <li><a class='clc' href='#'>Hardware</a></li>
                                                <li><a class='clc' href='#'>Smartphones</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type='submit' class='header_search_button trans_300' value='Submit'>
                                        <img src=<?= Yii::getAlias('@web/images/search.png') ?> alt=''></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wishlist -->
                <div class='col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right'>
                    <div class='wishlist_cart d-flex flex-row align-items-center justify-content-end'>
                        <div class='wishlist d-flex flex-row align-items-center justify-content-end'>
                            <div class='wishlist_icon'><img
                                    src=<?= Yii::getAlias('@web/images/heart.png') ?> alt=''></div>
                            <div class='wishlist_content'>
                                <div class='wishlist_text'><a href='#'>Wishlist</a></div>
                                <div class='wishlist_count'>115</div>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class='cart'>
                            <div class='cart_container d-flex flex-row align-items-center justify-content-end'>
                                <div class='cart_icon'>
                                    <img src= <?= Yii::getAlias('@web/images/cart.png') ?> alt=''>
                                    <div class='cart_count'><span>10</span></div>
                                </div>
                                <div class='cart_content'>
                                    <div class='cart_text'><a href='#'>Cart</a></div>
                                    <div class='cart_price'>$85</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->

    <nav class='main_nav'>
        <div class='container'>
            <div class='row'>
                <div class='col'>

                    <div class='main_nav_content d-flex flex-row'>

                        <!-- Categories Menu -->

                        <div class='cat_menu_container'>
                            <div class='cat_menu_title d-flex flex-row align-items-center justify-content-start'>
                                <div class='cat_burger'><span></span><span></span><span></span></div>
                                <div class='cat_menu_text'>categories</div>
                            </div>
                            <?= MainNavCategoriesWidget::widget([
                                'active' => $this->params['active_category'] ?? null
                            ]) ?>
                        </div>

                        <!-- Main Nav Menu -->

                        <div class='main_nav_menu ml-auto'>
                            <ul class='standard_dropdown main_nav_dropdown'>
                                <li><a href='<?= Html::encode(Url::home()); ?>'>Home<i class='fas fa-chevron-down'></i></a>
                                </li>
                                <li class='hassubs'>
                                    <a href='#'>Super Deals<i class='fas fa-chevron-down'></i></a>
                                    <ul>
                                        <li>
                                            <a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                            <ul>
                                                <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a></li>
                                    </ul>
                                </li>
                                <li class='hassubs'>
                                    <a href='#'>Featured Brands<i class='fas fa-chevron-down'></i></a>
                                    <ul>
                                        <li>
                                            <a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                            <ul>
                                                <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                                </li>
                                                <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='#'>Menu Item<i class='fas fa-chevron-down'></i></a></li>
                                    </ul>
                                </li>
                                <li class='hassubs'>
                                    <a href='#'>Pages<i class='fas fa-chevron-down'></i></a>
                                    <ul>
                                        <li><a href='<?= Html::encode(
                                                Url::to(['/shop/catalog/index'])
                                            ); ?>'>Catalog<i class='fas fa-chevron-down'></i></a>
                                        </li>
                                        <?php if (!Yii::$app->user->isGuest):?>
                                        <li><a href='<?= Html::encode(
                                            Url::to(['/cabinet/default/index'])
                                        ); ?>'>Cabinet<i class='fas fa-chevron-down'></i></a>
                                        </li>
                                        <?php endif;?>
                                        <li><a href='product.html'>Product<i
                                                    class='fas fa-chevron-down'></i></a>
                                        </li>
                                        <li><a href='blog.html'>Blog<i class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='blog_single.html'>Blog Post<i
                                                    class='fas fa-chevron-down'></i></a>
                                        </li>
                                        <li><a href='regular.html'>Regular Post<i
                                                    class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='cart.html'>Cart<i class='fas fa-chevron-down'></i></a></li>
                                        <li><a href='contact.html'>Contact<i
                                                    class='fas fa-chevron-down'></i></a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href='blog.html'>Blog<i class='fas fa-chevron-down'></i></a></li>
                                <li><a href='contact.html'>Contact<i class='fas fa-chevron-down'></i></a></li>
                            </ul>
                        </div>

                        <!-- Menu Trigger -->

                        <div class='menu_trigger_container ml-auto'>
                            <div class='menu_trigger d-flex flex-row align-items-center justify-content-end'>
                                <div class='menu_burger'>
                                    <div class='menu_trigger_text'>menu</div>
                                    <div class='cat_burger menu_burger_inner'>
                                        <span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Menu -->

    <div class='page_menu'>
        <div class='container'>
            <div class='row'>
                <div class='col'>

                    <div class='page_menu_content'>

                        <div class='page_menu_search'>
                            <form action='#'>
                                <input type='search' required='required' class='page_menu_search_input'
                                       placeholder='Search for products...'>
                            </form>
                        </div>
                        <ul class='page_menu_nav'>
                            <li class='page_menu_item has-children'>
                                <a href='#'>Language<i class='fa fa-angle-down'></i></a>
                                <ul class='page_menu_selection'>
                                    <li><a href='#'>English<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Italian<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Spanish<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Japanese<i class='fa fa-angle-down'></i></a></li>
                                </ul>
                            </li>
                            <li class='page_menu_item has-children'>
                                <a href='#'>Currency<i class='fa fa-angle-down'></i></a>
                                <ul class='page_menu_selection'>
                                    <li><a href='#'>US Dollar<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>EUR Euro<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>GBP British Pound<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>JPY Japanese Yen<i class='fa fa-angle-down'></i></a></li>
                                </ul>
                            </li>
                            <li class='page_menu_item'>
                                <a href=<?= Html::encode(Url::home());?>>Home<i class='fa fa-angle-down'></i></a>
                            </li>
                            <li class='page_menu_item has-children'>
                                <a href='#'>Super Deals<i class='fa fa-angle-down'></i></a>
                                <ul class='page_menu_selection'>
                                    <li><a href='#'>Super Deals<i class='fa fa-angle-down'></i></a></li>
                                    <li class='page_menu_item has-children'>
                                        <a href='#'>Menu Item<i class='fa fa-angle-down'></i></a>
                                        <ul class='page_menu_selection'>
                                            <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                            <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                            <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                            <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                </ul>
                            </li>
                            <li class='page_menu_item has-children'>
                                <a href='#'>Featured Brands<i class='fa fa-angle-down'></i></a>
                                <ul class='page_menu_selection'>
                                    <li><a href='#'>Featured Brands<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                </ul>
                            </li>
                            <li class='page_menu_item has-children'>
                                <a href='#'>Trending Styles<i class='fa fa-angle-down'></i></a>
                                <ul class='page_menu_selection'>
                                    <li><a href='#'>Trending Styles<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                    <li><a href='#'>Menu Item<i class='fa fa-angle-down'></i></a></li>
                                </ul>
                            </li>
                            <li class='page_menu_item'><a href='blog.html'>blog<i class='fa fa-angle-down'></i></a>
                            </li>
                            <li class='page_menu_item'><a href='contact.html'>contact<i
                                        class='fa fa-angle-down'></i></a></li>
                        </ul>

                        <div class='menu_contact'>
                            <div class='menu_contact_item'>
                                <div class='menu_contact_icon'><img
                                        src=<?= Yii::getAlias('@web/images/phone_white.png') ?> alt=''>
                                </div>
                                +38 068 005 3570
                            </div>
                            <div class='menu_contact_item'>
                                <div class='menu_contact_icon'><img
                                        src=<?= Yii::getAlias('@web/images/mail_white.png') ?> alt=''></div>
                                <a href='mailto:fastsales@gmail.com'>fastsales@gmail.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>



