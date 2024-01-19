
<?php /*
 * Template Name: Yoga Classes
 * Template Post Type: yoga-classes
 */ ?>

<?php 
/** If form is submitted */
if(!empty($_POST) && isset($_POST['submit'])){
    $bookedby_fname = $_POST['first_name'];
    $lastname= $_POST['last_name'];
    $email= $_POST['email'];
    $phoneno= $_POST['phone'];
    $message= $_POST['message'];
    $checkme= $_POST['check_me'];
    $name = $bookedby_fname.' '.$lastname;
    $yoga_class = get_the_title();
    $new_post = array(
        'post_title' => $yoga_class,
        'post_content' => $message,
        'post_type' => 'bookings',
        'post_status' => 'publish'
    );
       
    $post_id = wp_insert_post( $new_post );
    if($post_id){
        update_post_meta($post_id,'_name',$name);
    }
    // Update post 37
    //   $my_post = array(
    //     'ID' => $post_id,
    //     'post_type'    => 'bookings',
    //     'post_title'   => $yoga_class,
    //     'post_content' => $message,
    // );

    // Update the post into the database
    // wp_update_post( $my_post );
    
    //echo 'form';    
    //Do this: CPT Bookings
    
}
?>
<?php get_header();?>
<style>
    .main-heading{
        background-color:#FFF7F5;
        margin-bottom: 40px;
        padding-top:5px;
        padding-bottom:5px;
    }
    .container{
        background-color:#EBECF2;
        padding:50px;
    }
    input[type="text"], input[type="email"], input[type="password"] textarea, select {
    height: 30px;
    font-size:15px;
    } 
    .btn{
    font-weight: 400;
    border-radius: 10px;
    padding: 5px 20px !important;
    color: #fff;
    display: inline-block;
    font-size: 16px !important;
    background-color: #ff6600 !important;
    border-color: #ff6600;
}
.top-heading p{
    padding-bottom:10px;
}
.form-check-label{
    font-size:16px;
}
.form-check-input{
    font-size:16px;
}
    </style>

                <div class="container mt-5">
                    <div class="row">
                    <div class="col main-heading">
                    <h2 class=" center text-center">YOGASIGNUP</h2>
                    </div>
                </div>

                <?php $loop = new WP_Query( array( 'post_type' => 'yoga-classes' ) );
                

                 $duration = get_post_meta(get_the_ID(), '_duration', true);
                 $fees = get_post_meta(get_the_ID(), '_fees', true);
                  $timings = get_post_meta(get_the_ID(), '_timings', true);
                                            
                  ?>

                <div class="row">
                    <div class="col top-heading">
                        <h2 class="mb-4"><?php the_title();?></h2>
                        <p><strong>Date:</strong> <?php echo get_the_time('d-m-Y') ?></p>
                        <p><strong>Duration:</strong> <?php echo $duration; ?></p>
                        <p><strong>Fees:</strong> <?php echo $fees; ?></p>
                        <p><strong>Timning:</strong> <?php echo $timings; ?></p>
                    </div>
                </div>
                

                       
                    <form action="" method="post">
                        <div class="row mb-4">
                            <div class="col">
                                <input type="text" name="first_name" class="form-control" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                            </div>
                            <div class="col">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required aria-label="Phone Number">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                            <textarea class="form-control" name="message" id="message" rows="8" placeholder="Enter your message"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                            <input type="checkbox" name="check_me" class="form-check-input" id="terms">
                            <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
                            </div>
                        </div>
                        
                         <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>




<?php get_footer();?>