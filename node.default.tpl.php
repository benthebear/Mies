<?php 
	// It's a node
	$classes[] = "node";
	// It's a node of some Nodetype
	$classes[] = $node->type;
	//Maybe it's sticky
	if ($sticky) {
		$classes[] = "sticky" ; 
	} 
	// Maybe it's unpublished	
	if (!$status) {
		$classes[] = " node-unpublished"; 
	}
	// Maybe it's a full view or a teaser
	if ($page){
		$classes[] = " full";}
	else{
		$classes[] = " teaser";
	}
	// Get the age of the article counted in years
	$datediff = date("Ymd")-date("Ymd", $node->created);
	$age = substr($datediff, 0, strlen($datediff)-4);
	if($age==""){
		$age = 0;
	}
	$classes[] = "age-".$age;
	
	$classstring = implode(" ", $classes);

?>	<div class="<?=$classstring?>">
    <?php if ($picture) {
      print $picture;
    }?>
    <?php if ($page == 0) { ?><h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2><?php }; ?>
    
    
    <div class="content">
   		 <?=$content?>
   		 <?if(isset($node->links["node_read_more"])){
   		 	print "<p class='readmore'>".l(t("Read more")." …", $node->links["node_read_more"]["href"], array(), NULL, NULL, TRUE)."</p>";
   		 	
   		 	//print();
   		 }?>
    </div>
    <!-- <pre><? // print_r($node); ?></pre> -->
    <?php if ($links) { ?><div class="links"><?php print $links?></div><?php }; ?>
   </div>
