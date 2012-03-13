<script type="text/javascript">
var myPlaylist = [
<?php query_posts(array('post_type' => 'playlist')); ?>

<?php while(have_posts()): the_post(); ?>
<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id ( $post->ID ), "album-thumb"); ?>

	{
		mp3:'<?php echo get_post_meta(get_the_ID(),'music_mp3',true); ?>',
		oga:'<?php echo get_post_meta(get_the_ID(),'music_ogg',true); ?>',
		title:'<?php the_title() ?>',
		artist:'<?php echo get_post_meta(get_the_ID(),'music_artist',true); ?>',
		buy:'<?php echo get_post_meta(get_the_ID(),'music_buy',true); ?>',
		price:'<?php echo get_post_meta(get_the_ID(),'music_price',true); ?>',
		duration:'<?php echo get_post_meta(get_the_ID(),'music_duration',true); ?>',
		cover:'<?php echo $thumbnail[0] ?>'
	},

<?php endwhile; ?>

];
</script>
