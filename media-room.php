<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2016

Single View Template Parts / Media, according to post format ( image, audio or video ) 
media_template_name: Four Views
media_template_desc: Display four views of the room provided you have uploaded 4 images
*/

$options = get_query_var( 'options' );
if ( is_array( $options ) ) { extract($options); }
if ( $post_format === 'gallery' ) { ?> 

	<!-- CSS -->
	<style>
		.custom_media_room {
			display        : flex;
			flex-direction : row;
			flex-wrap      : wrap;
			position       : relative;
		}
		.custom_media_room img {
			transition : all 700ms ease;
			height     : 50%;
			width      : 50%;
			z-index    : 99;
		}
		.custom_media_room img:hover {
			opacity : 0.75;
			cursor  : pointer;
		}
		.custom_media_room img.current_room {
			height     : 100%;
			width      : 100%;
		}
		.custom_media_room img.scale_down {
			height     : 0%;
			width      : 0%;
		}
		.custom_media_room .current_image {
			width             : 100%;
			height            : 100%;
			z-index           : -1;
			position          : absolute;
			top               : 0;
			left              : 0;
			background-repeat : no-repeat;
			background-size   : cover;		
			transition 		  : 500ms all ease;
			opacity 		  : 0;
			cursor 			  : pointer; 
		}
		.current_image.ontop { z-index : 1001; }
		.current_image.ontop:before, 
		.current_image.ontop:after {
			content         : "";
			position        : absolute;
			display         : block;
			margin          : auto;
			width           : 32px;
			height          : 0;
			border-top      : 2px solid rgba(0,0,0,0.7);
			right           : 8px;
			top             : 24px;
			transform-origin: center;
		}
		.current_image.ontop:before { transform: rotate(45deg); }
		.current_image.ontop:after { transform: rotate(-45deg); }
	</style>

	<!-- JS -->
	<script>
		jQuery(function($){

			$current_image = $(".current_image");
			$current_image.on("click", function(e){
				let $this = $(this);
				$this.css( "opacity", 0 );
				setTimeout(function(){ $this.removeClass('ontop'); }, 250)
			});

			$(".custom_media_room img").on("click", function(e){

				$current_image
				.addClass('ontop')
				.css({
					"background-image" : "url(" + $(this).attr('src') + ")",
					"opacity" 		   : 1 
				});

			});

		});
	</script>

	<!-- MARKUP -->
	<div class="custom_media_room">
		<div class="current_image"></div>
		<?php }

		echo Plethora_Theme::get_post_media( array(
		                                            'type'          => $post_format, 
		                                            'stretch'       => true, 
		                                            'link_to_post'  => false,
		                              		) 
		); 
		if ( $post_format === 'gallery' ) { ?>  
	</div>

<?php }
