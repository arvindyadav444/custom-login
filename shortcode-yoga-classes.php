<?php


// The shortcode function for listing classes
function yoga_classes_shortcode() { 
    $query = new WP_Query( [
        'post_type'      => 'yoga-classes',

    ] );
    
    if ( $query->have_posts() ) :
        $string = '<div class="container yoga-table">
        <table class="table table-bordered">
          <thead>
            <tr style="background-color:red; color:#fff;">
              <th scope="col">Date/Time</th>
              <th scope="col">Classes</th>
              <th scope="col"></th>
              <th scope="col">Timing</th>
              <th scope="col">Duration</th>
              <th scope="col">Course Fee</th>
            </tr>
          </thead>
          <tbody>';
          while ( $query->have_posts() ) :
            $query->the_post();
            $timing = get_post_meta(get_the_ID(),'_timings',true);
            $duration = get_post_meta(get_the_ID(),'_duration',true);
            $fees = get_post_meta(get_the_ID(),'_fees',true);
            
            $string .=  '<tr>
            <td>'.get_the_time('Y-m-d h:i:s').'</td>
            <td title="'.strip_tags(get_the_content()).'">'.get_the_title().'</td>
            <td><a class="btn btn-lg" href="'.get_the_permalink().'">Sign Up</a></td>
            <td>'.$timing.'</td>
            <td>'.$duration.'</td>
            <td>$'.$fees.'</td>
            </tr>';
          endwhile;   
            
          $string .= '</tbody>
        </table>
      </div>';    
    endif;

    
     

    return $string; 
     
    }
    // Register shortcode
    add_shortcode('my_yoga_classes', 'yoga_classes_shortcode');

    ?>