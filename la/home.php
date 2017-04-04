<?php
/***
 *Template name: Home
 */
?>

<?php get_header(); ?>
    <section class="testi">
        <div class="container">
            <div class="row cent">
                <div class="col-md-6 col-sm-12 text-center">
                    <h3><?php the_field("title_blok1");?></h3>
                    <span class="create"><?php the_field("podtitle_blok1");?>y</span>
                    <p class="desc"><?php the_field("descr_blok1");?></p>

                    <div class="testim">
                        <span class="name"><?php the_field("name_blok1");?></span>
                        <img src="<?php the_field("author");?>" alt="">
                        <span class="name"><?php the_field("fio_blok1");?></span>
                        <p class="cit"><?php the_field("cit_blok1");?></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 hidden-xs hov">
                    <div class="row">
                        <div class="col-md-6 col-xs-6 bor">
                            <img src="<?php the_field("jewel1");?>" alt="">
                        </div>
                        <div class="col-md-6 bor"><img src="<?php the_field("jewel2");?>" alt=""></div>
                    </div>
                    <div class="row pad">
                        <div class="col-md-6 bor">
                            <img src="<?php the_field("jewel3");?>" alt="">
                        </div>
                        <div class="col-md-6 bor"><img src="<?php the_field("jewel4");?>" alt=""></div>
                    </div>
                    <div class="uzor"><span>более<br><span class="num">40000</span><br><span class="akces">аксессуаров</span></span></div>
                </div>
            </div>
        </div>
    </section>


    <!--кто мы-->
    <section id="our" class="who">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">Наши преимущества</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <span class="spincrement"><?php the_field("number1");?></span>
                            <p><?php the_field("descr_number1");?></p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <span class="spincrement"><?php the_field("number2");?></span>
                            <p><?php the_field("descr_number2");?></p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <span class="spincrement"><?php the_field("number3");?></span>
                            <p><?php the_field("descr_number3");?></p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <span class="spincrement"><?php the_field("number4");?></span>
                            <p><?php the_field("descr_number4");?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="collect" class="products_head">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">Наши коллекции</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h3><?php the_field("categ1");?></h3>
                            <a href="<?php the_field("collect_link1");?>">
                                <img src="<?php the_field("collect_image1");?>" alt=""></a>
                            <a href="<?php the_field("collect_link1");?>" class="btnall">Подробнее</a>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3><?php the_field("categ2");?></h3>
                            <a href="<?php the_field("collect_link2");?>">
                                <img src="<?php the_field("collect_image2");?>" alt=""></a>
                            <a href="<?php the_field("collect_link2");?>" class="btnall">Подробнее</a>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3><?php the_field("categ3");?></h3>
                            <a href="<?php the_field("collect_link3");?>">
                                <img src="<?php the_field("collect_image3");?>" alt=""></a>
                            <a href="<?php the_field("collect_link3");?>" class="btnall">Подробнее</a>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3><?php the_field("categ4");?></h3>
                            <a href="<?php the_field("collect_link4");?>">
                                <img src="<?php the_field("collect_image4");?>" alt=""></a>
                            <a href="<?php the_field("collect_link4");?>" class="btnall">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fabric" class="sobs">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">Собственная фабрика</span>
                        </div>
                    </div>
                    <div class="row padf">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center fab">
                            <h1><?php the_field("title_fab");?></h1>
                            <p><?php the_field("descr_fab");?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <section id="aksii" class="akc">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">Акции</span>
                        </div>
                    </div>
                </div>
                <div class="container akcii">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3 col-xs-12 text-center tak">
                            <p>Отправьте нам свое имя<br><span class="email">и email и получите</span><br><span>20% Скидку</span></p>
                        </div>
                    </div>
                    <div class="row forma">
                        <div class="col-md-1"></div>
                        <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                            <?php echo do_shortcode( '[contact-form-7 id="51" title="Скидка"]' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="hit" class="collect">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="heading">Хиты продаж</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <?php echo do_shortcode('<div class="in-main-cat">[woocommerce_products_carousel_all_in_one all_items="8" show_only="feautured" out_of_stock="false" exclude="" products="" categories="' . get_theme_mod("catsl2", "") . '" relation="and" tags="" ordering="desc" template="compact.css" show_title="true" show_description="false" allow_shortcodes="false" show_price="true" show_category="false" show_tags="false" show_add_to_cart_button="true" show_more_button="false" show_more_items_button="false" show_featured_image="true" image_source="medium" image_height="100" image_width="100" items_to_show_mobiles="1" items_to_show_tablets="2" items_to_show="3" slide_by="1" stage_padding="0" margin="0" loop="true" stop_on_hover="true" auto_play="true" auto_play_timeout="1200" auto_play_speed="800" nav="true" nav_speed="100" dots="false" dots_speed="800" lazy_load="false" mouse_drag="true" mouse_wheel="false" touch_drag="true" easing="easeInQuad" auto_width="false" auto_height="true" custom_breakpoints=""]<div class="main-carbtn"></div></div>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="/shop" class="btnall">Посмотреть все</a>
                </div>
            </div>
        </div>
    </section>

    <section class="mag">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">О нас</span>
                        </div>
                    </div>
                </div>
                <div class="container our">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center magtext">
                            <h1><?php the_field("title_our");?></h1>
                            <p><?php the_field("descr_our");?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="new" class="hit">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">Новинки</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 text-center">
                           <?php echo do_shortcode('<div class="in-main-cat">[woocommerce_products_carousel_all_in_one all_items="8" show_only="newest" out_of_stock="false" exclude="" products="" categories="' . get_theme_mod("catsl2", "") . '" relation="and" tags="" ordering="desc" template="compact.css" show_title="true" show_description="false" allow_shortcodes="false" show_price="true" show_category="false" show_tags="false" show_add_to_cart_button="true" show_more_button="false" show_more_items_button="false" show_featured_image="true" image_source="medium" image_height="100" image_width="100" items_to_show_mobiles="1" items_to_show_tablets="2" items_to_show="3" slide_by="1" stage_padding="0" margin="0" loop="true" stop_on_hover="true" auto_play="true" auto_play_timeout="1200" auto_play_speed="800" nav="true" nav_speed="100" dots="false" dots_speed="800" lazy_load="false" mouse_drag="true" mouse_wheel="false" touch_drag="true" easing="easeInQuad" auto_width="false" auto_height="true" custom_breakpoints=""]<div class="main-carbtn"></div></div>'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center posm">
                            <a href="/shop" class="btnall">Посмотреть все</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="podpis">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-8 text-center">
                            <h3><i class="fa fa-envelope-o" aria-hidden="true"></i><?php the_field("title_pod");?></h3>
                            <p><?php the_field("descr_pod");?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2"></div>
                        <div class="col-md-8 col-sm-8 col-xs-12 podp">
                            <?php echo do_shortcode( '[wysija_form id="1"]' ); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <section id="addres" class="address">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="heading">Наши адреса</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-4 maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.914953289938!2d74.58825781526959!3d42.87463917915561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x389eb7dec2f84b71%3A0x29c1629c788878ab!2z0JHQuNGI0LrQtdC6INCf0LDRgNC6!5e0!3m2!1sru!2sru!4v1490202672507" width="600" height="290" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <p>ТЦ Бишкек парк 1 этаж<br>Киевская-Исанова<br> с 10-22.00</p>
                        </div>
                        <div class="col-md-2 col-sm-4 maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.7747006447275!2d74.61360701526964!3d42.87759927915554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x389eb7c097bc449d%3A0x6cb95590acbffaa2!2z0KDRjdC0INCm0LXQvdGC0YA!5e0!3m2!1sru!2sru!4v1490712274003" width="600" height="290" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <p>ТЦ Red Center<br>Шопокова 121/1 <br> с 10-20.00</p>
                        </div>
                        <div class="col-md-2 col-sm-4 maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.7746147585804!2d74.61360701526964!3d42.87759927915554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x389eb7c0cdbbae15%3A0xa6b565413fa531df!2z0KbQo9CcLCDQv9GA0L7RgdC_0LXQutGCINCn0YPQuSwg0JHQuNGI0LrQtdC6LCDQmtC40YDQs9C40LfQuNGP!5e0!3m2!1sru!2sru!4v1490712491345" width="600" height="290" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <p>ЦУМ 2 этаж<br>бутик B 26<br>с 10-22.00</p>
                        </div>
                        <div class="col-md-2 col-sm-4 maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3032.541975421716!2d72.79256881518873!3d40.52961377935219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38bdac1acfd4ce05%3A0x16bb88269b1e2c5d!2zMjUxINCa0YPRgNC80LDQvdC20LDQvS3QlNCw0YLQutCwINGD0LsuLCDQntGILCDQmtC40YDQs9C40LfQuNGP!5e0!3m2!1sru!2sru!4v1490712613136" width="600" height="290" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <p>г. Ош<br> ул Курманжан<br> Датка, 251</p>
                        </div>
                        <div class="col-md-2 col-sm-4 maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56503.303625784254!2d72.93798702758454!3d40.943558843375996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38bd15d12633c585%3A0x792849d2f1eaab8e!2z0JbQsNC70LDQu9Cw0LHQsNGCLCDQmtC40YDQs9C40LfQuNGP!5e0!3m2!1sru!2sru!4v1490712798954" width="600" height="290" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <p>г. Джалал Абад<br>ТЦ Шер<br> Мухаммед</p>
                        </div>
                        <div class="col-md-2 col-sm-4 maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d95732.12836940252!2d75.91110478527757!3d41.42557131159572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38906bac89c2f9cb%3A0xb400cbc7951a0aa4!2z0J3QsNGA0YvQvSwg0JrQuNGA0LPQuNC30LjRjw!5e0!3m2!1sru!2sru!4v1490712963726" width="600" height="290" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <p>г Нарын<br>ТЦ "МегаКомфорт"<br>бутик-50</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="feedback">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="heading">Обратная связь</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <?php echo do_shortcode( '[contact-form-7 id="52" title="Обратная связь"]' ); ?>
                </div>
                <div class="col-md-6 col-sm-6 adr">
                    <p><?php the_field("descr_feed");?></p>
                    <span class="map"><i class="fa fa-map" aria-hidden="true"></i></span><span><?php the_field("adres_feed");?></span><br>
                    <span class="mobile"><i class="fa fa-phone" aria-hidden="true"></i></span><span><?php the_field("phone_feed");?></span><br>
                    <ul>
                        <li><a target="_blank" href="<?php the_field("facebook");?>"><span class="mobile"><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
                        <li><a target="_blank" href="<?php the_field("instagram");?>"><span class="mobile"><i class="fa fa-instagram" aria-hidden="true"></i></span></a></li>
                        <li><a target="_blank" href="<?php the_field("twitter");?>"><span class="mobile"><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?php get_footer();?>