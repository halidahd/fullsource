<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 5/16/15
 * Time: 2:46 PM
 */
Require_once "baseAPI.php";

class cron extends baseAPI
{
	protected $required = array(
		"category" => array(

		),
	);

	protected $default = array(

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
		$this->checkIP();

		$subaction = strtolower($_GET['subaction']);

		if (!$subaction) $subaction = strtolower($_GET['type']);

		//Kiểm tra dữ liệu nhập vào
		$this->_validateParamRequired($subaction);

		$this->_flush_cache_table_output($subaction);

		if (is_callable(array($this->handlerMethod, $subaction))) {

			call_user_func(array($this->handlerMethod, $subaction));
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}

	function tempTable($tablename = "") {

		if(!$tablename) return;

		$this->time_cache_file = "3600";

		$table = TABLE_PREFIX.$tablename;

		$this->conn_db();

		global $wpdb;

		$tabledata = $wpdb->rawQuery("SELECT * FROM {$table} WHERE 1=1");

		if(empty($tabledata)) {
			$this->SendResponse(self::HTTP_FORBIDDEN,"Get Attachment failed to select: ".$wpdb->getLastQuery() ."\n". $wpdb->getLastError());
		}

		//Save dữ liệu tới file
		$this->_cache_temp_table($tabledata);

		$this->SendResponse(self::HTTP_OK,"");
	}

	function tempTableCategory() {

		$this->time_cache_file = "3600";

		$this->conn_db();

		global $wpdb;

		$tabledata = $wpdb->rawQuery("Select * FROM `".TABLE_PREFIX."term_relationships` as tr
INNER JOIN `".TABLE_PREFIX."term_taxonomy` as tt ON tr.term_taxonomy_id = tt.`term_taxonomy_id`
INNER JOIN `".TABLE_PREFIX."terms` as t ON tt.term_id = t.term_id");

		if(empty($tabledata)) {
			$this->SendResponse(self::HTTP_FORBIDDEN,"Get Attachment failed to select: ".$wpdb->getLastQuery() ."\n". $wpdb->getLastError());
		}

		//Save dữ liệu tới file
		$this->_cache_temp_table($tabledata);

		$this->SendResponse(self::HTTP_OK,"");
	}
}