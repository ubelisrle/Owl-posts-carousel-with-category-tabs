<!--TEMPLATE PART FOR DISPLAYING POSTS IN OWL CAROUSEL WITH TABS -->


<section class="products-carousel-tabs">
{<?php
    echo '<ul class="nav nav-inline text-xs-left" role="tablist">';
    $args = array(
        'hide_empty'=> 1,
        'orderby' => 'ID',
        'order' => 'ASC'
    );
    
    $categories = get_categories($args);
    $countlink = 0;
    foreach($categories as $category) { 
    $countlink++;
    $activelink = '';
    if($countlink == 1) {$activelink = 'active'; }
        echo '<li class="nav-item">
                <a class="nav-link '. $activelink . '" href="#'.$category->slug.'" role="tab" data-toggle="tab">    
                    '.$category->name.'
                </a>
            </li>';
    }
    echo '</ul>';

    echo '<div class="tab-content mt-4">';
    $counttab = 0;
    foreach($categories as $category) { 
        $counttab++;
        $activetab = '';
        if($counttab == 1) {$activetab = 'active'; }
        echo '<div class="tab-pane '. $activetab . '" id="' . $category->slug.'">';
        $the_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 6,
            'category_name' => $category->slug
        ));
            echo '<div class="owl-carousel posts-slider" id="posts-slider-' . $category->slug. '">';
            while ( $the_query->have_posts() ) : 
                $the_query->the_post();
                echo '<div class="owl-item">';
                    if(has_post_thumbnail()){ the_post_thumbnail(); } 
                    echo '<h3 class="post-title">';
                        the_title(); 
                    echo '</h3>';
                    echo '<p class="post-description">';
                        the_excerpt(); 
                    echo '</p>';
                    echo '<a class="button" href="">';
                        echo '<i class="fa fa-arrow-right"></i>';
                    echo '</a>';
                echo '</div>';
                endwhile; wp_reset_postdata(); 
            echo '</div>'; ?>
            <script type="text/javascript">
            jQuery(document).ready(function () {
            jQuery("#posts-slider-<?php echo $category->slug ; ?>").owlCarousel({
                loop: false,
                nav: true,																		
                margin: 10,
                autoPlay: true,
                dots: true,
                autoHeight: false,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:2,
                    },
                    1000:{
                        items:3,
                    }
                }
            });
            });
            </script>
        <?php echo '</div>'; 
    } 
    echo '</div>'; ?>		}					
</section>