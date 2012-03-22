<?php

function ks_twitter($atts) {
	
	global $options;
	
	extract( shortcode_atts( array(
		
			'username' => $options['twitter_username'],
			), $atts ) );


			    include_once(ABSPATH . WPINC . '/feed.php');
			    $rss = fetch_feed('http://twitter.com/statuses/user_timeline.rss?screen_name=' . $username);
			    $maxitems = $rss->get_item_quantity(3);
			    $rss_items = $rss->get_items(0, $maxitems);
?>


			<ul>
			    <?php if ($maxitems == 0) echo '<li>No items.</li>';
			    else
			    // Loop through each feed item and display each item as a hyperlink.
			    foreach ( $rss_items as $item ) : 
			
					$tweet = formatTweet($item->get_title());?>
			    <li class="tweet">
			        <a href='<?php echo $item->get_permalink(); ?>'>
			            <?php echo  $tweet; ?>
			        </a>
			    </li>
			    <?php endforeach; ?>
			</ul>
<?php

}
add_shortcode('ks_twitter', 'ks_twitter');
?>