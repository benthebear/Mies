<?php



/*
* Initialize theme settings
*/
if (is_null(theme_get_setting('mies_unit'))) {  // <-- change this line
  global $theme_key;
  // Save default theme settings
  $defaults = array(
    'mies_collumns_number' => 8,
    'mies_collumn_width' => 112,
    'mies_interspace_width' => 10,
    'mies_unit' => "px"
  );
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, theme_get_settings($theme_key))
  );
  // Force refresh of Drupal internals
  theme_get_setting('', TRUE);
}

drupal_set_html_head('  '.mies_display_grid_css());

//drupal_set_html_head('  '.mies_display_grid());
//drupal_add_css(drupal_get_path('theme', 'mies')."/yaml/core.css", 'theme');

//drupal_rebuild_theme_registry();

function mies_theme(){
	return array(
    // The hook or form id in this case.
    'links' => array(
      // Default arguments.
      'arguments' => array('links' => NULL, 'attributes' => array('class' => 'links')),
    ),
    'comment_block' => array(
      // Default arguments.
      'arguments' => ''
    ),
    'comment_wrapper' => array(
      // Default arguments.
      'arguments' => array('content' => NULL, 'node' => NULL),
    ),
  
    'recent_bookmarks_block' => array(
      // Default arguments.
      'arguments' => array('items' => array()),
    ),
  );
	
}


function mies_links($links, $attributes = array('class' => 'links')){
	global $teaser;
	//dprint_r($links);
	
	// Unset the "node read more" link.
	if(isset($links["node_read_more"])){
		$readmore = $links["node_read_more"];
		unset($links["node_read_more"]);
		//array_push($links,$readmore);
		
	}
	// Redirect the "comment add" to the Node-Page
	if(isset($links["comment_add"])){
		$links["comment_add"]["href"] = ereg_replace("comment/reply", "node", $links["comment_add"]["href"]);
	}
	
	return theme_links($links, $attributes);
	
}


/**
 * Allow themable wrapping of all comments.
 */
function mies_comment_wrapper($content, $node) {
  if (!$content || $node->type == 'forum') {
    return '<div id="comments">'. $content .'</div>';
  }
  else {
    return '<div id="comments"><h2 class="comments">'. t('Comments') .'</h2>'. $content .'</div>';
  }
}

/**
 * Returns a formatted list of recent comments to be displayed in the comment block.
 *
 * @return
 *   The comment list HTML.
 * @ingroup themeable
 */
function mies_comment_block() {
  $items = array();
  $output = "<table>";
  foreach (comment_get_recent(15) as $comment) {
  	//print_r($comment);
  	$fullComment = _comment_load($comment->cid);
  	//print_r($fullComment);
  	if($fullComment->uid!="0"){
  		$user = user_load($fullComment->uid);
  		$username = $user->name;
  	}else{
  		$username = $fullComment->name;
  	}
  	$output .= "<tr>";
  	$output .= "<td class='first-row'>";
  	$output .= $username;
  	$output .= "</td>";
  	$output .= "<td class='second-row'>";
    $output .= l($comment->subject, 'node/'. $comment->nid, array('fragment' => 'comment-'. $comment->cid));
    $output .= "</td>";
    $output .= "<td class='third-row'>";
    //$output .= format_date($comment->timestamp, "large");
  	$output .= "</td>";    
    $output .= "</tr>";
  }
  $output .= "</table>";
  return $output;
}


function mies_recent_bookmarks_block($items){
	
	$output = "";
	
	$output .= "<table>";
	foreach ($items as $item){
		$output .= "<tr>";
  	$output .= "<td class='first-row'>";
  	$output .= feedimporter_get_domain($item["url"]);
  	$output .= "</td>";
  	$output .= "<td class='second-row'>";
    $output .= l($item["title"], "node/".$item["nid"], array("absolute" => true));
    $output .= "</td>";
    $output .= "<td class='third-row'>";
    $output .= ""; //format_date($comment->timestamp, "large");
  	$output .= "</td>";    
    $output .= "</tr>";
	}
	$output .= "</table>";
	return $output;
	
}

function mies_create_new_grid(){
	//At first get the Settings
	$cols = theme_get_setting("mies_collumns_number");
	$width = theme_get_setting("mies_collumn_width");
	$inter = theme_get_setting("mies_interspace_width");
	$unit = theme_get_setting("mies_unit");
	
	// Creat a new Object with the setting
	$grid = new gridlayout($cols, $width, $inter, $unit);
	$grid->createGrid();
	return $grid;
}

function mies_display_grid(){
	$grid = mies_create_new_grid();
	$output   = "<style type='text/css'>\n";	
	$output  .=	"#arena {
			background-image:url(grid.jpg);
			background-repeat:repeat-y;			
			border:1px solid black;			
		}";
	$output .="</style>";
	return $output;
}

function mies_display_grid_css(){
	$grid = mies_create_new_grid();	
	$output  = "<style type='text/css'>\n";	
	// $output .= "#arena {background:url(http://anmutunddemut.de/grid.jpg)}";
	$output .= $grid->generateCSS();
	$output .="</style>";
	
	return $output;
}

class gridlayout{
	
	protected $db;
	
	protected $numberOfCollums;
	protected $widthOfCollumn;
	protected $lineheight;
	protected $widthOfInterspace;
	protected $totalwidth;
	protected $unittype;
	protected $pxPerEm;
	
	public function getTotalWidth(){
		return $this->totalwidth;
	}
	
	public function getWidthOfInterspace(){
		return $this->widthOfInterspace;
	}
	
	public function __construct($cols="", $width="", $inter="", $unit=""){	
		$this->setDefaultValues($cols, $width, $inter, $unit);	
		$this->totalwidth = ($this->numberOfCollums*$this->widthOfCollumn)+(($this->numberOfCollums+1)*$this->widthOfInterspace);		
		$this->createGrid();
	}
	
	protected function setDefaultValues($cols="", $width="", $inter="", $unit=""){
		if($cols!=""){$this->numberOfCollums = $cols;}else{$this->numberOfCollums = 8;}
		if($width!=""){$this->widthOfCollumn = $width;}else{$this->widthOfCollumn = 100;}
		if($inter!=""){$this->widthOfInterspace = $inter;}else{$this->widthOfInterspace = 20;}
		if($unit!=""){$this->unittype = $unit;}else{$this->unittype = "px";}
	}
	
	
	public function createGrid(){
		$im = imagecreatetruecolor($this->totalwidth, 10);
		$white   = ImageColorAllocate ($im, 255, 255, 255);
		$lightgrey = ImageColorAllocate ($im, 211, 211, 211);
		imagefill($im,0,0, $white);
		$counter = 1;
		
		while($counter <= $this->numberOfCollums){
			$x = $x + $this->widthOfInterspace;
			imageline ($im, $x, 0, $x, 9, $lightgrey);
			$x = $x + $this->widthOfCollumn;
			imageline ($im, $x, 0, $x, 9, $lightgrey);
			$counter ++;
		}
		imagejpeg($im, "grid.jpg");
	}
	
	
	public function generateCSS(){
		$widthes = $this->generateWidthes();
		$distances = $this->generateDistances();
		$output = "\n";
		// CSS for Widthes
		$counter = 0;
		foreach ($widthes as $width){
			$counter++;
			$output .= ".grid-width$counter {width:".$width.$this->unittype.";}\n";
		}
		// FullWidth is added
		$output .= ".grid-widthfull {width:".$this->totalwidth.$this->unittype.";}\n";
		
		// CSS for Distances
		$counter = 0;
		foreach ($distances as $distance) {
			$counter++;
			$output .= ".grid-distance$counter {margin-left:".$distance.$this->unittype."}\n";
		}
		
		$output .= "\n";
		return $output;
		
	}
	
	protected function generateWidthes(){
		$counter = 1;
		$width = $this->widthOfCollumn;
		$widthes[] = $width;
		while($counter<=$this->numberOfCollums){			
			$width = $width + $this->widthOfCollumn+$this->widthOfInterspace;
			$widthes[] = $width;
			$counter ++;
		}
		return $widthes;
	}
	
	protected function generateDistances(){
		$counter = 1;
		$distance = $this->widthOfInterspace;
		$distances[] = $distance;
		while($counter<=$this->numberOfCollums){			
			$distance = $distance + $this->widthOfCollumn+$this->widthOfInterspace;
			$distances[] = $distance;
			$counter ++;
		}
		return $distances;
	}
	
	
}