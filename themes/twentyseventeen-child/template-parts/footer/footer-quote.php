<?php
$args = [
    'posts_per_page' => - 1,
    'post_type'      => 'drknss-quotation-cpt'];

$the_query = new WP_Query($args);
if ($the_query->have_posts()): 

    while ($the_query->have_posts()): 
        $the_query->the_post();
        $quote   = get_field('drknss_quote');
        $culprit = get_field('drknss_quote_culprit');
        $source  = get_field('drknss_quote_source');
        $url     = get_field('drknss_quote_url');

        if( !empty(trim($quote)) ): ?>
            <div        class = "drknss-footer-quote">
            <blockquote cite  = "<?php echo $url;?>">
                <?php echo '<p>&#8195' . $quote . '</p>' . '<footer>&mdash;&ensp;'. $culprit . '&ensp;<cite> '. $source .'</cite></footer>';?></blockquote></div>
<?php   
        endif;
    endwhile; 
        wp_reset_postdata();
endif;?>
