<?php
function enqueue_scripts () {
	wp_register_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
	wp_enqueue_script('html5-shim');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
 }
 ?>
 <?php function load_my_scripts() {
wp_enqueue_script('jquery');
}
add_action('wp_footer', 'load_my_scripts');
?>
<?php
 function catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
 
// no image found display default image instead
if(empty($first_img)){
$first_img = "/wp-content/uploads/2010/03/103.jpg";
}
return $first_img;
}
?>
<?php
$magic_slider_settings = array(
    'height' => 400,
    'category' => 9,
    'mode' => 'fade',
    'speed' => 500,
    'auto' => 1,
    'pause' => 4000,
    'pager' => 1
);
if (function_exists('magic_slider_output')) {
    echo magic_slider_output( $magic_slider_settings );
}
?>
<?php
add_theme_support('post-thumbnails');
    set_post_thumbnail_size(400,400,TRUE);
    ?>
 <?php

 if(isset($_POST['submitted'])) {
    if(trim($_POST['contact_name']) === '') {
        $nameError = 'Введите ваше имя';
        $hasError = true;
    } else {
        $name = trim($_POST['contact_name']);
    }

    if(trim($_POST['contact_email']) === '')  {
        $emailError = 'Введите e-mail';
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['contact_email']))) {
        $emailError = 'Не верный адрес.';
        $hasError = true;
    } else {
        $email = trim($_POST['contact_email']);
    }

    if(trim($_POST['contact_theme']) === '') {
        $themeError = 'Введите тему ';
        $hasError = true;
    } else {
        $theme = trim($_POST['contact_theme']);
    }

    if(trim($_POST['contact_comments']) === '') {
        $commentError = 'Введите сообщение';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['contact_comments']));
        } else {
            $comments = trim($_POST['contact_comments']);
        }
    }

    if(!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = 'Сообщение с сайта от '.$name;
        $body = "Имя: $name \n\nE-mail: $email \n\nТема: $theme \n\nСообщение: $comments";
        $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>