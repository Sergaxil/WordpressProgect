<?php
/*
 * The Header template for our theme
 */

$publ_url = '/rcl-add';
if (pll_current_language() == 'ru') {
    $publ_url = '/ru/forma-publikacii/';
}

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
    <div class="foodies-wrapper">
        <div class="side-bar clearfix">
        <div class="navbar">
                <div class="navbar-header">
                    <!-- toggle button start -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".side-bar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- toggle button end -->
                    <!-- Logo start -->
                    <div class="navbar-brand" href="">
                        <div class="logo">
		                  <a href="<?php echo $punl_url;?>" class="diy-add-pub"><?php echo pll__('Категории');?></a>
                        </div>
                    </div>
                    <!-- Logo end -->
                </div>



                <!-- Menu start -->
                <div class="side-bar-collapse collapse">

                        <ul>
                            <?php wp_list_categories(
                            array('echo' => true,
                            'exclude' => array(),
                            'order' => 'ASC',
                            'current_category' => '1,14',
                            'title_li' => ''));?>
                        </ul>

                    <!-- All cuisines-modal start-->

                    <!-- All cuisines-modal end -->
                    <?php get_template_part('sidebar'); ?>


                </div>
            </div>
            <!-- Menu end -->
            
        </div>