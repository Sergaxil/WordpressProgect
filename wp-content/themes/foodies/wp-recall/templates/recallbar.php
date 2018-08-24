<?php global $rcl_user_URL,$user_ID; ?>

<div id="recallbar">
    <div class="rcb_left">
        
        <?php $rcb_menu = wp_nav_menu(array( 'echo'=>false,'theme_location' => 'recallbar','container_class'=>'rcb_menu','fallback_cb' => '__return_empty_string')); ?>
        <?php if($rcb_menu): ?>
        <div class="rcb_left_menu"><!-- блок rcb_left_menu должен появляться только если есть пункты в меню -->
            <i class="fa fa-bars" aria-hidden="true"></i>
            <?php echo $rcb_menu; ?>	
        </div>
        <?php endif; ?>
        
        <div class="rcb_icon">
            <a href="/">
                <div class="rcb_hiden"><span><?php _e('Homepage','wp-recall'); ?></span></div>
            </a>
        </div>
        
        <div class="header-top">
                <div class="navbar-collapse">
                <ul class="nav menu">
<li>
<a href="/"><i class="fa fa-home" alt="Главная"></i>
<span class=image-title>Главная</span> </a>
</li>
<li>
<a href="/payment"><i class="fa fa-cc-visa" alt="Оплата"></i>
<span class=image-title>Оплата </span> </a>
</li>
<li>
<a href="/delivery"><i class="fa fa-truck" alt="Доставка"></i><span class=image-title>Доставка</span></a>
</li>
<li>
<a href="/about-us"><i class="fa fa-users" alt="О нас"></i>
<span class=image-title>О нас</span> </a>
</li>
<li>
<a href="/contacts"><i class="fa fa-sticky-note-o" alt="Контакты"></i>
<span class=image-title>Контакты</span> </a>
</li>
</ul>

            </div>
            </div>

        <?php if(!is_user_logged_in()): $logIn = rcl_get_option('login_form_recall'); ?>
        
        <?php if($logIn == 1){
            $page_in_out = rcl_format_url(get_permalink(rcl_get_option('page_login_form_recall')));
            $urls = array(
                $page_in_out . 'action-rcl=login',
                $page_in_out . 'action-rcl=register'
            );
        }else if($logIn == 2){
            $urls = array(
                wp_login_url('/'),
                wp_registration_url()
            );
        }else if($logIn == 3){ // Форма в виджете
                
        }else{
            $urls = array('#','#');
        } ?>

        

        <?php endif; ?>
        
        <?php do_action('rcl_bar_left_icons'); ?>
        
    </div>

    <div class="rcb_right">
        <div class="diy-first-line">
        <div class="diy-login-buttons">
        <?php if(isset($urls)){ ?>
        <div class="rcb_icon">
            <a href="<?php echo $urls[0]; ?>" class="rcl-login">
                <span><?php _e('Entry','wp-recall'); ?></span>
                <div class="rcb_hiden"><span><?php _e('Entry','wp-recall'); ?></span></div>
            </a>
        </div>
            <?php if(rcl_is_register_open()): ?>
                <div class="rcb_icon">
                    <a href="<?php echo $urls[1]; ?>" class="rcl-register">
                        <span><?php _e('Register','wp-recall'); ?></span>
                        <div class="rcb_hiden"><span><?php _e('Register','wp-recall'); ?></span></div>
                    </a>
                </div>
            <?php endif; ?>
        <?php } ?>
        </div>
        
        <div class="diy-language-switcher">
            <?php pll_the_languages(array('dropdown' => true));?>
        </div>

        <div class="rcb_icons">
            <?php do_action('rcl_bar_print_icons'); ?>
        </div>
        </div>
         <div class="diy-search-bar">
            <form action="" method="GET" role="search">
                <input type="text" placeholder="<?php echo pll__('Поиск'); ?>" value="" name="s">
                <button type="submit"><em class="fa fa-search"></em></button>
            </form>
        </div>
        
        <?php if(is_user_logged_in()): ?>
        
        <div class="rcb_right_menu">

            <a href="<?php echo $rcl_user_URL; ?>"><?php echo get_avatar($user_ID,36); ?></a>
            <div class="pr_sub_menu">
                <?php do_action('rcl_bar_print_menu'); ?>
                <div class="rcb_line"><a href="<?php echo wp_logout_url('/'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span><?php _e('Exit','wp-recall'); ?></span></a></div>
            </div>    
        </div>
        
        <?php endif; ?>
    </div>
</div>