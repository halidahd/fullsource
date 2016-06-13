<?php
/*
* Define class pspSmushit
* Make sure you skip down to the end of this file, as there are a few
* lines of code that are very important.
*/
!defined('ABSPATH') and exit;
if (class_exists('pspSmushit') != true) {
    class pspSmushit
    {
        /*
        * Some required plugin information
        */
        const VERSION = '1.0';

        /*
        * Store some helpers config
        */
		public $the_plugin = null;

		private $module_folder = '';
		private $module = '';

		static protected $_instance;
		
		private $settings = array();


		const SMUSHIT_URL_BASE =  'http://www.smushit.com/';
		const SMUSHIT_URL = 'http://www.smushit.com/ysmush.it/ws.php?img=%s';
		const SMUSHIT_IMG_MAXSIZE = 1048576; // 1 megabyte

		private static $SMUSHIT_ACTION_URL = '<a href="admin.php?action=psp_smushit&amp;id=%s" class="psp-smushit-action" data-itemid="%s">%s</a>';
		

		/*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct()
        {
        	global $psp;

        	$this->the_plugin = $psp;
			$this->module_folder = $this->the_plugin->cfg['paths']['plugin_dir_url'] . 'modules/smushit/';
			$this->module = $this->the_plugin->cfg['modules']['smushit'];

			$this->settings = $this->the_plugin->get_theoption( 'psp_smushit' );
			
			$this->init();
        }
        
        
		/**
	    * Singleton pattern
	    *
	    * @return pspFileEdit Singleton instance
	    */
	    static public function getInstance()
	    {
	        if (!self::$_instance) {
	            self::$_instance = new self;
	        }
	        
	        // admin media custom smushit columns
	        //add_action( 'admin_init', array( self::$_instance, 'custom_media' ) );
	        
	        return self::$_instance;
	    }
	    
	    
        public function init() {

			if (is_admin()) {
	            add_action('admin_menu', array( &$this, 'adminMenu' ));

		        // smushit action per row!
				//add_action( 'admin_action_psp_smushit', array( $this, 'smushit' ) );
				
				// smushit bulk action!
				//add_action( 'admin_menu', array( $this, 'add_page_smushit_bulk' ) );
				//add_action( 'admin_action_psp_smushit_bulk', array( $this, 'goto_page_smushit_bulk' ) );
        	}

			// smushit on media upload!
        	$do_upload = isset($this->settings['do_upload']) && $this->settings['do_upload']=='yes' ? true : false;
			if ( $do_upload ) {
				if ( $this->the_plugin->capabilities_user_has_module('smushit') ) {
					add_filter( 'wp_generate_attachment_metadata', array( &$this, 'generate_metadata_smushit' ), 10, 2 );
				}
			}

			// ajax helper - ajax smushit
			if ( $this->the_plugin->is_admin === true )
				add_action('wp_ajax_psp_smushit', array( $this, 'ajax_request' ));
        }


		/**
	    * Hooks
	    */
	    static public function adminMenu()
	    {
	       self::getInstance()
	    		->_registerAdminPages();
	    }

	    /**
	    * Register plug-in module admin pages and menus
	    */
		protected function _registerAdminPages()
    	{
    		if ( $this->the_plugin->capabilities_user_has_module('smushit') ) {
	    		add_submenu_page(
	    			$this->the_plugin->alias,
	    			$this->the_plugin->alias . " " . __('Media Smushit', $this->the_plugin->localizationName),
		            __('Media Smushit', $this->the_plugin->localizationName),
		            'read',
		            $this->the_plugin->alias . "_smushit",
		            array($this, 'display_index_page')
		        );
    		}

			return $this;
		}

		public function display_meta_box()
		{
			if ( $this->the_plugin->capabilities_user_has_module('smushit') ) {
			$this->printBoxInterface();
			}
		}

		public function display_index_page()
		{
	    	if( !wp_script_is('psp-media-smushit-js') ) {
	    		wp_enqueue_style( 'psp-media-smushit-js', $this->module_folder .  'app.css', false, '1.0', 'all' );
	    	}
	    	if( !wp_script_is('psp-media-smushit-css') ) {
				wp_enqueue_script( 'psp-media-smushit-css', $this->module_folder . 'app.class.js', array('jquery'), '1.0', false );
	    	}

			$this->printBaseInterface();
		}

        
        /**
         * smushit
         * return: posible values: return | redirect
         */
        public function generate_metadata_smushit( $meta, $attachment_id ) {
        	
        	return $this->meta_smushit_media_sizes( $attachment_id, $meta, true );
        }
        
        public function smushit( $id=null, $force=false, $return='return' ) {
        	
			$ret = array('status' => 'invalid', 'msg' => '');
			
			if ( !current_user_can('upload_files') ) {

				return array_merge( $ret, array('msg' => __('you don\'t have the mandatory permissions for the uploaded files!', $this->the_plugin->localizationName)) );
			}
	
			if ( is_null($id) || (int) $id < 1 ) {
				
				return array_merge( $ret, array('msg' => __('invalid ID from the media file!', $this->the_plugin->localizationName)) );
			}

			$meta = wp_get_attachment_metadata( $id, true ); // get meta for media file
			if ( $meta === false || empty($meta) ) {

				return array_merge( $ret, array('msg' => __('could not retrieve meta data for media file!', $this->the_plugin->localizationName)) );
			}

			if ( wp_attachment_is_image( $id ) === false ) { // media file is an image?

				return array_merge( $ret, array('msg' => __('media file isn\'t an image!', $this->the_plugin->localizationName)) );
			}

			$meta_new = $this->meta_smushit_media_sizes( $id, $meta, $force ); // smushit for all meta sizes of this media file
			$updStat = wp_update_attachment_metadata( $id, $meta_new ); // update meta for media file

			$msg = (array) $this->the_plugin->smushit_show_sizes_msg_details( $meta_new ); $__msg = array();
			if ( isset($meta_new['psp_smushit_errors']) && ( (int) $meta_new['psp_smushit_errors'] ) > 0 ) {
				$status = 'invalid';
				$msg_cssClass = 'error';
				$__msg = array( __('errors occured during smushit operation!', $this->the_plugin->localizationName) );
			}
			else if ( $updStat === true || (int) $updStat > 0 ) {
				$status = 'valid';
				$msg_cssClass = 'success';
			} else {
				$status = 'valid';
				$msg_cssClass = 'success';
			}
			$msg = implode('<br />', array_merge($__msg, $msg));

			if ( $return == 'return' ) {

				return array_merge( $ret, array('status' => $status, 'msg' => $msg) );
			} else {

				wp_safe_redirect( wp_get_referer() );
			}
			die();
        }
        
        private function meta_smushit_media_sizes( $id=null, $meta=array(), $force=false ) {
        	
        	if ( is_null($id) ) return $meta;
        	
			if ( wp_attachment_is_image( $id ) === false ) // media file is an image?
				return $meta;

        	$__meta = $meta;
        	$__meta['psp_smushit_errors'] = 0;

			$mediaAtts = array(
				'path'			=> get_attached_file( $id ),
				'url'			=> wp_get_attachment_url( $id )
			);
			$msghead = $this->msg_header( array('file' => $meta['file'], 'id' => $id) );
			
			// force smushit or resmushit necessary!
			$ms = isset($meta['psp_smushit']) ? $meta['psp_smushit'] : '';
			if ( $force || $this->make_resmush( $ms ) ) {

				$__meta['psp_smushit'] = $this->execute_smushit( $mediaAtts['path'], $mediaAtts['url'], $msghead );
				update_post_meta( $id, 'psp_smushit_status', $__meta['psp_smushit']['status'] );

				$alreadySmushit = $this->already_smushed( $ms, $__meta['psp_smushit'], $msghead );
				if ( $alreadySmushit['status'] )
					$__meta['psp_smushit']['msg'] = $alreadySmushit['msg'];
				
				if ( $__meta['psp_smushit']['status']=='invalid' ) // errors occurred!
					$__meta['psp_smushit_errors']++;
			}
			
			// no media sizes
			if ( !isset( $meta['sizes']) || empty($meta['sizes']) )
				return $__meta;
	
			foreach ( $meta['sizes'] as $key => $val ) {

				$ms_size = '';
				if ( isset($val['psp_smushit']) )
					$ms_size = $val['psp_smushit'];

				if ( !$force && $this->make_resmush( $ms_size ) === false )	continue 1;
				
				$mediaAtts[$key] = array(
					'path'			=> trailingslashit( dirname( $mediaAtts['path'] ) ) . $val['file'],
					'url'			=> trailingslashit( dirname( $mediaAtts['url'] ) ) . $val['file']
				);
				$msghead = $this->msg_header( array('file' => $meta['file'], 'id' => $id, 'size' => $key) );
				
				$__meta['sizes'][$key]['psp_smushit'] = $this->execute_smushit( $mediaAtts[$key]['path'], $mediaAtts[$key]['url'], $msghead );

				$alreadySmushit = $this->already_smushed( $ms_size, $__meta['sizes'][$key]['psp_smushit'], $msghead );
				if ( $alreadySmushit['status'] )
					$__meta['sizes'][$key]['psp_smushit']['msg'] = $alreadySmushit['msg'];

				if ( $__meta['sizes'][$key]['psp_smushit']['status']=='invalid' )
					$__meta['psp_smushit_errors']++;
			}
			
			return $__meta;
        }
        
        private function msg_header( $pms=array() ) {

			// message header!
			$msghead = '';
			if ( !empty($pms)) {
				
				$__msgKey = array();
				//if ( isset($pms['id']) ) $__msgKey[] = __('id: ', $this->the_plugin->localizationName) . $pms['id'];
				//if ( isset($pms['size']) ) $__msgKey[] = __('size: ', $this->the_plugin->localizationName) . $pms['size'];
				//$msghead = '(' . implode(', ', $__msgKey) . '): ';

				if ( isset($pms['size']) ) $__msgKey[] = '<strong>' . $pms['size'] . '</strong>';
				else if ( isset($pms['file']) ) $__msgKey[] = '<strong>' . $pms['file'] . '</strong>';
				$msghead = '' . implode(', ', $__msgKey) . ': ';
			}
			return $msghead;
        }
        
        private function make_resmush( $status_prev='' ) {
        	
        	if ( empty($status_prev) )
        		return true;
        		
        	$status_prev = $status_prev['status'];
        	if ( in_array($status_prev, array('nosave', 'reduced')) ) // smush action already done & successfull!
        		return false;
        		
        	return true;
        }
        
        private function already_smushed( $status_prev, $status, $msghead='' ) {
        
        	$ret = array('status' => false, 'msg' => '');

        	// verify if already smushed! must be the same message & valid operation status
        	if ( isset($status_prev) && isset($status_prev['status']) && isset($status) && isset($status['status'])
        		&& $status_prev['status'] == $status['status'] && $status['status']!='invalid' )
        		return array_merge( $ret, array(
        			'status' 	=> true,
        			'msg' 		=> $msghead . __('already smushed!', $this->the_plugin->localizationName)
        		));
        	
        	return $ret;
        }
        
        private function execute_smushit( $filepath='', $fileurl='', $msghead='' ) {
			$ret = array('status' => 'invalid', 'msg' => '');
			
			// empty file path!
			if ( empty($filepath) )
				return array_merge( $ret, array('msg' => $msghead . __('empty file path!', $this->the_plugin->localizationName)) );

			// empty file url!
			if (empty($fileurl))
				return array_merge( $ret, array('msg' => $msghead . __('empty file url!', $this->the_plugin->localizationName)) );

			// verify if file exists and is readable
			if ( !$this->the_plugin->verifyFileExists($filepath) )
				return array_merge( $ret, array('msg' => $msghead . __('file not found or not readable!', $this->the_plugin->localizationName)) );
	
			// verify if file is writable
			clearstatcache();
			if ( !is_writable( dirname( $filepath)) )
				return array_merge( $ret, array('msg' => $msghead . __('file not writable!', $this->the_plugin->localizationName)) );
	
			// verify if file size exceed limit!
			$filesize = @filesize($filepath);
			if ( $filesize > self::SMUSHIT_IMG_MAXSIZE )
				return array_merge( $ret, array('msg' => $msghead . __('file size exceed allowed yahoo service limit!', $this->the_plugin->localizationName)) );
			
			// only http images work with yahoo service
			$fileurl = str_replace('https://', 'http://', $fileurl);
			
			// verify same domain is activate & validity!
			$same_domain = isset($this->settings['same_domain_url']) && $this->settings['same_domain_url'] == 'yes' ? true : false;
			if ( $same_domain ) {
				$home_url = str_replace('https://', 'http://', get_option('home'));
	
				if (stripos($fileurl, $home_url) !== 0)
					return array_merge( $ret, array('msg' => $msghead . __('same domain rule is activate in options and not respected on this image!', $this->the_plugin->localizationName)) );
			}
			
			// get yahoo service response
			$api_fileurl = sprintf( self::SMUSHIT_URL, urlencode( $fileurl ) );
			$getdata = $this->the_plugin->remote_get( $api_fileurl, 'default', array(
				'user-agent' 	=> 'PSP Smushit Wordpress Plugin',
				'timeout' 		=> isset($this->settings['resp_timeout']) && (int) $this->settings['resp_timeout'] > 0 ? (int) $this->settings['resp_timeout'] : 60
			) );
			
			if ( !isset($getdata) || $getdata['status'] === 'invalid' )
				return array_merge( $ret, array('msg' => $msghead . __('error trying to use remote get!', $this->the_plugin->localizationName)) );

			// decode yahoo service json response
			$getdata = json_decode( $getdata['body'] );
			if ( !isset($getdata->dest_size) )
				return array_merge( $ret, array('msg' => $msghead . __('yahoo service wrong response!', $this->the_plugin->localizationName)) );

			// no smushit necessary
			if ( intval( $getdata->dest_size ) === -1 )
				return array_merge( $ret, array('status' => 'nosave', 'msg' => $msghead . __('no smushit necessary!', $this->the_plugin->localizationName)) );

			// no json response body received!
			if ( !isset( $getdata->dest ) ) {

				$error = isset($getdata->error) ? $msghead . __('yahoo service response error: ', $this->the_plugin->localizationName) . $getdata->error : $msghead . __('yahoo service response unknown error!', $this->the_plugin->localizationName);
				return array_merge( $ret, array('msg' => $error) );
			}

			// json response body - response URL!
			$resp_newurl = $getdata->dest;
	
			// add domain if it's not already there!
			if ( stripos($resp_newurl, 'http://') !== 0 )
				$resp_newurl = self::SMUSHIT_URL_BASE . $resp_newurl;

			// get json processed file - temporary location!
			$file_tmp = download_url( $resp_newurl );

			// error during file retrieving!
			if ( is_wp_error( $file_tmp ) ) {

				@unlink($file_tmp); // delete temporary file!
				return array_merge( $ret, array('msg' => sprintf( $msghead . __('could not download yahoo processed file (%s)!', $this->the_plugin->localizationName), $file_tmp->get_error_message() )) );
			}
			
			// verify if file exists and is readable
			if ( !$this->the_plugin->verifyFileExists($file_tmp) )
				return array_merge( $ret, array('msg' => $msghead . __('yahoo processed temporary file not found or not readable!', $this->the_plugin->localizationName)) );
				
			// temporary file become new image file!
			@unlink( $filepath );
			$isTmpMoved = @rename( $file_tmp, $filepath );
			if ( !$isTmpMoved ) {
				@copy($file_tmp, $filepath);
				@unlink($file_tmp);
			}

			// new image file - reduced!
			$bytes_reduced = intval( $getdata->src_size ) - intval( $getdata->dest_size );
			$bytes_reduced = $this->the_plugin->formatBytes( $bytes_reduced, 2 );

			return array_merge( $ret, array('status' => 'reduced', 'msg' => sprintf( $msghead . __('reduced by %01.2f%% (%s)', $this->the_plugin->localizationName), $getdata->percent, $bytes_reduced )) );
        }
        
        
		/**
		 * smushit Bulk rows!
		 *
		 */
	    public function add_page_smushit_bulk( ) {

	    	// here we have the page where the smushit bulk action is executed!
	    	add_media_page( 'PSP Smushit bulk', 'PSP Smushit bulk', 'edit_others_posts', 'psp-smushit-bulk-page', array( $this, 'smushit_bulk' ) );
	    }
	    
	    public function goto_page_smushit_bulk() {

			check_admin_referer( 'bulk-media' );
	
			if ( !is_array( $_REQUEST['media'] ) || empty($_REQUEST['media']) )
				return false;

			$ids = implode( ',', array_map( 'intval', $_REQUEST['media'] ) );
	
			// go to smushit bulk action page!
			wp_redirect( 
				add_query_arg( '_wpnonce', wp_create_nonce( 'psp-smushit-bulk-nonce' ), admin_url( 'upload.php?page=psp-smushit-bulk-page&goback=1&ids=' . $ids ) )
			);
			die();
	    }

		public function smushit_bulk() {
			$output = true;

			if ( $output ) {

				if ( function_exists( 'apache_setenv' ) ) @apache_setenv('no-gzip', 1);

				@ini_set('output_buffering','on');
				@ini_set('zlib.output_compression', 0);
				@ini_set('implicit_flush', 1);
			}
			
			$ret = array();
			$mediaList = null;
			
			$req = array(
				'ids'			=> isset($_REQUEST['ids']) ? $_REQUEST['ids'] : array(),
				'_wpnonce' 		=> isset($_REQUEST['_wpnonce']) ? $_REQUEST['_wpnonce'] : ''
			);

			if ( isset($req['ids']) ) {

				$mediaList = get_posts( array(
					'numberposts' 		=> -1,
					'post_type' 		=> 'attachment',
					'post_mime_type' 	=> 'image',
					'include' 			=> explode(',', $req['ids'])
				) );

			} else {

				$mediaList = get_posts( array(
					'numberposts' 		=> -1,
					'post_type' 		=> 'attachment',
					'post_mime_type' 	=> 'image'
				));

			}
			
			if ( $output ) {

				@ob_implicit_flush( true );
				@ob_end_flush();
			}

			// verify smushit action nonce & user rights!
			if ( !wp_verify_nonce( $req['_wpnonce'], 'psp-smushit-bulk-nonce' )
				|| !current_user_can( 'edit_others_posts' ) ) {
					
				$ret = array_merge( $ret, array('msg' => __('Invalid request!', $this->the_plugin->localizationName)) );
				wp_die( $ret['msg'], $this->the_plugin->localizationName );
				return;
			}
			
			// verify if there are media files!
			if ( !is_array($mediaList) || empty($mediaList) ) {

				$ret = array_merge( $ret, array('msg' => __('There are no media images uploaded!', $this->the_plugin->localizationName)) );
				if ( $output ) {
					_e( $ret['msg'], $this->the_plugin->localizationName );
				}

				@ob_flush();
				flush();
				return;
			}

			if ( $output ) {
				printf( "<div style='margin:0px 0px 10px 0px;'>" . __("The number of attachements to be processed is <strong>%s</strong>.", $this->the_plugin->localizationName) . '<br />', count($mediaList) );
			}
			foreach( $mediaList as $media ) {
				
				if ( $output ) {
					printf( "<div style='padding:10px 0px 0px 20px;'>" . __("Media file: <a href='%s' target='_blank'><strong>%s</strong></a> | id: <em>%s</em>", $this->the_plugin->localizationName) . "<br />", esc_html( $media->guid ), esc_html( $media->post_name ), esc_html( $media->ID ) );
				}

				$media_id = (int) $media->ID;

				$ret[$media_id] = $this->smushit($media_id, false, 'return');
				
				if ( $output )
					echo $ret[$media_id]['msg'];
				
				if ( $output )
					echo '</div>';
					
				sleep(0.7);
				@ob_flush();
				flush();
			}
			if ( $output )
				echo '</div>';
				
			return;
		}
		
		
        /**
         * Media custom smushit columns
         *
         */
        
	    public function custom_media() {

	    	if( !wp_script_is('psp-media-smushit-js') ) {
	    		wp_enqueue_style( 'psp-media-smushit-js', $this->module_folder .  'app.css', false, '1.0', 'all' );
	    	}
	    	if( !wp_script_is('psp-media-smushit-css') ) {
				wp_enqueue_script( 'psp-media-smushit-css', $this->module_folder . 'app.class.js', array('jquery'), '1.0', false );
	    	}

	    	$screens = array('media');
		    foreach ($screens as $screen) {

				//add_filter( 'manage_edit-' . $screen . '_columns', array( $this, 'media_columns_head' ), 10, 1 );
				add_filter( 'manage_' . $screen . '_columns', array( $this, 'media_columns_head' ), 10, 1 );
				add_action( 'manage_' . $screen . '_custom_column', array( $this, 'media_columns_body' ), 10, 2 );
		    }
	    }
	    
		public function media_columns_head($columns) {
			$new_columns = $columns;
		    $new_columns['psp_smushit'] = 'PSP Smushit';
		    return $new_columns;
		}

		public function media_columns_body($column_name, $id) {
		    global $id;
			
		    // verify that it's smushit column and we have an image media file!
			if ( $column_name=='psp_smushit' && wp_attachment_is_image( $id ) ) {

				echo '<div class="psp-smushit-wrapper">';
				echo 	'<span class="psp-smushit-loading"></span>';

				// retrieve the existing value(s) for this meta field. This returns an array
				$meta_new = wp_get_attachment_metadata( $id );

				if ( isset($meta_new['psp_smushit']) && !empty($meta_new['psp_smushit']) ) {

					$msg = (array) $this->the_plugin->smushit_show_sizes_msg_details( $meta_new ); $__msg = array();
					if ( isset($meta_new['psp_smushit_errors']) && ( (int) $meta_new['psp_smushit_errors'] ) > 0 ) {
						$status = 'invalid';
						$msg_cssClass = 'error';
						$__msg = array( __('errors occured during smushit operation!', $this->the_plugin->localizationName) );
					} else {
						$status = 'valid';
						$msg_cssClass = 'success';
					}
					$msg = implode('<br />', array_merge($__msg, $msg));

					echo '<span id="' . ('psp-smushit-resp-'.$id) . '" class="' . $msg_cssClass . '">' . $msg . '</span><br />';
					printf( self::$SMUSHIT_ACTION_URL, $id, $id, __( 'smushit again!', $this->the_plugin->localizationName ) );
				} else {
					
					echo '<span id="' . ('psp-smushit-resp-'.$id) . '" class="info">' . __( 'not processed!', $this->the_plugin->localizationName ) . '</span><br />';
					printf( self::$SMUSHIT_ACTION_URL, $id, $id, __( 'smushit Now!', $this->the_plugin->localizationName ) );
				}
				echo '</div>';
			}
		}


		/*
		* ajax_request, method
		* --------------------
		*
		*/
		public function ajax_request()
		{
			$req = array(
				'id' 			=> isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0
			);
			
			$ret = $this->smushit($req['id'], true, 'return');

			die( json_encode(array(
				'status' 	=> $ret['status'],
				'data'	 	=> $ret['msg'],
				'data_dbg'	=> 'id response: ' . $req['id']
			)) );
		}
		
		
		/*
		* printBaseInterface, method
		* --------------------------
		*
		* this will add the base DOM code for you options interface
		*/
		private function printBaseInterface()
		{
			
	    	if( !wp_script_is('psp-media-smushit-js') ) {
	    		wp_enqueue_style( 'psp-media-smushit-js', $this->module_folder .  'app.css', false, '1.0', 'all' );
	    	}
	    	if( !wp_script_is('psp-media-smushit-css') ) {
				wp_enqueue_script( 'psp-media-smushit-css', $this->module_folder . 'app.class.js', array('jquery'), '1.0', false );
	    	}
?>
		<?php /*
		<link rel='stylesheet' href='<?php echo $this->module_folder;?>app.css' type='text/css' media='screen' />
		<script type="text/javascript" src="<?php echo $this->module_folder;?>app.class.js" ></script>
		*/ ?>
		<div id="psp-wrapper" class="fluid wrapper-psp">
			<?php
			// show the top menu
			pspAdminMenu::getInstance()->make_active('advanced_setup|smushit')->show_menu();
			?>
			
			<!-- Page detail -->
			<div id="psp-pagespeed-detail">
				<div id="psp-pagespeed-ajaxresponse"></div>
			</div>
				
			<!-- Main loading box -->
			<div id="psp-main-loading">
				<div id="psp-loading-overlay"></div>
				<div id="psp-loading-box">
					<div class="psp-loading-text"><?php _e('Loading', $this->the_plugin->localizationName);?></div>
					<div class="psp-meter psp-animate" style="width:86%; margin: 34px 0px 0px 7%;"><span style="width:100%"></span></div>
				</div>
			</div>

			<!-- Content -->
			<div id="psp-content">
				
				<h1 class="psp-section-headline">
					<?php echo $this->module['smushit']['menu']['title'];?>
					<span class="psp-section-info"><?php echo $this->module['smushit']['description'];?></span>
					<?php
					$has_help = isset($this->module['smushit']['help']) ? true : false;
					if( $has_help === true ){
						
						$help_type = isset($this->module['smushit']['help']['type']) && $this->module['smushit']['help']['type'] ? 'remote' : 'local';
						if( $help_type == 'remote' ){
							echo '<a href="#load_docs" class="psp-show-docs" data-helptype="' . ( $help_type ) . '" data-url="' . ( $this->module['smushit']['help']['url'] ) . '">HELP</a>';
						} 
					} 
					?>
				</h1>

				<!-- Container -->
				<div class="psp-container clearfix">

					<!-- Main Content Wrapper -->
					<div id="psp-content-wrap" class="clearfix">

						<!-- Content Area -->
						<div id="psp-content-area">
							<div class="psp-grid_4">
	                        	<div class="psp-panel">
	                        		<div class="psp-panel-header">
										<span class="psp-panel-title">
											<?php _e('Media files Smushit!', $this->the_plugin->localizationName);?>
										</span>
									</div>
									<div class="psp-panel-content">
										<form class="psp-form" id="1" action="#save_with_ajax">
											<div class="psp-form-row psp-table-ajax-list" id="psp-table-ajax-response">
											<?php
											//$settings = $this->the_plugin->getAllSettings( 'array', 'psp_smushit' );
											$settings = $this->settings;
											$attrs = array(
												'id' 				=> 'pspSmushit',
												'show_header' 		=> true,
												'items_per_page' 	=> '10',
												'post_statuses' 	=> 'all',
												'show_header_buttons' => true,
												'columns'			=> array(
													'checkbox'	=> array(
														'th'	=>  'checkbox',
														'td'	=>  'checkbox',
													),

													'id'		=> array(
														'th'	=> __('ID', $this->the_plugin->localizationName),
														'td'	=> '%ID%',
														'width' => '40'
													),
													
													'thumbnail'		=> array(
														'th'	=> __('', $this->the_plugin->localizationName),
														'td'	=> '%thumbnail%',
														'align' => 'left',
														'width' => '60'
													),

													'title'		=> array(
														'th'	=> __('File', $this->the_plugin->localizationName),
														'td'	=> '%title%',
														'align' => 'left',
														'width' => '250'
													),

													'smushit'		=> array(
														'th'	=> __('Smushit Status', $this->the_plugin->localizationName),
														'td'	=> '%smushit_status%',
														'align' => 'left'
													),
													
													'date'		=> array(
														'th'	=> __('Date', $this->the_plugin->localizationName),
														'td'	=> '%date%',
														'width' => '120'
													),
													
													'optimize_btn' => array(
														'th'	=> __('Action', $this->the_plugin->localizationName),
														'td'	=> '%button%',
														'option' => array(
															'value' => __('Smushit', $this->the_plugin->localizationName),
															'action' => 'do_item_smushit',
															'color' => 'orange'
														),
														'width' => '80'
													),
												),
												'mass_actions' 	=> array(
														'speed_test_mass' => array(
															'value' => __('Mass Smushit', $this->the_plugin->localizationName),
															'action' => 'do_mass_smushit',
															'color' => 'blue'
														)
												)
											);
											
											pspAjaxListTable::getInstance( $this->the_plugin )
												->setup( $attrs )
												->print_html();
								            ?>
								            </div>
							            </form>
				            		</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php
		}

    }
}

// Initialize the pspSmushit class
//$pspSmushit = new pspSmushit();
$pspSmushit = pspSmushit::getInstance();