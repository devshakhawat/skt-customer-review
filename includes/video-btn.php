<?php
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

class Video_Btn {

    public function __construct() {
        
        add_filter( 'woocommerce_product_review_comment_form_args', [ $this, 'add_custom_review_field' ] );       
        
    }

    
    public function add_custom_review_field( $args ) {

        $label  = '<label for="rating">Your rating&nbsp;<span class="required">*</span></label>';
        $hidden = '<input type="hidden" name="video" id="video" value=""/>';
        $button = '<br><button>Upload Video</button>';
        $rating = '<select name="rating" id="rating" required>
                    <option value="">Rate&hellip;</option>
                    <option value="5">Perfect</option>
                    <option value="4">Good</option>
                    <option value="3">Average</option>
                    <option value="2">Not that bad</option>
                    <option value="1">Very poor</option>
                </select>';
        $text_comment = '<p class="comment-form-comment">
                <label for="comment">Your review&nbsp;<span class="required"></span></label>
                <textarea id="comment" name="comment" cols="45" rows="8" ></textarea>
            </p>';

        $args['comment_field'] = sprintf( '<div class="comment-form-rating">%1s %2s %3s</div>%4s', $label, $button, $rating, $text_comment );
        

        return $args;

    }

}