<?php get_header(); ?>
<section id="main_slider">
  <div class="gray_overlay"></div>
  <div class="intro">
    <div class="logo"><img src="<? echo get_template_directory_uri(); ?>/images/vpu_logo.png"></div>
    <h2><? echo get_bloginfo ('description'); ?></h2>
    <h1><? echo get_bloginfo ('name'); ?></h1>
  </div>
  <div class="fotorama" data-fit="cover" data-nav="false" data-transition="crossfade" data-autoplay="true" data-minheight="360" data-maxheight="600" data-width="100%" data-maxwidth="100%;">
    <img src="http://modastil.com.ua/wp-content/uploads/2015/10/body-img1.jpg">
  </div>
</section>
<? wp_reset_query(); ?>
<section id="news">
  <div class="wrapper">
    <div class="news_list">
      <? query_posts('cat=20&showposts=10'); while (have_posts()) : the_post(); ?>
        <article>
          <a href="<?php the_permalink() ?>">
            <div class="thumb_overflow"><?php the_post_thumbnail(array(600,600)); ?></div>
          </a>
          <h4><a class="underline" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
          <div><?php the_excerpt(); ?>...&nbsp;<a class="underline" href="<?php the_permalink() ?>"><? pll_e('Подробнее') ?></a></div>
          <div class="date"><? echo get_the_date(); ?></div>
        </article>
      <? endwhile; ?>
    </div>
  </div>
</section>
<section id="teachers">
  <div class="wrapper">
    <h2 class="section_title">Анонси</h2>
    <div class="teachers_list" style="height:150px;">
      <? query_posts('cat=73&showposts=30&post_status=future&order=ASC'); while (have_posts()) : the_post(); ?>
        <article>
          <a href="<?php the_permalink() ?>">
            <div class="thumb_overflow" style="height:50px; float:left;"><p class="calendar"><?php the_date('d'); ?><em><?php the_time('F'); ?></em></p></div>
          </a>
          <h4 style="text-align:center;"><a class="underline" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
          <div><?php the_excerpt(); ?>...&nbsp;<p style="text-align:right;"><a class="underline" href="<?php the_permalink() ?>"><? pll_e('Подробнее') ?></a></p></div>
        </article>
      <? endwhile;?>
    </div>
  </div>
</section>
<section id="education">
  <div class="wrapper">
    <h2 class="section_title"><? pll_e('Самые перспективные направления обучения'); ?></h2>
    <? $i = 0; ?>
    <?php if ( 'ru' == pll_current_language() ) { $pid=9; } elseif ( 'ua' == pll_current_language() ) { $pid=11; }
      $mypages = get_pages( array( 'child_of' => $pid, 'sort_column' => 'post_date', 'sort_order' => 'asc', 'hierarchical' => '0', 'parent' => $pid ) );
      foreach( $mypages as $page ) {
        $morestring = '<!--more-->';
        $explodemore = explode($morestring, $page->post_content);
        $content = $explodemore[0]; $i++;
      ?>
      <? if ( $i < 2 ) { ?>
        <div class="row">
          <div class="col hs_7" style="background: url(<? echo wp_get_attachment_url( get_post_thumbnail_id( $page->ID ) ); ?>) no-repeat 50% 50%; background-size: cover;"></div>
          <div class="col hs_5">
            <div class="inner">
              <h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
              <div class="flex_spec"><?php echo $content; ?></div>
              <div class="prof_list__btn"><a href="<?php echo get_page_link( $page->ID ); ?>" class="btn btn_pink"><? pll_e('Ознакомиться с перечнем профессий'); ?></a></div>
            </div>
          </div>
        </div>
      <? } else { ?>
        <div class="row">
          <div class="col hs_5">
            <div class="inner">
              <h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
              <div class="flex_spec"><?php echo $content; ?></div>
              <div class="prof_list__btn"><a href="<?php echo get_page_link( $page->ID ); ?>" class="btn btn_pink"><? pll_e('Ознакомиться с перечнем профессий'); ?></a></div>
            </div>
          </div>
          <div class="col hs_7" style="background: url(<? echo wp_get_attachment_url( get_post_thumbnail_id( $page->ID ) ); ?>) no-repeat 50% 50%; background-size: cover;"></div>
        </div>
      <? $i = 0; } ?> 
      <?php
      } 
    ?>
  </div>
</section>
<section style="padding: 0;">
  <div class="wrapper">
    <div align="center">
      <?php if ( 'ru' == pll_current_language() ) { $pid=9; } elseif ( 'ua' == pll_current_language() ) { $pid=11; } ?>
      <a href="<?echo get_the_permalink( $pid ); ?>" class="btn btn_transparent"><? pll_e('Ознакомиться со всеми специальностями'); ?></a>
    </div>
  </div>
</section>

<section style="padding: 0;">
  <? echo do_shortcode('[wpgmza id="1"]'); ?>
</section>
<?php get_footer(); ?>