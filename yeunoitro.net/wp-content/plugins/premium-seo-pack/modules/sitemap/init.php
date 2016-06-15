<?php
/**
 * Sitemap Generator Class
 * http://www.aa-team.com
 * ======================
 *
 * @package			pspSeo
 * @author			AA-Team
 */
class pspSeoSitemap
{
	/*
    * Some required plugin information
    */
    const VERSION = '1.0';

    /*
    * Store some helpers config
    */
	public $the_plugin = null;

	protected $module_folder = '';
	protected $module_folder_path = '';
	private $module = '';
	
	protected $settings = array();
	protected $video_include = array();

	static protected $_instance;
	
	private $file_cache_directory = '/psp-videos';
	
	/**
	*
	* @var XMLWriter
	*/
	private $writer;
	private $domain;
	private $path;
	private $filename = 'sitemap';
	private $current_item = 0;
	private $current_sitemap = 0;
	
	const EXT = '.xml';
	const SCHEMA = 'http://www.sitemaps.org/schemas/sitemap/0.9';
	const SCHEMA_IMG = 'http://www.google.com/schemas/sitemap-image/1.1';
	const SCHEMA_VIDEO = 'http://www.google.com/schemas/sitemap-video/1.1';
	const DEFAULT_PRIORITY = 0.5;
	const DEFAULT_FREQUENCY = 'monthly';
	const ITEM_PER_SITEMAP = 100000;
	const SEPERATOR = '-';
	const INDEX_SUFFIX = 'index';
	
	const VIDEOAPI_FORCE_SITEMAP = false;
	const VIDEOAPI_FORCE_CONTENT = false;
	static private $metaLifetime = 1209600; // lifetime in seconds! - 2 weeks
	static private $metaRandomLifetime = 43200;
	static private $imageIdentifiers = array(
		'default'	=> '[\'\"]((?:http|https):\/\/.[^\'\"]+\.(?:jpe?g|png|gif))[\'\"]',
		'mysql'		=> '[\'\"](http|https):\/\/.[^\'\"]+\.(jpe?g|png|gif)[\'\"]'
	);
	static private $videoIdentifies = array(
		'youtube'		=> array(
			'mysql'		=> 'youtube\.com|youtube-nocookie\.com|youtu\.be',
			'default'	=> '
				(?:
					(?:
						youtu\.be\/
						|
						youtube\.com\/
						|
						youtube-nocookie\.com\/
					)
					(?:
						v\/
						|
						watch\?.*v=|embed\/
					)
				)
				([\w\-]+)
			'
		)
		,'dailymotion' 	=> array(
			'mysql'		=> 'dailymotion\.com|dai\.ly',
			'default'	=> '
				(?:
					(?:
						dailymotion\.com\/
						(?:embed\/|)(?:video\/)
					)
					|
					(?:
						dai\.ly\/
					)
				)
				([a-zA-Z0-9\-]+)
			'
		)
		,'vimeo' 		=> array(
			'mysql'		=> 'vimeo\.com',
			'default'	=> '
				(?:
					(?:
						player\.vimeo\.com
						(?:[\/\w]*\/videos?)?\/
					)
					|
					(?:
						(?:https?):\/\/
						(?:[\w]+\.)*vimeo\.com\/
						(?:moogaloop\.swf\?clip_id=)?
					)
				)
				([0-9\-]+)
			'
		)
		,'metacafe'		=> array(
			'mysql'		=> 'metacafe\.com',
			'default'	=> '
				(?:
					metacafe\.com\/
					(?:embed|watch)\/
				)
				([0-9\-]+)
			'
		)
		,'veoh'			=> array(
			'mysql'		=> 'veoh\.com',
			'default'	=> '
				(?:
					veoh\.com\/
					(?:videos|watch)\/
				)
				([\w\-]+)
			'
		)
		,'screenr'		=> array(
			'mysql'		=> 'screenr\.com',
			'default'	=> '
				(?:
					screenr\.com
					(?:\/embed)?\/
				)
				([\w\-]+)
			'
		)
		,'blip'			=> array(
			'mysql'		=> 'blip\.tv',
			'default'	=> '
				(?:
					blip\.tv\/
					(?:
						play\/
						|
						[\w\-]+\/[\w\-]+\-
						|
					)
					([\w\-]+)
				)
			'
		)
		,'dotsub'		=> array(
			'mysql'		=> 'dotsub\.com',
			'default'	=> '
				(?:
					dotsub\.com\/
					(?:view|media)\/
				)
				([\w\-]+)
				(?:\/embed\/|)
			'
		)
		,'viddler'		=> array(
			'mysql'		=> 'viddler\.com',
			'default'	=> '
				(?:
					viddler\.com
					(?:\/v|\/embed)\/
				)
				([\w\-]+)
			'
		)
		,'wistia'		=> array(
			'mysql'		=> 'wistia\.com',
			'default'	=> '
				(?:
					(?:
						fast\.wistia\.com\/embed\/iframe
						|
						home\.wistia\.com\/medias
					)
					\/
				)
				([\w\-]+)
			'
		)
		,'vzaar'		=> array(
			'mysql'		=> 'vzaar\.com',
			'default'	=> '
				(?:
					(?:
						vzaar\.com\/videos
						|
						view\.vzaar\.com
					)
					\/
					([\w\-]+)
					(video|player|download|flashplayer)\/?
				)
			'
		)
		,'flickr'		=> array(
			'mysql'		=> 'flickr\.com',
			'default'	=> '
				(?:
					(?:
						flickr\.com\/.*
					)
					\/
					(\d+)
					\/
				)
			'
		)
	);

    /*
    * Required __construct() function
    */
    public function __construct()
    {
    	global $psp;

    	$this->the_plugin = $psp;
		$this->module_folder = $this->the_plugin->cfg['paths']['plugin_dir_url'] . 'modules/sitemap/';
		$this->module_folder_path = $this->the_plugin->cfg['paths']['plugin_dir_path'] . 'modules/sitemap/';
		$this->module = $this->the_plugin->cfg['modules']['sitemap'];
    	
    	$this->settings = $this->the_plugin->getAllSettings( 'array', 'sitemap' );
    	$this->video_include = isset($this->settings['video_include']) ? $this->settings['video_include'] : '';
    	
    	$selfhost = parse_url( home_url() ); $selfhost = $selfhost['host'];
    	self::$videoIdentifies = array_merge( self::$videoIdentifies, array(
    		'localhost'	=> array(
    			//'mysql'			=> '\.(mp?4|avi|flv|wmv|mov|mpg|m4p|mkv|3GPP|ogv|MPEGPS|wmv|3gp|WebM|divx|rm|mpe|mpeg|mpeg2|mpeg4|DAT)',
    			'mysql'			=> '',
    			'default'		=> ''
    				.preg_quote($selfhost)
    				.'.*\.(?:mp?4|avi|flv|wmv|mov|mpg|m4p|mkv|3GPP|ogv|MPEGPS|wmv|3gp|WebM|divx|rm|mpe|mpeg|mpeg2|mpeg4|DAT)$'
    		)
    	));
    	self::$metaRandomLifetime = range(43200, 432000, 43200); // random range in seconds!
    	
    	if ( !$this->the_plugin->verify_module_status( 'sitemap' ) ) ; //module is inactive
    	else {
	    	if ( is_admin() ) {
	    	} else {
				add_filter( 'the_content', array( $this, 'content_add_video_snippets' ), 6, 1 );
				
				// opengraph related!
				if ( isset($this->settings['video_social_force']) && $this->settings['video_social_force']=='yes' ) {
					add_action( 'premiumseo_opengraph', array( $this, 'video_opengraph' ) );
					add_filter( 'premiumseo_opengraph_type', array( $this, 'video_opengraph_type' ), 10, 1 );
					add_filter( 'premiumseo_opengraph_title', array( $this, 'video_opengraph_title' ), 10, 1 );
					add_filter( 'premiumseo_opengraph_description', array( $this, 'video_opengraph_description' ), 10, 1 );
					add_filter( 'premiumseo_opengraph_image', array( $this, 'video_opengraph_image' ), 10, 1 );
				}
	    	}
    	}

		if ( $this->the_plugin->is_admin !== true )
    		$this->detect_if_sitemap_page();
    }
    
	/**
    * Singleton pattern
    *
    * @return pspSeoSitemap Singleton instance
    */
    static public function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }
	
	private function detect_if_sitemap_page()
	{
		$permalink = get_option('permalink_structure');
		$siteurl = get_option('siteurl');
		$parts = parse_url($siteurl);
		$path = isset($parts['path']) ? $parts['path'] : '';

		$uri = $_SERVER['REQUEST_URI'];
		$path_len = strlen($path);
		if(strlen($uri) > $path_len && substr($uri,0,$path_len) == $path)
		{
			$request = substr($uri,$path_len);
			$parts = parse_url($request);
			
			switch($parts['path'])
			{
				case '/sitemap.xml':
				case '/sitemap-images.xml':
				case '/sitemap-videos.xml':
					ini_set('memory_limit', '512M');
					@ini_set('max_execution_time', 0);
					@set_time_limit(0); // infinte

				case '/sitemap.xml':
					$this->print_sitemap();
					break;
				case '/sitemap-images.xml':
					$this->print_sitemap_images();
					break;
				case '/sitemap-videos.xml':
					$this->print_sitemap_videos();
					break;
				default: 
					break;
			}
		}
	}
	
	
	/**
	 * get Items: posts | pages | custom post types
	 *
	 */
	
	private function get_items( $post_type='all' )
	{
		/* default arguments!
		$args = array(
			'posts_per_page'   => 5,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'post',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true );
		*/
		$args = array( 
			'posts_per_page' => -1, 
			'offset'=> 1
		);
		
		if( $post_type != "all" ){
			$args['post_type'] = $post_type;
		}

		return get_posts( $args );
	}

	//get all published posts, pages, custom post types!
	private function get_items2( $post_type='post,page', $media_type=array() ) {
		global $wpdb;
		
		$sql = "
			SELECT a.ID, a.post_type, a.post_mime_type, a.post_parent, a.post_content, a.guid, a.post_modified, a.post_title, a.post_excerpt, a.post_date_gmt, a.post_author
			 FROM " . $wpdb->prefix . "posts AS a
			 WHERE 1=1
			 %s %s %s
			 ORDER BY a.post_date DESC
			;
		";

		$alwaysClause = $this->itemIsIncluded(); //sitemap always included items
		$clause = $this->clause_post_type($post_type, 'a');

		$clause_media = '';
		if ( is_array($media_type) && !empty($media_type) ) {

			if ( in_array('images', array_keys($media_type)) ) {
				$clause_media = $this->clause_content_images('a', $media_type['images']);
			} else if ( in_array('videos', array_keys($media_type)) ) {
				$clause_media = $this->clause_content_videos('a', $media_type['videos']);
			}
		}
		
		$sql = sprintf($sql, $clause, $alwaysClause, $clause_media);

		$res = $wpdb->get_results( $sql );
		return $res;
	}
	
	private function itemIsIncluded( $dbAlias='a' ) {
		global $wpdb;
		
		$sql = "
			SELECT a.post_id
			 FROM " . $wpdb->prefix . "postmeta AS a
			 WHERE 1=1
			 AND a.meta_key = 'psp_sitemap_isincluded' AND a.meta_value = 'always_include'
			 ORDER BY a.post_id ASC
			;
		";
		$res = $wpdb->get_results( $sql );

		$clause = '';
		$ret = array();
		if (is_array($res) && count($res)>0) {
			foreach ($res as $k=>$v) {
				$ret[] = $v->post_id;
			}
			$ret = array_map( array($this, 'prepareForInList'), $ret);
			$ret = implode(',', $ret);
			$clause = " OR {$dbAlias}.ID IN ($ret) ";
		}
		return $clause;
	}
	
	private function clause_post_type( $post_type='post,page', $dbAlias='a' ) {
		if ( empty($post_type) ) return false;
		
		$clause = " AND ( {$dbAlias}.post_status = 'publish' ";

		$post_type = explode(',', $post_type);
		$post_type = array_map( array($this, 'prepareForInList'), $post_type);
		$post_type2 = implode(',', $post_type);

		if ( !empty($post_type) ) {
			if (count($post_type)>1) {
				$clause .= " AND {$dbAlias}.post_type IN (" . $post_type2 . ") ";
			} else {
				$clause .= " AND {$dbAlias}.post_type = " . $post_type2 . " ";
			}
		}
		$clause .= " ) ";
		return $clause;
	}
	
	private function clause_content_images( $dbAlias='a', $media=array() ) {

		$clause = " AND ( ";
		$clause .= " {$dbAlias}.post_content regexp \"" . self::$imageIdentifiers['mysql'] . "\" ";
		if ( is_array($media) && !empty($media) ) {

			$list = array_keys($media);
			$list2 = array_map( array($this, 'prepareForInList'), $list);
			$list2 = implode(',', $list2);
			
			if (count($list)>1) {
				$clause .= " OR {$dbAlias}.ID IN (" . $list2 . ") ";
			} else {
				$clause .= " OR {$dbAlias}.ID = " . $list2 . " ";
			}
		}
		$clause .= " ) ";

		if ( preg_match('/\s*(?:and)\s*\(\s*\)\s*/i', $clause) > 0 ) return '';
		return $clause;
	}
	
	private function clause_content_videos( $dbAlias='a', $media=array() ) {

		if ( empty($this->video_include) ) return " AND ( 1 = 2 ) ";

		$videoRegex = array();
		if ( is_array(self::$videoIdentifies) && !empty(self::$videoIdentifies) ) {
			foreach ( self::$videoIdentifies as $key => $val ) {
				if ( $key == 'localhost' ) continue 1;
				$videoRegex[] = $val['mysql'];
			}
		}
		$videoRegex = implode('|', $videoRegex);
		
		$clause = "";
		if ( !in_array('localhost', (array) $this->video_include) ) $clause .= "";
		else
			$clause .= " AND ( {$dbAlias}.post_content regexp \"" . $videoRegex . "\" ";

		if ( is_array($media) && !empty($media) ) {

			$list = array_keys($media);
			$list2 = array_map( array($this, 'prepareForInList'), $list);
			$list2 = implode(',', $list2);
			
			if (count($list)>1) {
				$clause .= ( empty($clause) ? " AND " : " OR ")
					. "{$dbAlias}.ID IN (" . $list2 . ") "
					. ( empty($clause) ? "" : " ) ");
			} else {
				$clause .= ( empty($clause) ? " AND " : " OR ")
					. "{$dbAlias}.ID = " . $list2 . " "
					. ( empty($clause) ? "" : " ) ");
			}
		} else {
			$clause .= empty($clause) ? "" : " ) ";
		}

		if ( preg_match('/\s*(?:and)\s*\(\s*\)\s*/i', $clause) > 0 ) return '';
		return $clause;
	}


	/**
	 * get Images
	 *
	 */

	//get all attachments - used to find media images!
	private function get_images( $post_type='post,page' ) {
		global $wpdb;
		
		$sql = "
			SELECT a.ID, a.post_type, a.post_mime_type, a.post_parent, a.guid
			 FROM " . $wpdb->prefix . "posts AS a
			 LEFT JOIN " . $wpdb->prefix . "posts AS b ON a.post_parent=b.ID
			 WHERE 1=1
			 AND ( a.post_parent>0 AND a.post_type = 'attachment' AND a.post_status = 'inherit' AND a.post_mime_type REGEXP 'image/[[:alpha:]]+' AND a.guid!='' )
			 %s
			 ORDER BY a.post_date DESC
			;
		";

		$clause = $this->clause_post_type($post_type, 'b');
		$sql = sprintf($sql, $clause);

		$res = $wpdb->get_results( $sql );
		return $res;
	}

	//retrieve images
	private function filter_images( $images=array() ) {
		if ( empty($images) ) return array();
		
		$__images = array();

		if ( is_array($images) && count($images)>0 ) {
			foreach ($images as $k=>$post) {
				$__images[ $post->post_parent ][] = $post->guid;
			}
		}
		return $__images;
	}
	private function filter_item_image( $post ) {
		if ( empty($post) ) return array();

		$__images = array();

		$pattern = "/" . self::$imageIdentifiers['default'] . "/ui"; //utf-8, case insensitive
		if( preg_match_all($pattern, $post->post_content, $matches, PREG_SET_ORDER)) {
			foreach($matches as $match) {
				//$__images[ $post->ID ][] = $match[1]; //retrieve only the link!
				$__images[] = $match[1];
			}
		}
		$__images = array_values( array_unique($__images) );
		return $__images;
	}
	
	
	/**
	 * get Videos
	 *
	 */
	
	private function get_video_dbinfo( $guid='' ) {
		if ( empty($guid) ) return array();
		
		global $wpdb;

		$sql = "
			SELECT a.ID, a.post_type, a.post_mime_type, a.post_parent, a.guid, a.post_title, a.post_content, a.post_excerpt, a.post_date_gmt
			 FROM " . $wpdb->prefix . "posts as a
			 WHERE 1=1
			 AND a.guid = %s
			 AND ( a.post_password='' AND a.post_parent>0 AND a.post_type = 'attachment' AND a.post_status = 'inherit' AND a.post_mime_type REGEXP 'video/' AND a.guid!='' )
			 LIMIT 1
			;
		";
		$sql = $wpdb->prepare($sql, $guid);
		$res = $wpdb->get_row( $sql );
		return $res;
	}

	//get all attachments - used to find media videos!
	private function get_videos( $post_type='post,page', $post_id = 0 ) {
		
		if ( empty($this->video_include) ) return array();
		if ( !in_array('localhost', (array) $this->video_include) ) return array();

		global $wpdb;

		$sql = "
			SELECT a.ID, a.post_type, a.post_mime_type, a.post_parent, a.guid, a.post_title, a.post_content, a.post_excerpt, a.post_date_gmt
			 FROM " . $wpdb->prefix . "posts AS a
			 LEFT JOIN " . $wpdb->prefix . "posts AS b ON a.post_parent=b.ID
			 WHERE 1=1
			 AND ( a.post_password='' AND a.post_parent>0 AND a.post_type = 'attachment' AND a.post_status = 'inherit' AND a.post_mime_type REGEXP 'video/' AND a.guid!='' )
			 %s %s
			 ORDER BY a.post_date DESC
			;
		";

		$clause = $this->clause_post_type($post_type, 'b');

		$clause_perpost = '';
		if ( isset($post_id) && $post_id > 0 )
			$clause_perpost = " and b.ID = '$post_id' ";

		$sql = sprintf($sql, $clause_perpost, $clause);

		$res = $wpdb->get_results( $sql );
		return $res;
	}
	
	//retrieve images
	private function filter_videos( $images=array() ) {
		if ( empty($images) ) return array();
		
		if ( empty($this->video_include) ) return array();
		if ( !in_array('localhost', (array) $this->video_include) ) return array();
		
		$__images = array();
		$extrainfo = array();

		if ( is_array($images) && count($images)>0 ) {
			foreach ($images as $k=>$post) {

				if ( empty($post->guid) ) continue 1;

				$__images[ $post->post_parent ]['localhost'][] = $post->guid;
				//$alias = 'post_'.$post->ID;
				$extrainfo[ $post->post_parent ]['localhost'][] = $post;
			}
		}
		
		return array(
			'extrainfo'		=> $extrainfo,
			'videos' 		=> $__images
		);
	}
	private function filter_item_video( $content ) {
		if ( empty($this->video_include) ) return array();

		//$content = $this->strip_shortcode( $content ); // strip shortcodes!
		if ( empty($content) ) return array(); // validate content!
		
		// php query class
		require_once( $this->the_plugin->cfg['paths']['scripts_dir_path'] . '/php-query/php-query.php' );
		if ( !empty($this->the_plugin->charset) )
			$doc = pspphpQuery::newDocument( $content, $this->the_plugin->charset );
		else
			$doc = pspphpQuery::newDocument( $content );
		
		$__founds = array();
		
		// Video - wp shortcode! - treated in Just Plain Links!
		/*$regex_video = '
			\[video(?:[^\]]+)?
				(http(?:s|v|vh|vp|a)?:\/\/(?:www\.)?[^\s"]+)
			\]\s*\[\/video\]
		';
		$regex_video = '/'.$regex_video.'/ixum';
		preg_match_all( $regex_video, $content, $wpvideos, PREG_SET_ORDER );
		if ( !empty($wpvideos) ) { foreach ( $wpvideos as $match ) {
			if ( empty($match[1]) ) continue 1;
			$__founds[] = $match[1];
		} }*/
		
		// Embeds - wp shortcode!
		$regex_embeds = '
			\[embed(?:[^\]]+)?\]
				(http(?:s|v|vh|vp|a)?:\/\/(?:www\.)?[^\s"]+)
			\[\/embed\]
		';
		$regex_embeds = '/'.$regex_embeds.'/ixum';
		preg_match_all( $regex_embeds, $content, $embeds, PREG_SET_ORDER );
		if ( !empty($embeds) ) { foreach ( $embeds as $match ) {
			if ( empty($match[1]) ) continue 1;
			$__founds[] = $match[1];
		} }

		// Embeds - inside other objects!
		$embeds2 = $doc->find('embed');
		foreach( $embeds2 as $tag ) {
			$tag = pspPQ($tag); // cache the object

			// special cases!
			//if ( preg_match('/flickr\.com/iu', $tag->attr('src')) > 0 ) {
			//	continue 1;
			//}
			$__founds[] = $tag->attr('src');
		}
		
		// IFrames!
		$iframes = $doc->find('iframe');
		foreach( $iframes as $tag ) {
			$tag = pspPQ($tag); // cache the object
			$__founds[] = $tag->attr('src');
		}
		
		// Objects!
		$objects = $doc->find('object');
		foreach( $objects as $tag ) {
			$tag = pspPQ($tag); // cache the object
			$tag = $tag->find('param');
			
			$isSpecial = false; $specialVal = '';
			foreach( $tag as $param ) {
				$param = pspPQ($param); // cache the object
				if ( in_array($param->attr('name'), array('src', 'movie')) ) {

					// special cases!
					if ( preg_match('/flickr\.com/iu', $param->attr('value')) > 0 ) {
						$isSpecial = 'flickr.com';
						//continue 1;
					}
					$__founds[] = $param->attr('value');
				}
				if ( in_array($param->attr('name'), array('flashvars')) ) {
					if ( preg_match('/photo_id=(\d+)$/iu', $param->attr('value'), $flickrMatch) > 0 )
						$specialVal = $flickrMatch[1];
				}
			}
			if ( $isSpecial!==false && !empty($specialVal) ) {
				if ( $isSpecial == 'flickr.com' )
					$__founds[] = "http://www.flickr.com/__flashvars__/$specialVal/";
			}
		}

		// Just Plain Links!
		$regex_links = '
			\s*
			(http(?:s|v|vh|vp|a)?:\/\/(?:www\.)?[^\s"]+)
			\s*
		';
		$regex_links = '/'.$regex_links.'/ixum';
		preg_match_all( $regex_links, $content, $links, PREG_SET_ORDER );
		if ( !empty($links) ) { foreach ( $links as $match ) {
			if ( empty($match[1]) ) continue 1;
			$__founds[] = $match[1];
		} }
		
		if ( empty($__founds) ) return array(); // validate founds!

		// clean duplicates!
		if ( !empty($__founds) ) {
			$__founds = array_values( array_unique($__founds) );
		}

		// allowed video providers
		$allowedVideoProviders = array();
		if ( is_array(self::$videoIdentifies) && !empty(self::$videoIdentifies) ) {
			foreach ( self::$videoIdentifies as $key => $val ) {

				if ( !in_array($key, (array) $this->video_include) ) continue 1;
				$allowedVideoProviders[ "$key" ] = $val;
			}
		}

		// go through found urls!
		$__images = array();
		foreach ( $__founds as $found ) {

			$found = trim( $found );
			if ( preg_match('/^http/iu', $found) == 0 )
				$found = 'http:' . $found;
				
			$parseUrl = parse_url( $found );
			$host = $parseUrl['host'];
			if ( !isset($host) || empty($host) )
				continue 1;

			if ( is_array($allowedVideoProviders) && !empty($allowedVideoProviders) ) {
				foreach ( $allowedVideoProviders as $key => $val ) {

					$pattern = '/' . $val['default'] . '/ixu';

					//if ( $key != 'xyz' ) continue 1;
					if ( $key == 'xyz' ) {
						//var_dump('<pre>', $pattern , '</pre>'); die('debug...');
					}

					if ( preg_match_all($pattern, $found, $matches, PREG_SET_ORDER)) {

						if ( $key == 'xyz' ) {
							//var_dump('<pre>',$matches ,'</pre>');
						}

						foreach($matches as $match) {

							if ( $key == 'localhost' ) {
								$__images[ "$key" ][] = $found;
								continue 1;
							}
							if ( empty($match[1]) ) continue 1;
							if ( $key == 'blip' && in_array($match[1], array('api')) ) continue 1;
							
							$__images[ "$key" ][] = $match[1];
						}
					}
				} // end foreach allowed providers!
			}
		} // end foreach main!

		// clean duplicates
		if ( !empty($__images) ) {
			foreach ( $__images as $kk => $vv) {
				$__images[ "$kk" ] = array_values( array_unique($__images[ "$kk" ]) );
			}
		}
		//var_dump('<pre>', $__images , '</pre>'); die('debug...'); 
		return $__images;
	}
	
	private function getVideosInfo( $videos = array(), $post = null, $extrainfo = array(), $recheckVideos = false ) {
		if ( empty($videos) || is_null($post) || !isset($post->ID) ) return array();

		$post_id = (int) $post->ID;

		$ret = array();

		require($this->module_folder_path . 'video_info.php');
		$pspVideoInfo = new pspVideoInfo( array(
			'vzaar_domain'			=> $this->settings['vzaar_domain'],
			'viddler_key'			=> $this->settings['viddler_key'],
			'flickr_key'			=> $this->settings['flickr_key']
		));

		$current_metas = array_merge( array(), $this->getVideoMetas( $post_id ) );

		// try to retrieve attachment details (for localhost) based on guid!
		if ( isset($videos['localhost']) && !empty($videos['localhost']) ) {
			foreach ( $videos['localhost'] as $key => $val ) {
				if ( !empty($extrainfo) && isset($extrainfo[ "localhost" ][ "$key" ]) ) ;
				else {
					$extrainfo[ "localhost" ][ "$key" ] = $this->get_video_dbinfo( $val );
				}
			}
		}

		foreach ( $videos as $k => $v ) {

			if ( is_array($v) && !empty($v) ) {
				foreach ( $v as $key => $val ) {

					$videoLocalDetails = array();
					if ( $k == 'localhost' && !empty($extrainfo) && isset($extrainfo[ "$k" ][ "$key" ]) )
						$videoLocalDetails = $extrainfo[ "$k" ][ "$key" ];

					if ( $k != 'localhost' )
						$__vidalias = $val;
					else if ( $k == 'localhost' && isset($videoLocalDetails->ID) )
						$__vidalias = 'post_' . ( (int) $videoLocalDetails->ID );
					if ( empty($__vidalias) )
						$__vidalias = 'rand_' . $this->the_plugin->generateRandomString(10);
					$current_alias = $k . '_' . $this->setVideoAlias( $__vidalias );
					$meta_alias = 'psp_videos_' . $current_alias;

					$vid_meta = isset($current_metas[ "$meta_alias" ]) ? $current_metas[ "$meta_alias" ] : array();

					$__doRequestInfo = false;
					if ( isset($vid_meta['status']) && isset($vid_meta['created']) ) {

						srand();
						$__rand = rand(0, count(self::$metaRandomLifetime)-1);
						$__lifetime = (int) ( self::$metaLifetime + self::$metaRandomLifetime[$__rand] );

						if ( $recheckVideos || $vid_meta['status'] != 'valid'
						|| ( (int) ($vid_meta['created'] + $__lifetime) < time() ) )
							$__doRequestInfo = true;
						else
							$ret[ "$k" ][ "$key" ] = $vid_meta;
					} else
						$__doRequestInfo = true;
					
					if ( $__doRequestInfo ) {
						$ret[ "$k" ][ "$key" ] = $pspVideoInfo->getVideoInfo( $val, $k, array(
							'post'			=> $post,
							'extrainfo'		=> $videoLocalDetails
						));
						$remoteThumb = $this->saveVideoThumbnail( $post_id, $current_alias, $ret[ "$k" ][ "$key" ]['thumbnail'] );
						if ( $remoteThumb['status'] == 'valid' ) // update with remote thumb
							$ret[ "$k" ][ "$key" ]['thumbnail'] = $remoteThumb['resp'];

						update_post_meta( $post_id, $meta_alias, $ret[ "$k" ][ "$key" ] );
						update_post_meta( $post_id, $meta_alias.'_stat', $ret[ "$k" ][ "$key" ]['status'] );
					}
					
					$ret[ "$k" ][ "$key" ] = array_merge( $ret[ "$k" ][ "$key" ], $this->video_info_check( $ret[ "$k" ][ "$key" ] ) );
				}
			}
		}
		return $ret;
	}

	private function getVideoMetas( $post_id ) {
		global $wpdb;
		
		$sql = "
			SELECT a.*
			 FROM " . $wpdb->prefix . "postmeta AS a
			 WHERE 1=1
			 AND a.post_id = '" . $post_id . "' AND a.meta_key regexp 'psp_videos_'
			 ORDER BY a.meta_id ASC
			;
		";

		$res = $wpdb->get_results( $sql );
		
		$ret = array();
		if ( is_array($res) && !empty($res) ) {
			foreach ( $res as $key => $val ) {

				if ( isset($val->meta_value) ) {
					$meta_value = $val->meta_value;
					$meta_value = unserialize( $meta_value );

					if ( isset($meta_value['resp']) )
						unset( $meta_value['resp'] );

					$ret[ "{$val->meta_key}" ] = $meta_value;
				}
			}
		}
		return $ret;
	}
	
	private function setVideoAlias( $str='' ) {
		if ( !empty($str) ) {
			$str = preg_replace('/[^a-zA-Z0-9\-_]/iu', '-', $str);
			$str = substr($str, 0, 50);
		}
		return $str;
	}
	
	private function saveVideoThumbnail( $post_id=0, $alias='default', $remote_thumb='' ) {

		$ret = array('status' => 'invalid', 'resp' => '');
		
		if ( empty($remote_thumb) )
	    	return array_merge( $ret, array(
	    		'resp' => 'Empty remote thumb file!'
	    	));
		
		// retrieve the remote thumb!		
		$getdata = $this->the_plugin->remote_get( $remote_thumb, 'default' );
		if ( !isset($getdata) || $getdata['status'] === 'invalid' ) {
	    	return array_merge( $ret, array(
	    		'resp' => 'Could not retrieve the remote thumb'
	    	));
		}
		$getdata = $getdata['body'];

		// create thumbs directory
		clearstatcache();
		$upload_dir = wp_upload_dir();
		if (! is_dir( $upload_dir['path'] . '' . $this->file_cache_directory ) ) {
			@mkdir( $upload_dir['path'] . '' . $this->file_cache_directory );
			if (! is_dir( $upload_dir['path'] . '' . $this->file_cache_directory ) ) {
				die("Could not create the file cache directory.");
		    	return array_merge( $ret, array(
		    		'resp' => 'Could not create the file cache directory.'
		    	));
			}
		}

		$the_image_data = $getdata;

		// save thumb on local server
		$new_image = sprintf($upload_dir['path'] . '' . $this->file_cache_directory . '/%d-%s.jpg', $post_id, $alias);
		$new_image_url = sprintf($upload_dir['url'] . '' . $this->file_cache_directory . '/%d-%s.jpg', $post_id, $alias);
		file_put_contents( $new_image, $the_image_data );

		if ( $this->the_plugin->verifyFileExists($new_image) )
	    	return array_merge( $ret, array(
	    		'status'	=> 'valid',
	    		'resp' 		=> $new_image_url
	    	));
	    	
    	return array_merge( $ret, array(
    		'resp' 		=> 'Could not save the file in cache directory.'
    	));
	}
	
	private function video_info_check( $video = array() ) {

		if ( isset($this->settings['video_title_prefix']) && !empty($this->settings['video_title_prefix']) ) {
			if ( @preg_match('/(\s|^)'.preg_quote($this->settings['video_title_prefix']).'(\s|$)/iu', $video['title']) == 0 )
				$video['title'] = $this->settings['video_title_prefix'] . ': ' . $video['title'];
		}
		
		if ( !isset($video['thumbnail']) || empty($video['thumbnail']) )
			if ( isset($this->settings['thumb_default']) && !empty($this->settings['thumb_default']) )
				$video['thumbnail'] = $this->settings['thumb_default'];

		if ( isset($video['content_loc']) )
			if ( preg_match('/\/\/[\w]\.cloudfront\.net/iu', $video['content_loc']) > 0
				|| preg_match('/Key\-Pair\-Id=/iu', $video['content_loc']) > 0 )
				$video['content_loc'] = '';

		return (array) $video;
	}
	
	private function get_post_videos( $post=null, $recheckVideos=true ) {

		if ( is_null($post) || !isset($post->ID) ) return array();
		$post_id = (int) $post->ID;

		$ret = array();
		$current_metas = array_merge( array(), $this->getVideoMetas( $post_id ) );
		if ( !empty($current_metas) ) {
			foreach ( $current_metas as $k => $v ) {
				$alias = str_replace('psp_videos_', '', $k);
				$__level_1 = substr($alias, 0, strpos($alias, '_'));
				$__level_2 = str_replace($__level_1.'_', '', $alias);

				if ( !empty($__level_1) && !empty($__level_2) ) {

					//$__itemImg[ "$__level_1" ][] = $__level_2;

					$current_alias = $__level_1 . '_' . $__level_2;
					$meta_alias = 'psp_videos_' . $current_alias;

					$vid_meta = isset($current_metas[ "$meta_alias" ]) ? $current_metas[ "$meta_alias" ] : array();
					if ( !empty($vid_meta) ) {

						$vid_meta = array_merge( $vid_meta, $this->video_info_check( $vid_meta ) );
						$ret[ "$k" ][ "$key" ] = $vid_meta;
					}
				}
			}
		}
		$__videoInfo = $ret;
		
		if ( empty($__videoInfo) || $recheckVideos ) {
			
			$images = $this->get_videos( '', $post_id );
			$images_tmp = $this->filter_videos( $images );
			$images = !empty($images_tmp) && isset($images_tmp['videos']) ? $images_tmp['videos'] : array();
			$extrainfo = !empty($images_tmp) && isset($images_tmp['extrainfo']) ? $images_tmp['extrainfo'] : array();
	
			$__itemImg = array();
			$__extrainfo = array();
	
			if ( isset($images[ $post_id ]) && is_array($images[ $post_id ]) && count($images[ $post_id ])>0 ) {
				$__itemImg = $images[ $post_id ];
				$__extrainfo = $extrainfo[ $post_id ];
			}
	
			$__itemImg2 = $this->filter_item_video( $post->post_content ); //retrieve post images from post content
			$__itemImg = array_merge_recursive( $__itemImg, $__itemImg2 );
	
			// clean duplicates
			if ( !empty($__itemImg) ) {
				foreach ( $__itemImg as $kk => $vv) {
					$__itemImg[ "$kk" ] = array_values( array_unique($__itemImg[ "$kk" ]) );
				}
			}
			
			$__videoInfo = $this->getVideosInfo( $__itemImg, $post, $__extrainfo, $recheckVideos );
		}

		return $__videoInfo;
	}
	
	public function content_add_video_snippets( $content ) {

		global $post;

		// validations!
		if ( is_home() || is_archive() || is_tax() || is_tag() || is_category() || is_feed() )
			return $content;

		if ( !is_object($post) || !isset($post->ID) )
			return $content;

		$videosInfo = $this->get_post_videos( $post, self::VIDEOAPI_FORCE_CONTENT );

		if ( empty($videosInfo) || !is_array($videosInfo) )
			return $content;

		$ret = array();
		$ret[] = PHP_EOL;
		foreach ( $videosInfo as $type => $videos ) {
			foreach ( $videos as $key => $video ) {

				if ( !$this->isVideoValid( $video ) ) continue 1;
						
				$ret[] = '
				<!--begin psp video snippet : ' . ($type) . '-->
				';
				$ret[] = '<div itemprop="video" itemscope itemtype="http://schema.org/VideoObject">';
	
				$ret[] = '<meta itemprop="name" content="' . $video['title'] . '">';
				$ret[] = '<meta itemprop="thumbnailURL" content="' . $video['thumbnail'] . '">';
				$ret[] = '<meta itemprop="description" content="' . $video['description'] . '">';
				$ret[] = '<meta itemprop="uploadDate" content="' . $video['publish_date'] . '">';
				if ( isset($video['player_loc']) && !empty($video['player_loc']) )
					$ret[] = '<meta itemprop="embedURL" content="' . $video['player_loc'] . '">';
				if ( isset($video['content_loc']) && !empty($video['content_loc']) )
					$ret[] = '<meta itemprop="contentURL" content="' . $video['content_loc'] . '">';
	
				if ( isset($video['duration']) && !empty($video['duration']) )
					$ret[] = '<meta itemprop="duration" content="' . $this->duration_iso_8601( $video['duration'] ) . '">';
	
				$ret[] = '</div>';
				$ret[] = '
				<!--end psp video snippet : ' . ($type) . '-->
				';
			}
		}
		$ret[] = PHP_EOL;

		$content .= implode('', $ret);
		return $content;
	}
	
	private function isVideoValid( $video = array() ) {

		// mandatory fields: title, description, thumbnail and ( player loc or content loc )
		$validate = array();
		$validate[0] = (bool) ( !isset($video['title']) || empty($video['title']) );
		$validate[1] = (bool) ( !isset($video['description']) || empty($video['description']) );
		$validate[2] = (bool) ( !isset($video['thumbnail']) || empty($video['thumbnail']) );
		$validate[3] = (bool) ( !isset($video['player_loc']) || empty($video['player_loc']) );
		$validate[4] = (bool) ( !isset($video['content_loc']) || empty($video['content_loc']) );
		if ( $validate[0] || $validate[1] || $validate[2] || ( $validate[3] && $validate[4] ) )
			return false;

		return true;
	}
	
	
	
	/**
	* Change the header to text/xml
	*
	*/
	private function text_xml_header() 
	{
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Pragma: no-cache');
		header('X-Robots-Tag: noindex, follow');
		header('Content-Type: text/xml');
	}

	/**
	* Returns root path of the website
	*
	* @return string
	*/
	private function getDomain() {
		return $this->domain;
	}
	
	/**
	* Sets root path of the website, starting with http:// or https://
	*
	* @param string $domain
	*/
	public function setDomain($domain) {
		$this->domain = $domain;
		return $this;
	}
	
	/**
	 * Returns XMLWriter object instance
	 *
	 * @return XMLWriter
	 */
	private function getWriter() {
		return $this->writer;
	}

	/**
	 * Assigns XMLWriter object instance
	 *
	 * @param XMLWriter $writer 
	 */
	private function setWriter(XMLWriter $writer) {
		$this->writer = $writer;
	}

	/**
	 * Returns path of sitemaps
	 * 
	 * @return string
	 */
	private function getPath() {
		return $this->path;
	}

	/**
	 * Sets paths of sitemaps
	 * 
	 * @param string $path
	 * @return Sitemap
	 */
	public function setPath($path) {
		$this->path = $path;
		return $this;
	}

	/**
	 * Returns filename of sitemap file
	 * 
	 * @return string
	 */
	private function getFilename() {
		return $this->filename;
	}

	/**
	 * Sets filename of sitemap file
	 * 
	 * @param string $filename
	 * @return Sitemap
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
		return $this;
	}

	/**
	 * Returns current item count
	 *
	 * @return int
	 */
	private function getCurrentItem() {
		return $this->current_item;
	}

	/**
	 * Increases item counter
	 * 
	 */
	private function incCurrentItem() {
		$this->current_item = $this->current_item + 1;
	}

	/**
	 * Returns current sitemap file count
	 *
	 * @return int
	 */
	private function getCurrentSitemap() {
		return $this->current_sitemap;
	}

	/**
	 * Increases sitemap file count
	 * 
	 */
	private function incCurrentSitemap() {
		$this->current_sitemap = $this->current_sitemap + 1;
	}

	/**
	 * Prepares sitemap XML document
	 * 
	 */
	private function startSitemap( $type=array() ) 
	{
		$this->setWriter(new XMLWriter());
		$this->getWriter()->openURI('php://output');
		$this->getWriter()->startDocument('1.0', 'UTF-8');
		$this->getWriter()->setIndent(true);
		$this->getWriter()->writeComment( 'Sitemap generated using: ' . ( $this->the_plugin->details['plugin_name'] ) );
		$this->getWriter()->writeComment( 'Generated-on=' . ( date("F j, Y, g:i a") ) );

		$this->getWriter()->startElement('urlset');
		$this->getWriter()->writeAttribute('xmlns', self::SCHEMA);
		if ( !empty($type) && in_array('images', $type) )
			$this->getWriter()->writeAttribute('xmlns:image', self::SCHEMA_IMG);
		if ( !empty($type) && in_array('videos', $type) )
			$this->getWriter()->writeAttribute('xmlns:video', self::SCHEMA_VIDEO);
	}

	/**
	 * Prepares given date for sitemap
	 *
	 * @param string $date Unix timestamp or any English textual datetime description
	 * @return string Year-Month-Day formatted date.
	 */
	private function getLastModifiedDate($date) {
		if (ctype_digit($date)) {
			return date('Y-m-d', $date);
		} else {
			$date = strtotime($date);
			return date('Y-m-d', $date);
		}
	}
	
	/**
	 * Finalizes tags of sitemap XML document.
	 *
	 */
	private function endSitemap() {
		$this->getWriter()->endElement();
		$this->getWriter()->endDocument();
	}
	
	/**
	 * write cdata Element
	 *
	 */
	private function cdataElement( $key='', $val='', $forceEmpty=true ) {
		if ( !$forceEmpty ) return false;

		$val = '<![CDATA[' . $val . ']]>';
		$this->getWriter()->writeElement( $key, $val );
	}
	
	
	/**
	 * sitemap website Items: posts | pages
	 * 
	 */
	
	//print xml sitemap!
	private function print_sitemap( $post_type='post,page' )
	{
		$siteurl = get_option('siteurl');
		$site_parts = parse_url($siteurl);  
		//$this->setDomain( $site_parts['scheme'] . '://' . $site_parts['host'] );
		$this->setDomain( $siteurl );
		$this->setPath( '/' );
		$this->setFilename( 'sitemap_index' );
		
		$general_sitemap_settings = $this->the_plugin->get_theoption('psp_sitemap');
		$post_type = implode(',', $general_sitemap_settings['post_types']);

		if ( $general_sitemap_settings['include_img']=='yes' ) {
			$images = $this->get_images( $post_type );
			$images = $this->filter_images( $images );
		}
		$items = $this->get_items2( $post_type );
		if( count($items) > 0 ) {

			$this->text_xml_header();
			$this->addItem( home_url(), '1.0', 'daily', 'Today' );
  
			foreach ($items as $key => $value) {

				$post_type = $value->post_type;
				$permalink = get_permalink( $value->ID );
				$sitemap_settings = get_post_meta( $value->ID, 'psp_sitemap', true );
				$sitemap_isincluded = get_post_meta( $value->ID, 'psp_sitemap_isincluded', true );

				//verify per item is included!
				if ( isset($sitemap_isincluded) && trim($sitemap_isincluded) == "never_include" ) continue 1;

				$__itemImg = array();
				if ( $general_sitemap_settings['include_img']=='yes' ) {
					if ( isset($images[ $value->ID ]) && is_array($images[ $value->ID ]) && count($images[ $value->ID ])>0 )
						$__itemImg = $images[ $value->ID ];
	
					$__itemImg2 = $this->filter_item_image( $value ); //retrieve post images from post content
					$__itemImg = array_merge( $__itemImg, $__itemImg2 );
					$__itemImg = array_values( array_unique($__itemImg) );
				}

				$priority = self::DEFAULT_PRIORITY;
				if ( isset($sitemap_settings['priority']) &&  trim($sitemap_settings['priority']) != "" ){
					$priority = $sitemap_settings['priority'];
				} elseif ( isset($general_sitemap_settings['priority'][$post_type]) && trim($general_sitemap_settings['priority'][$post_type]) != "") {
					$priority = $general_sitemap_settings['priority'][$post_type];
				}
				
				$changefreq = self::DEFAULT_FREQUENCY;
				if( isset($sitemap_settings['changefreq']) &&  trim($sitemap_settings['changefreq']) != "" ){
					$changefreq = $sitemap_settings['changefreq'];
				} elseif ( isset($general_sitemap_settings['changefreq'][$post_type]) && trim($general_sitemap_settings['changefreq'][$post_type]) != "" && trim($general_sitemap_settings['changefreq'][$post_type]) != "-") {
					$changefreq = $general_sitemap_settings['changefreq'][$post_type];
				}
				
				$this->addItem( $permalink, $priority, $changefreq, $value->post_modified, $__itemImg );
			}

			$this->endSitemap();
		}
		die;
	}
	
	/**
	 * Adds an item to sitemap
	 *
	 * @param string $loc URL of the page. This value must be less than 2,048 characters. 
	 * @param string $priority The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.
	 * @param string $changefreq How frequently the page is likely to change. Valid values are always, hourly, daily, weekly, monthly, yearly and never.
	 * @param string|int $lastmod The date of last modification of url. Unix timestamp or any English textual datetime description.
	 * @return Sitemap
	 */
	public function addItem($loc, $priority = self::DEFAULT_PRIORITY, $changefreq = self::DEFAULT_FREQUENCY, $lastmod = NULL, $images=array()) {
		if (($this->getCurrentItem() % self::ITEM_PER_SITEMAP) == 0) {
			if ($this->getWriter() instanceof XMLWriter) {
				$this->endSitemap();
			}
			$this->startSitemap( array('images') );
			$this->incCurrentSitemap();
		}
		$this->incCurrentItem();
		$this->getWriter()->startElement('url');
		//$this->getWriter()->writeElement('loc', $this->getDomain() . $loc);
		$this->getWriter()->writeElement('loc', $loc);

		if (isset($images) && is_array($images) && count($images)>0)
			$this->addItemImages($images);

		$this->getWriter()->writeElement('priority', $priority);
		if ($changefreq)
			$this->getWriter()->writeElement('changefreq', $changefreq);
		if ($lastmod)
			$this->getWriter()->writeElement('lastmod', $this->getLastModifiedDate($lastmod));

		$this->getWriter()->endElement();
		return $this;
	}
	

	/**
	 * sitemap Images
	 *
	 */
	
	//print xml sitemap!
	private function print_sitemap_images( $post_type='post,page' )
	{
		$siteurl = get_option('siteurl');
		$site_parts = parse_url($siteurl);-  
		//$this->setDomain( $site_parts['scheme'] . '://' . $site_parts['host'] );
		$this->setDomain( $siteurl );
		$this->setPath( '/' );
		$this->setFilename( 'sitemap_index' );

		$general_sitemap_settings = $this->the_plugin->get_theoption('psp_sitemap');
		$post_type = implode(',', $general_sitemap_settings['post_types']);

		//if ( $general_sitemap_settings['include_img']=='yes' ) {
			$images = $this->get_images( $post_type );
			$images = $this->filter_images( $images );
		//}
		$items = $this->get_items2( $post_type, array('images' => $images) );

		if( count($items) > 0 ) {

			$this->text_xml_header();
			$this->addItem_images( home_url(), '1.0', 'daily', 'Today' );

			foreach ($items as $key => $value) {

				$post_type = $value->post_type;
				$permalink = get_permalink( $value->ID );
				$sitemap_settings = get_post_meta( $value->ID, 'psp_sitemap', true );
				$sitemap_isincluded = get_post_meta( $value->ID, 'psp_sitemap_isincluded', true );

				//verify per item is included!
				if ( isset($sitemap_isincluded) && trim($sitemap_isincluded) == "never_include" ) continue 1;

				$__itemImg = array();
				//if ( $general_sitemap_settings['include_img']=='yes' ) {
					if ( isset($images[ $value->ID ]) && is_array($images[ $value->ID ]) && count($images[ $value->ID ])>0 )
						$__itemImg = $images[ $value->ID ];
	
					$__itemImg2 = $this->filter_item_image( $value ); //retrieve post images from post content
					$__itemImg = array_merge( $__itemImg, $__itemImg2 );
					$__itemImg = array_values( array_unique($__itemImg) );
				//}

				if ( !empty($__itemImg) )
					$this->addItem_images( $permalink, '', '', $value->post_modified, $__itemImg );
			}

			$this->endSitemap();
		}
		die;
	}
	
	// Adds an item to sitemap
	public function addItem_images($loc, $priority = NULL, $changefreq = NULL, $lastmod = NULL, $images=array()) {
		if (($this->getCurrentItem() % self::ITEM_PER_SITEMAP) == 0) {
			if ($this->getWriter() instanceof XMLWriter) {
				$this->endSitemap();
			}
			$this->startSitemap( array('images') );
			$this->incCurrentSitemap();
		}
		$this->incCurrentItem();
		$this->getWriter()->startElement('url');
		//$this->getWriter()->writeElement('loc', $this->getDomain() . $loc);
		$this->getWriter()->writeElement('loc', $loc);

		if (isset($images) && is_array($images) && count($images)>0)
			$this->addItemImages($images);

		$this->getWriter()->endElement();
		return $this;
	}
	
	/**
	 * Adds an item images to sitemap
	 *
	 * @param string $images array of item images!
	 * @return Sitemap images
	 */
	private function addItemImages($images) {
		foreach ($images as $v) {
			$this->getWriter()->startElement('image:image');
			$this->getWriter()->writeElement('image:loc', $v);
			$this->getWriter()->endElement();
		}
		return $this;
	}
	
	
	/**
	 * sitemap Videos
	 *
	 */
	
	//print xml sitemap!
	private function print_sitemap_videos( $post_type='post,page' )
	{
		$siteurl = get_option('siteurl');
		$site_parts = parse_url($siteurl);-  
		//$this->setDomain( $site_parts['scheme'] . '://' . $site_parts['host'] );
		$this->setDomain( $siteurl );
		$this->setPath( '/' );
		$this->setFilename( 'sitemap_index' );

		$general_sitemap_settings = $this->the_plugin->get_theoption('psp_sitemap');
		$post_type = implode(',', $general_sitemap_settings['post_types']);

		//if ( $general_sitemap_settings['include_video']=='yes' ) {
			$images = $this->get_videos( $post_type );
			$images_tmp = $this->filter_videos( $images );
			$images = !empty($images_tmp) && isset($images_tmp['videos']) ? $images_tmp['videos'] : array();
			$extrainfo = !empty($images_tmp) && isset($images_tmp['extrainfo']) ? $images_tmp['extrainfo'] : array();
		//}
		$items = $this->get_items2( $post_type, array('videos' => $images) );

		if( count($items) > 0 ) {
			
			$this->text_xml_header();
			$this->addItem_videos( home_url(), '1.0', 'daily', 'Today' );

			foreach ($items as $key => $value) {
				
				//if ( $value->ID != 'xyz' ) {
					//continue 1;
				//}
				
				$post_type = $value->post_type;
				$permalink = get_permalink( $value->ID );
				$sitemap_settings = get_post_meta( $value->ID, 'psp_sitemap', true );
				$sitemap_isincluded = get_post_meta( $value->ID, 'psp_sitemap_isincluded', true );

				//verify per item is included!
				if ( isset($sitemap_isincluded) && trim($sitemap_isincluded) == "never_include" ) continue 1;

				$__itemImg = array();
				$__extrainfo = array();
				//if ( $general_sitemap_settings['include_video']=='yes' ) {
					if ( isset($images[ $value->ID ]) && is_array($images[ $value->ID ]) && count($images[ $value->ID ])>0 ) {
						$__itemImg = $images[ $value->ID ];
						$__extrainfo = $extrainfo[ $value->ID ];
					}
	
					$__itemImg2 = $this->filter_item_video( $value->post_content ); //retrieve post images from post content
					$__itemImg = array_merge_recursive( $__itemImg, $__itemImg2 );

					// clean duplicates
					if ( !empty($__itemImg) ) {
						foreach ( $__itemImg as $kk => $vv) {
							$__itemImg[ "$kk" ] = array_values( array_unique($__itemImg[ "$kk" ]) );
						}
					}
				//}
				$__videoInfo = $this->getVideosInfo( $__itemImg, $value, $__extrainfo, self::VIDEOAPI_FORCE_SITEMAP );

				if ( !empty($__itemImg) )
					$this->addItem_videos( $permalink, '', '', $value->post_modified, $__itemImg, $__videoInfo );
			}

			$this->endSitemap();
		}
		die;
	}
	
	// Adds an item to sitemap
	public function addItem_videos($loc, $priority = NULL, $changefreq = NULL, $lastmod = NULL, $videos=array(), $videosInfo=array()) {
		if (($this->getCurrentItem() % self::ITEM_PER_SITEMAP) == 0) {
			if ($this->getWriter() instanceof XMLWriter) {
				$this->endSitemap();
			}
			$this->startSitemap( array('videos') );
			$this->incCurrentSitemap();
		}
		$this->incCurrentItem();
		$this->getWriter()->startElement('url');
		//$this->getWriter()->writeElement('loc', $this->getDomain() . $loc);
		$this->getWriter()->writeElement('loc', $loc);

		if (isset($videos) && is_array($videos) && count($videos)>0)
			$this->addItemVideos($videos, $videosInfo);

		$this->getWriter()->endElement();
		return $this;
	}
	
	/**
	 * Adds an item videos to sitemap
	 *
	 * @param string $videos array of item videos!
	 * @return Sitemap videos
	 */
	private function addItemVideos($videos, $videosInfo) {
		foreach ( $videos as $k => $v ) {

			if ( is_array($v) && !empty($v) ) {
				foreach ( $v as $key => $val ) {
					
					$val = $videosInfo[ "$k" ][ "$key" ];
					
					if ( !isset($val['status']) || (isset($val['status']) && $val['status']=='invalid') )
						continue 1;
					if ( !$this->isVideoValid( $val ) )
						continue 1;
					
					$this->getWriter()->startElement('video:video');

					if ( empty($val['player_loc']) )
						$val['player_loc'] = $val['content_loc'];
					if ( !empty($val['player_loc']) ) {
						// You must specify at least one of <video:player_loc> or <video:content_loc> .A URL pointing to a player for a specific video. Usually this is the information in the src element of an <embed> tag and should not be the same as the content of the <loc> tag. The optional attribute allow_embed specifies whether Google can embed the video in search results. Allowed values are Yes or No. The optional attribute autoplay has a user-defined string (in the example above, ap=1) that Google may append (if appropriate) to the flashvars parameter to enable autoplay of the video. For example: <embed src="http://www.example.com/videoplayer.swf?video=123" autoplay="ap=1"/>. Example: Dailymotion: http://www.dailymotion.com/swf/x1o2g
						$this->getWriter()->startElement('video:player_loc');
						$this->getWriter()->writeAttribute('allow_embed', 'yes');
						$this->getWriter()->writeAttribute('autoplay', 'ap=1');
						$this->getWriter()->writeRaw( (string) $val['player_loc'] );
						$this->getWriter()->endElement();
					}
					if ( !empty($val['author']) ) // The video uploader's name. Only one <video:uploader> is allowed per video. The optional attribute info specifies the URL of a webpage with additional information about this uploader. This URL must be on the same domain as the <loc> tag.
						$this->getWriter()->writeElement('video:uploader', (string) $val['author']);
					if ( !empty($val['publish_date']) ) // The date the video was first published, in W3C format. Acceptable values are complete date (YYYY-MM-DD) and complete date plus hours, minutes and seconds, and timezone (YYYY-MM-DDThh:mm:ss+TZD). For example, 2007-07-16T19:20:30+08:00.
						$this->getWriter()->writeElement('video:publication_date', (string) $val['publish_date']);

					if ( !empty($val['thumbnail']) ) // mandatory: A URL pointing to the video thumbnail image file. Images must be at least 160 x 90 pixels and at most 1920x1080 pixels. We recommend images in .jpg, .png, or. gif formats.
						$this->getWriter()->writeElement('video:thumbnail_loc', (string) $val['thumbnail']);
					if ( !empty($val['title']) ) // mandatory: The title of the video. Maximum 100 characters. The title must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
						$this->cdataElement('video:title', (string) $val['title']);
					if ( !empty($val['description']) ) // mandatory: The description of the video. Maximum 2048 characters. The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
						$this->cdataElement( 'video:description', (string) $val['description'] );
					if ( !empty($val['duration']) ) // The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
						$this->getWriter()->writeElement('video:duration', (string) $val['duration']);
					if ( !empty($val['ratings']) ) // The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
						$this->getWriter()->writeElement('video:rating', (string) $val['ratings']);
					if ( !empty($val['view_count']) ) // The number of times the video has been viewed.
						$this->getWriter()->writeElement('video:view_count', (string) $val['view_count']);

       				if ( is_array($val['tags']) && !empty($val['tags']) ) {
       					// A tag associated with the video. Tags are generally very short descriptions of key concepts associated with a video or piece of content. A single video could have several tags, although it might belong to only one category. For example, a video about grilling food may belong in the Grilling category, but could be tagged "steak", "meat", "summer", and "outdoor". Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
       					foreach ( $val['tags'] as $tag )
       						$this->cdataElement('video:tag', (string) $tag);
       				}
       				if ( is_array($val['categories']) && !empty($val['categories']) ) {
       					// The video's category. For example, cooking. The value should be a string no longer than 256 characters. In general, categories are broad groupings of content by subject. Usually a video will belong to a single category. For example, a site about cooking could have categories for Broiling, Baking, and Grilling.
       					foreach ( $val['categories'] as $category )
       						$this->cdataElement('video:category', (string) $category);
       				}

					$this->getWriter()->endElement();
				}
			}
		}
		return $this;
	}
	
	
	/**
	 * Video Opengraph
	 * 
	 */
	public function video_opengraph_first_found() {
		global $post;

		// validations!
		if ( is_home() || is_archive() || is_tax() || is_tag() || is_category() || is_feed() )
			return array();

		if ( !is_object($post) || !isset($post->ID) )
			return array();

		$videosInfo = $this->get_post_videos( $post, false );

		if ( empty($videosInfo) || !is_array($videosInfo) )
			return array();

		$ret = array();
		foreach ( $videosInfo as $type => $videos ) {
			foreach ( $videos as $key => $video ) {

				if ( !$this->isVideoValid( $video ) ) continue 1;
				if ( !isset($video['player_loc']) || empty($video['player_loc']) ) continue 1;
				
				return $video;
			}
		}
		return array();
	}
	public function video_opengraph() {
		$video = $this->video_opengraph_first_found();
		if ( !isset($video) || empty($video) ) return false;

		$ret = array();
		$ret[] = '<meta property="og:video" content="' . $video['player_loc'] . '" />';
		$ret[] = '<meta name="medium" content="video" />';
		$ret[] = '<meta name="video_type" content="application/x-shockwave-flash" />';
		$ret[] = '<link rel="image_src" href="' . $video['thumbnail'] . '" />';
		$ret[] = '<link rel="video_src" href="' . $video['player_loc'] . '" />';
		echo implode(PHP_EOL, $ret) . PHP_EOL;
	}
	public function video_opengraph_type( $val = '' ) {
		$video = $this->video_opengraph_first_found();
		if ( isset($video) && !empty($video) )
			return 'video';
		return $val;
	}
	public function video_opengraph_title( $val = '' ) {
		$video = $this->video_opengraph_first_found();
		if ( isset($video) && !empty($video) )
			if ( isset($video['title']) && !empty($video['title']) )
				return $video['title'];
		return $val;
	}
	public function video_opengraph_description( $val = '' ) {
		$video = $this->video_opengraph_first_found();
		if ( isset($video) && !empty($video) )
			if ( isset($video['description']) && !empty($video['description']) )
				return $video['description'];
		return $val;
	}
	public function video_opengraph_image( $val = '' ) {
		$video = $this->video_opengraph_first_found();
		if ( isset($video) && !empty($video) )
			if ( isset($video['thumbnail']) && !empty($video['thumbnail']) )
				return $video['thumbnail'];
		return $val;
	}

	
	/**
	 * Utils
	 *
	 */
	
	// ISO 8601 compatible duration! length <= 24 hours
	private function duration_iso_8601( $duration ) {

		$ret = array();
		$ret[] = 'PT';
		if ( $duration > 3600 ) { // hours
			$hours = floor( $duration / 3600 );
			$ret[] = $hours . 'H';
			$duration = $duration - ( $hours * 3600 );
		}
		if ( $duration > 60 ) { // minutes
			$minutes = floor( $duration / 60 );
			$ret[] = $minutes . 'M';
			$duration = $duration - ( $minutes * 60 );
		}
		if ( $duration > 0 ) { // seconds
			$ret[] = $duration . 'S';
		}
		return implode('', $ret);
	}
	
	private function strip_shortcode( $text ) {
		return preg_replace( '`\[[^\]]+\]`s', '', $text );
	}
	    
	private function prepareForInList($v) {
		return "'".$v."'";
	}
}
pspSeoSitemap::getInstance();