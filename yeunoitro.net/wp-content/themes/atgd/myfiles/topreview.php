<?php
	function get_most_voted($limit = 20) {
        global $wpdb;
        $limit = intval($limit);
    	$table_name = $wpdb->prefix . MTS_WP_REVIEW_DB_TABLE;
    	if (function_exists('is_multisite') && is_multisite()) {$table_name = $wpdb->base_prefix . MTS_WP_REVIEW_DB_TABLE;}
    	    	
        global $blog_id; 
        
        $ids = array();
        $reviews = $wpdb->get_results("
            SELECT post_id, COUNT(*) AS magnitude 
            FROM $table_name
            WHERE blog_id = $blog_id 
            GROUP BY post_id 
            ORDER BY magnitude DESC
            LIMIT $limit
        ");
        foreach ($reviews as $review) {
            $ids[] = $review->post_id;
        }
        return $ids;
    }

	function get_most_voted_by_date($limit = 20, $time_stamp = '') {
		global $wpdb;
		$limit = intval($limit);
		$table_name = $wpdb->prefix . MTS_WP_REVIEW_DB_TABLE;
		if (function_exists('is_multisite') && is_multisite()) {$table_name = $wpdb->base_prefix . MTS_WP_REVIEW_DB_TABLE;}

		global $blog_id;

		if($time_stamp)
			$time = date("Y-m-d 00:00:00", $time_stamp);
		else
			$time = date("Y-m-d 00:00:00", strtotime('-30 day'));

		$ids = array();
		$reviews = $wpdb->get_results("
				SELECT post_id, COUNT(*) AS magnitude
				FROM $table_name
				WHERE blog_id = $blog_id And date >='".$time."'
				GROUP BY post_id
				ORDER BY magnitude DESC
				LIMIT $limit
			");
		foreach ($reviews as $review) {
			$ids[] = $review->post_id;
		}

		return $ids;
	}
    
    function get_posts_by_review($posts_id, $order) {
        global $wpdb;
    	$table_name = $wpdb->prefix . MTS_WP_REVIEW_DB_TABLE;
    	if (function_exists('is_multisite') && is_multisite()) {$table_name = $wpdb->base_prefix . MTS_WP_REVIEW_DB_TABLE;}
    	    
        global $blog_id;                 
                     
        $ids = array();
        
        $reviews = $wpdb->get_results("
            SELECT post_id, COUNT(*) AS magnitude 
            FROM $table_name 
            WHERE blog_id = $blog_id
            GROUP BY post_id 
            ORDER BY magnitude $order
        ");
        foreach ($reviews as $review) {
            if(in_array($review->post_id, $posts_id)) {
                $ids[] = $review->post_id;
            }
        }
        return $ids;
    }
    
    function get_total_reviews($postid) {
        global $wpdb;
    	$table_name = $wpdb->prefix . MTS_WP_REVIEW_DB_TABLE;
    	if (function_exists('is_multisite') && is_multisite()) {$table_name = $wpdb->base_prefix . MTS_WP_REVIEW_DB_TABLE;}
    	    	        
        $reviews = $wpdb->get_var("
            SELECT COUNT(*)
            FROM $table_name
            WHERE post_id = $postid
        ");
        
        return $reviews;
    }
?>