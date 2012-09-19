<?php
/* 
Plugin Name: Foundersbot
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/**
 * Shuffle through bot's expressions.
 */
function notify_fun() {

	$greetings = array( 
		'Beep boop', 
		'This just in', 
		'Boop beep boop', 
		'Listen up humans', 
		'Foundersbot speaks' 
	);
	
	shuffle( $greetings );
	
	$roulette = $greetings[0];
	
	return $roulette . ': ';

}


/**
 * Generate celebration phrase.
 */
function notify_celebration() {

	$yays = array( 'My sensors indicate this is <em>awesome</em>.', 'I have no feelings, but my <code>0</code> just became a <code>1</code> for you.', 'You are welcome, human.', 'Congratulations, human.', 'Celebrate, humans.' );
	
	shuffle( $yays );
	
	$roulette = $yays[0];
	
	return $roulette;

}


// Support for notifications in Simple Badges
add_action( 'simplebadges_after_adding', 'notify_simplebadges', 10, 2 );

function notify_simplebadges( $badge_toggle_badge_id, $badge_toggle_user_id ) {

	$user_meta = get_userdata( $badge_toggle_user_id );
	$user_name = $user_meta->user_login;
					
	$badge_title = get_the_title( $badge_toggle_badge_id );
	$badge_object = get_page( $badge_toggle_badge_id );
	$badge_desc .= '"' . $badge_title .  ': ';
	$badge_desc .= $badge_object->post_content . '"';
	$badge_image = get_the_post_thumbnail( $badge_toggle_badge_id, array( 151, 154 ) );
	$greeting = notify_fun();				
	$celebrate = notify_celebration();
					
	// Fire out a notification to the chat stream
	$notification_message .= '<div class="notify-status">' . $badge_image . '</div><p><strong>' . $greeting . '</strong>@' . $user_name . ' just received the <strong>' . $badge_title . '</strong> badge. ' . $celebrate . '</p>';
	$notification_message .=  $badge_desc . '<div class="clear"></div>';
					
	$post_args = array(
					
		// Publish a new post authored by Founders Bot
		// Set the post format to status
		// Test by inserting to draft first
		// Post should read: Name just receieved the Badge badge. Congratulations Name!
		// If possible, include the badge image.
						
		'comment_status' => 'open',
		'ping_status' => 'closed',
		'post_author' => 37,
		'post_content' => $notification_message,
		'post_status' => 'publish',
		'post_type' => 'post',
		'tags_input' => 'announcement',
		'tax_input' => array( 'post_format' => array( 'status' ) )
					
	);
					
	wp_insert_post( $post_args );

}



// Support for the checkin.atfounders.com site
//add_action( 'founders_checkin_checkedin', 'notify_checkinsite_in', 10, 1 );

function notify_checkinsite_in( $user ) {
	
	$current_user = $user;
	
	$user_meta = get_userdata( $current_user );
	$user_name = $user_meta->user_login;
	$greeting = notify_fun();				
					
	// Fire out a notification to the chat stream
	$notification_message = '<p><strong>' . $greeting . '</strong>@' . $user_name . ' just checked in. Please show this person the human love I&rsquo;m incapable of.</p>';
					
	$post_args = array(
					
		// Publish a new post authored by Founders Bot
		// Set the post format to status
		// Test by inserting to draft first
		// Post should read: Name just receieved the Badge badge. Congratulations Name!
		// If possible, include the badge image.
						
		'comment_status' => 'open',
		'ping_status' => 'closed',
		'post_author' => 37,
		'post_content' => $notification_message,
		'post_status' => 'publish',
		'post_type' => 'post',
		'tags_input' => 'announcement',
		'tax_input' => array( 'post_format' => array( 'status' ) )
					
	);
					
	wp_insert_post( $post_args );

}

// add_action( 'founders_checkin_checkedout', 'notify_checkinsite_out', 10, 1 );

function notify_checkinsite_out( $user ) {
	
	$current_user = $user;
	
	$user_meta = get_userdata( $current_user );
	$user_name = $user_meta->user_login;
	$greeting = notify_fun();				
					
	// Fire out a notification to the chat stream
	$notification_message = '<p><strong>' . $greeting . '</strong>@' . $user_name . ' just checked out.</p>';
					
	$post_args = array(
					
		// Publish a new post authored by Founders Bot
		// Set the post format to status
		// Test by inserting to draft first
		// Post should read: Name just receieved the Badge badge. Congratulations Name!
		// If possible, include the badge image.
						
		'comment_status' => 'open',
		'ping_status' => 'closed',
		'post_author' => 37,
		'post_content' => $notification_message,
		'post_status' => 'publish',
		'post_type' => 'post',
		'tags_input' => 'announcement',
		'tax_input' => array( 'post_format' => array( 'status' ) )
					
	);
					
	wp_insert_post( $post_args );	

}



// Support for the P2 Check In plugin
//add_action( 'p2checkin_after_checkin', 'notify_p2checkin_in', 10, 1 );

function notify_p2checkin_in( $current_user ) {

	$user_meta = get_userdata( $current_user->ID );
	$user_name = $user_meta->user_login;
	$greeting = notify_fun();				
					
	// Fire out a notification to the chat stream
	$notification_message = '<p><strong>' . $greeting . '</strong>@' . $user_name . ' just checked in. Please show this person the human love I&rsquo;m incapable of.</p>';
					
	$post_args = array(
					
		// Publish a new post authored by Founders Bot
		// Set the post format to status
		// Test by inserting to draft first
		// Post should read: Name just receieved the Badge badge. Congratulations Name!
		// If possible, include the badge image.
						
		'comment_status' => 'open',
		'ping_status' => 'closed',
		'post_author' => 37,
		'post_content' => $notification_message,
		'post_status' => 'publish',
		'post_type' => 'post',
		'tags_input' => 'announcement',
		'tax_input' => array( 'post_format' => array( 'status' ) )
					
	);
					
	wp_insert_post( $post_args );		
	
}



// Support for the P2 Check In plugin
add_action( 'p2checkin_after_checkout', 'notify_p2checkin_out', 10, 1 );

function notify_p2checkin_out( $current_user ) {

	$user_meta = get_userdata( $current_user->ID );
	$user_name = $user_meta->user_login;
	$greeting = notify_fun();				
					
	// Fire out a notification to the chat stream
	$notification_message = '<p><strong>' . $greeting . '</strong>@' . $user_name . ' just checked out.</p>';
					
	$post_args = array(
					
		// Publish a new post authored by Founders Bot
		// Set the post format to status
		// Test by inserting to draft first
		// Post should read: Name just receieved the Badge badge. Congratulations Name!
		// If possible, include the badge image.
						
		'comment_status' => 'open',
		'ping_status' => 'closed',
		'post_author' => 37,
		'post_content' => $notification_message,
		'post_status' => 'publish',
		'post_type' => 'post',
		'tags_input' => 'announcement',
		'tax_input' => array( 'post_format' => array( 'status' ) )
					
	);
					
	wp_insert_post( $post_args );		
	
}

