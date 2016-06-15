<?php
Require_once "baseAPI.php";

class getpost extends baseAPI
{
	protected $required = array(
		"category" => array(

		),
	);

	protected $default = array(
		"category" => array(
			"posts_per_page" => 10,
			"post_type" => "post",
			"pspmeta" => 1,
			"isthumb" => 1,
			"orderby" => "post_date",
			"offset" => 1
		),
		"search" => array(
			"posts_per_page" => 8,
			"post_type" => "post",
			"pspmeta" => 1,
			"isthumb" => 1,
			"orderby" => "post_date",
			"offset" => 1
		),
	);

	private $column_defalut_select = array(
		"id", "post_author", "post_date", "guid", "post_title"
	);

	private $term_field = array(
		"term_taxonomy_id", "taxonomy", "description", "count", "slug", "name"
	);

	private $user_metakey_field = array(
		'nickname', 'first_name', 'last_name'
	);

	private $user_field = array(
		'id', 'display_name'
	);

	function __construct()
	{
		$this->debug = true;
		$this->cache = false;

		parent::__construct(__CLASS__);

//		$this->SendResponse(self::HTTP_FORBIDDEN, 'Test truy cap');
	}

	function Process()
	{
		//$this->checkIP();

		//delay time request
		usleep(10000); //Cho` 0,01s

		$subaction = strtolower($_GET['subaction']);

		if (!$subaction) $subaction = strtolower($_GET['type']);

		//Kiểm tra dữ liệu nhập vào
		$this->_validateParamRequired($subaction);

		if (is_callable(array($this->handlerMethod, $subaction))) {

			call_user_func(array($this->handlerMethod, $subaction));
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}

	function search() {

		//Tạo kết nối db để get dữ liệu
		$this->conn_db();

		global $wpdb;

		//Parse tham số truyền lên.
		$where = "post_status = 'publish'";
		$limit = 10;

		if(isset($this->data['posts_per_page'])) {

			$this->data['posts_per_page'] = (int) $this->data['posts_per_page'];
			if ( $this->data['posts_per_page'] < -1 )
				$this->data['posts_per_page'] = abs($this->data['posts_per_page']);
			else if ( $this->data['posts_per_page'] == 0 )
				$this->data['posts_per_page'] = 1;

			$limit = (int)$this->data['posts_per_page'];
		}

		if(isset($this->data['s'])) {
			$this->data['s'] = stripslashes( $this->data['s'] );
			if ( empty( $_GET['s'] ))
				$this->data['s'] = urldecode( $this->data['s'] );

			// there are no line breaks in <input /> fields
			$post_title = str_replace( array( "\r", "\n" ), '', $this->data['s'] );
			$post_title = $wpdb->escape($post_title);
		}

		$posts = $this->get_post_by_key($post_title, $limit);

		if(!$posts) {
			$this->SendResponse(self::HTTP_FORBIDDEN,"Search failed to select");
		}

		if(isset($this->data['isthumb']) && $this->data['isthumb']) {
			$attachments = $this->get_attachment_by_ids(array_keys($posts));
		}

		//Get psp meta value
		if(isset($this->data['pspmeta'])) {
			$pspmeta = $this->get_meta_value_by(array_keys($posts));
		}

		$users = $this->get_users();

//		$taxonomies = $this->get_taxonomy_by_object_id(array_keys($posts));

		foreach ($posts as $key => $post) {
			if(isset($attachments[$key])) {
				$post['thumb_img'] = $this->_check_image_thumb($attachments[$key]);
			}

			if(isset($pspmeta[$key])) {
				$pspmeta[$key] = unserialize($pspmeta[$key]);

				$post['title'] = $pspmeta[$key]['title'];
				$post['description'] = $pspmeta[$key]['description'];
			}

			if(isset($post['post_author']) && array_key_exists($post['post_author'], $users)) {
				$post['post_author'] = $users[$post['post_author']];
			}

//			if(isset($taxonomies[$key])) {
//				$post['taxonomy'] = $taxonomies[$key];
//			}

			$posts[$key] = $post;
		}

//		unserialize
		$this->SendResponse(self::HTTP_OK,$posts);
	}

	function category() {

		//Tạo kết nối db để get dữ liệu
		$this->conn_db();

		global $wpdb;

		//Parse tham số truyền lên.
		$where = "post_status = 'publish'";
		$limit = 10;

		if(isset($this->data['posts_per_page'])) {

			$this->data['posts_per_page'] = (int) $this->data['posts_per_page'];
			if ( $this->data['posts_per_page'] < -1 )
				$this->data['posts_per_page'] = abs($this->data['posts_per_page']);
			else if ( $this->data['posts_per_page'] == 0 )
				$this->data['posts_per_page'] = 1;

			$limit = (int)$this->data['posts_per_page'];
		}

		if(isset($this->data['post_type'])) {
			$where .= " AND post_type ='".$this->data['post_type']."'";
		}

		if(isset($this->data['term_id']) && $this->data['term_id'] > 0) {
			$list_post_by_category_query = "SELECT `object_id` FROM `amthuc_term_relationships` as tr LEFT JOIN `amthuc_term_taxonomy` as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id WHERE tt.`term_id` = ".(int)$this->data['term_id']."";
			$where .= " AND `id` IN (".$list_post_by_category_query. ")";
		}

		if(isset($this->data['post__not_in'])) {
			if(is_array($this->data['post__not_in'])) {
				$post_not_in = implode(",",$this->data['post__not_in']);
			}

			$where .= " AND `id` NOT IN (".$post_not_in.")";
		}

		$orderby = "";
		if(isset($this->data['orderby'])) {
			$orderby = " ORDER BY `".$this->data['orderby']."` DESC";
		}

		$post = $wpdb->rawQuery("SELECT ".implode(",",$this->column_defalut_select)." FROM `".TABLE_PREFIX."posts` WHERE {$where} {$orderby} LIMIT $limit OFFSET ".(int)$this->data['offset']);

		if(!$post) {
			$this->SendResponse(self::HTTP_FORBIDDEN,"Category failed to select: ".$wpdb->getLastQuery() ."\n". $wpdb->getLastError());
		}

		$posts = $this->_parse_result_raw_query($post);

		if(isset($this->data['isthumb']) && $this->data['isthumb']) {
			$attachments = $this->get_attachment_by_ids(array_keys($posts));
		}

		//Get psp meta value
		if(isset($this->data['pspmeta'])) {
			$pspmeta = $this->get_meta_value_by(array_keys($posts));
		}

		$users = $this->get_users();

		foreach ($posts as $key => $post) {
			if(isset($attachments[$key])) {
				$post['thumb_img'] = $attachments[$key];
			}

			if(isset($pspmeta[$key])) {
				$pspmeta[$key] = unserialize($pspmeta[$key]);

				$post['title'] = $pspmeta[$key]['title'];
				$post['description'] = $pspmeta[$key]['description'];
			}

			if(isset($post['post_author']) && array_key_exists($post['post_author'], $users)) {
				$post['post_author'] = $users[$post['post_author']];
			}

			$posts[$key] = $post;
		}

//		unserialize
		$this->SendResponse(self::HTTP_OK,$posts);
	}

	function get_taxonomy_by_object_id($object_id) {
		if(!isset($object_id)) return;

		if(is_string($object_id) || is_int($object_id))
			$object_id = array($object_id);

		$taxonomis = array();

		$tables = $this->get_taxonomy();
		if($this->isSerialized($tables)) {
			$tables = @unserialize($tables);
		}

		foreach ($object_id as $id) {
			if(isset($tables[$id]))
				$taxonomis[$id] = $tables[$id];
		}

		return $taxonomis;
	}

	function get_taxonomy_tag_by_object_id($object_id) {
		if(!isset($object_id)) return;

		if(is_string($object_id) || is_int($object_id))
			$object_id = array($object_id);

		$taxonomis = array();

		$tables = $this->get_taxonomy(array('post_tag'));
		if($this->isSerialized($tables)) {
			$tables = @unserialize($tables);
		}

		foreach ($object_id as $id) {
			if(isset($tables[$id]))
				$taxonomis[$id] = $tables[$id];
		}

		return $taxonomis;
	}

	function get_post_by_key($keyword = "", $limit = 8) {

		$posts = $this->get_post();

		$keyword = strtolower($keyword);
		if($this->isSerialized($posts)) {
			$posts = @unserialize($posts);
		}

		$return = array();
		$i = 0;
		foreach ($posts as $post) {
			if($i >= $limit) break;

			if(isset($post['post_title']) && strpos(strtolower($post['post_title']), $keyword)) {
				$return[$post['id']] = $post;

				$i++;
			}
		}

		return $return;
	}

	function get_post($data = array('post_type' => 'post', 'post_status' => 'publish')) {

		$filename = __FUNCTION__.md5(serialize($data));

		if(($data_cache = $this->file_cache($filename))) return $data_cache;

		global $wpdb;

		$where = "1=1";
		if(isset($data['post_type'])) {
			$where .= " AND post_type='".$data['post_type']."'";
		}

		if(isset($data['post_status'])) {
			$where .= " AND post_status='".$data['post_status']."'";
		}

		$terms = $wpdb->rawQuery("SELECT ".implode(",",$this->column_defalut_select)." FROM `".TABLE_PREFIX."posts` WHERE {$where}");

		$terms = $this->_parse_result_raw_query($terms, $this->column_defalut_select, "id");

		$this->_cache_temp_table($terms, $filename);

		return $terms;
	}

	function get_taxonomy($taxonomy = array("category","series")) {

		$filename = __FUNCTION__.implode('_',$taxonomy);

		if(($data_cache = $this->file_cache($filename))) return $data_cache;

		global $wpdb;

		$terms = $wpdb->rawQuery("Select * FROM `".TABLE_PREFIX."term_relationships` as tr
	INNER JOIN `".TABLE_PREFIX."term_taxonomy` as tt ON tr.term_taxonomy_id = tt.`term_taxonomy_id`
	INNER JOIN `".TABLE_PREFIX."terms` as t ON tt.term_id = t.term_id where taxonomy IN ('".implode('\',\'',$taxonomy)."')");

		$terms = $this->_parse_result_raw_query($terms,$this->term_field,"object_id");

		$this->_cache_temp_table($terms, $filename);

		return $terms;
	}

	function get_attachment() {

		$filename = __FUNCTION__;

		if(($data_cache = $this->file_cache($filename))) return $data_cache;

		global $wpdb;

		$meta_list = $this->get_meta_value('_thumbnail_id');

		if($this->isSerialized($meta_list)) {
			$meta_list = @unserialize($meta_list);
		}

		$meta_list = $this->_parse_result_raw_query($meta_list,'post_id', 'meta_value');

		$where = "`post_type`='attachment' AND `id` IN (".implode(',',array_keys($meta_list)).")";

		$posts = $wpdb->rawQuery("SELECT `guid`,`post_parent` FROM `".TABLE_PREFIX."posts` WHERE {$where}");

		$posts = $this->_parse_result_raw_query($posts, 'guid','post_parent');

		$this->_cache_temp_table($posts, $filename);

		return $posts;
	}

	function get_meta_value_by($ids, $key = "psp_meta") {
		if(is_string($ids) || is_int($ids)) {
			$ids = array($ids);
		}

		$meta_value = $this->get_meta_value($key);

		if($this->isSerialized($meta_value)) {
			$meta_value = @unserialize($meta_value);
		}

		$meta_value = $this->_parse_result_raw_query($meta_value, 'meta_value', 'post_id');

		$result = array();
		foreach ($ids as $id) {
			if(isset($meta_value[$id]))
				$result[$id] = $meta_value[$id];
		}

		return $result;
	}

	function get_meta_value($meta_key = "") {

		$filename = __FUNCTION__.$meta_key;

		if(($data_cache = $this->file_cache($filename))) return $data_cache;
		global $wpdb;

		$where = " `meta_key` like '".$meta_key."'";

		$meta_list = $wpdb->rawQuery("SELECT `post_id`, `meta_value` FROM `".TABLE_PREFIX."postmeta` WHERE {$where}");

		$this->_cache_temp_table($meta_list, $filename);
		return $meta_list;
	}

	function get_user_meta($ids) {
		if(is_string($ids) || is_int($ids)) {
			$ids = array($ids);
		}

		global $wpdb;

		$usersmeta = $wpdb->rawQuery("SELECT ".implode(',',$this->user_profile_field)." FROM `".TABLE_PREFIX."usermeta` WHERE user_id IN (".implode(',',$ids).")");

		return $this->_parse_result_raw_query($usersmeta, "",'user_id');
	}

	function get_users($ids = NULL) {
		if(is_string($ids) || is_int($ids)) {
			$ids = array($ids);
		}

		global $wpdb;

		$where = "";
		if(!empty($ids)) {
			$where = " AND id IN (".implode(',',$ids).")";
		}

		$usersmeta = $wpdb->rawQuery("SELECT ".implode(',',$this->user_field)." FROM `".TABLE_PREFIX."users` WHERE 1=1 {$where}");

		return $this->_parse_result_raw_query($usersmeta, 'display_name');
	}

	function get_attachment_by_ids($ids) {

		if(is_string($ids)) {
			$ids = array($ids);
		}

		$attacments = $this->get_attachment();

		if($this->isSerialized($attacments)) {
			$attacments = @unserialize($attacments);
		}

		$result = array();
		foreach ($ids as $id) {
			if(isset($attacments[$id]))
				$result[$id] = $attacments[$id];
		}

		return $result;
	}

	function isSerialized($str) {
		return ($str == serialize(false) || @unserialize($str) !== false);
	}

	/**
	 * @param array $info
	 * @param $column
	 * @param string $primary_key
	 * @param array $new_primary_key
	 * @return array
	 *
	 * Gỡ và tách mảng kết quả trả vè theo định dạng quy đinhj: $return[$primary_key] = $info[$column]
	 */
	function _parse_result_raw_query($info = array(), $column = NULL, $primary_key = "id", $new_primary_key = array()) {

		$return = array();
		$i = 0;

		foreach ($info as $post) {

			if(isset($post[$primary_key]))
				$key = $post[$primary_key];
			else
			if(isset($new_primary_key[$i]))
				$key = $new_primary_key[$i];
			else
				$key = $i;

			if(isset($column) && $column) {
				if(is_array($column)) {
					if(count($column) > 1) {
						$new_post = array();
						foreach ($column as $col) {
							$new_post[$col] = $post[$col];
						}
					}
					else
					{
						$column = $column[0];
					}
					$post = $new_post;
				}
				else
					$post = $post[$column];
			}

			$return[$key] = $post;
			$i++;
		}
		return $return;
	}

	function _get_meta_value($params = array(), $compare = "=") {
		if(!isset($params['meta_key']) && !isset($params['post_id']) && !isset($params['meta_id'])) return;

		global $wpdb;

		$where = " 1=1";
		if(isset($params['meta_key'])) {
			$where .= " AND meta_key='".$wpdb->escape($params['meta_key'])."'";
		}

		if(isset($params['post_id'])) {

			if(is_array($params['post_id'])) {
				$where .= " AND post_id IN (".implode(',',$params['post_id']).")";
			}
			else
				$where .= " AND post_id=".(int)$params['post_id']."";
		}

		if(isset($params['meta_id'])) {
			$where .= " AND meta_id=".(int)$params['meta_id']."";
		}

		$result = $wpdb->rawQuery("SELECT `post_id`, `meta_value` FROM `".TABLE_PREFIX."postmeta` WHERE {$where}");

		return $this->_parse_result_raw_query($result,'meta_value','post_id');
	}

	function GetResponse()
	{
		return "OK Da lay duoc du lieu tra ve";
	}

	/**
	 * @param string $filename
	 * @param string $path
	 */
	function _check_image_thumb($url_image = "", $size = "65x65") {

		if(is_array($image_info = parse_url($url_image))) {
			$pathimg =  dirname(dirname(__FILE__)).$image_info['path'];
		}

		if(file_exists($pathimg)) {
			$filename = basename($url_image);

			if(!strpos($filename, $size) ) {
				$y = strpos($filename, '.');

				if($y > 0 && in_array(substr($filename, $y, strlen($filename)),array(
						'.jpg','.jpeg','.png'
					))
				) {
					$new_filename = str_replace('.','-'.$size.'.',$filename);

					if(file_exists(str_replace($filename, $new_filename, $pathimg)) ) {
						$url_image = str_replace($filename, $new_filename, $url_image);
					}
				}
			}
		}

		return $url_image;
	}

	function array_find($needle, $haystack)
	{
		foreach ($haystack as $item)
		{
			if (strpos($item, $needle) !== FALSE)
			{
				return $item;
				break;
			}
		}
	}
}

new getpost();