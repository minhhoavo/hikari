<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php if(is_home() || is_front_page()){
		echo 'Home ';
	}else{
		wp_title('');
	} ?> | Hikari</title>
	<meta name="description" content="<?php if(is_home() || is_front_page()){
		echo 'Home ';
	}else{
		wp_title('');
	} ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php wp_head(); ?>
</head>

<body>
<header class="c-header">
    <div class="l-container">
        <h1 class="c-logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="ひかりアドバイザーグループ ひかり税理士法人"></a></h1>
        <nav class="c-gnav">
            <ul>
                <li class="<?php if (is_post_type_archive('service')){ echo 'active';};?>" ><a href="<?php bloginfo('url'); ?>/service">サービス</a></li>
                <li class="<?php if (is_post_type_archive('publish')){ echo 'active';};?>" ><a href="<?php bloginfo('url'); ?>/publish">出版物</a></li>
                <li <?php $current_page = get_the_title(); if ($current_page == 'お問い合わせ'){ echo 'class="active-contact"';}?>><a href="<?php bloginfo('url'); ?>/contact">お問い合わせ</a></li>              
            </ul>
        </nav>
    </div>
</header><!-- /header -->