<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 5/21/15
 * Time: 7:57 PM
 */

Require_once "baseAPI.php";

class recipe extends baseAPI
{
	protected $required = array(
		"history" => array(

		),
	);

	protected $default = array(
		"history" => array(
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

	private $column_field = array(
		'name', 'image', 'datePublished', 'description', 'ratingValue', 'reviewCount', 'prepTime', 'cookTime', 'totalTime', 'ingredients', 'instructions', 'link'
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
		usleep(100000); //Cho` 0,5s

		$subaction = strtolower($_GET['subaction']);

		if (!$subaction) $subaction = strtolower($_GET['type']);

		//Kiểm tra dữ liệu nhập vào
		$this->_validateParamRequired($subaction);

		if (is_callable(array($this->handlerMethod, $subaction))) {

			call_user_func(array($this->handlerMethod, $subaction));
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}

	function history($subaction = "") {

		switch ($subaction) {
			case 'save':
				break;
			case 'default':
				$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại kiểu hành động yêu cầu");
				break;
		}

		//Tạo kết nối db để get dữ liệu
		$this->conn_db();

		global $wpdb;
		//Save công thức vào bảng history ( chỉ cần truyền ID công thức )
		if($subaction == 'save') {

			//Parse tham số truyền lên.
			$where = "post_status = 'publish'"; //chi save post ở trạng thái public
			$limit = 1; // moi lan save chi dc 1 cong thuc

			if(isset($this->data['id'])) {
				$this->data['id'] = stripslashes( $this->data['id'] );

				$where .=  " AND id=".(int)$this->data['id']; //ton tai post id thi goi ham save du lieu luon
			} else
			if(isset($this->data['slug'])) {
				$this->data['slug'] = stripslashes( $this->data['slug'] );

				// there are no line breaks in <input /> fields
				$primary = str_replace( array( "\r", "\n" ), '', $this->data['slug'] );
				$where .= " AND post_name like '".$wpdb->escape($primary)."'";
			}

			$post = $wpdb->rawQuery("SELECT ".implode(",",$this->column_defalut_select)." FROM `new.atgd`.`".TABLE_PREFIX."posts` WHERE {$where} LIMIT $limit");

			if(!$post) {
				$this->SendResponse(self::HTTP_FORBIDDEN,"Post failed to select: ".$wpdb->getLastQuery() ."\n". $wpdb->getLastError());
			}

			if(is_array($post)) {
				$post = $post[0];
			}

			//insert du lieu
			$insertData = array(
				'name' => $post['post_title'],
				'image' => isset($this->data['image'])? $wpdb->escape($this->data['image']) : '',
				'datePublished' => $post['post_data'],
				'description' => isset($this->data['description'])? $wpdb->escape($this->data['description']) : '',
				'ratingValue' => isset($this->data['ratingValue'])? $wpdb->escape($this->data['ratingValue']) : 0,
				'reviewCount' => isset($this->data['reviewCount'])? (int)$this->data['reviewCount'] : 0,
				'totalTime' => isset($this->data['totalTime'])? $wpdb->escape($this->data['totalTime']) : 20,
				'link' => $post['guid'],
			);

			$result = $wpdb->insert('`id_atgd`.`default_history_recipes`', $insertData);
			if(empty($result)) {
				$this->SendResponse(self::HTTP_FORBIDDEN,"Recipes failed to insert: ".$wpdb->getLastQuery() ."\n". $wpdb->getLastError());
			}

			$this->SendResponse(self::HTTP_OK,'');
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại kiểu hành động yêu cầu");
	}
}