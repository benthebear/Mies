  <div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?><?print " ".$node->type?><?php if ($page) {print " full";}else{print "teaser";};?>">
    <?php if ($picture) {
      print $picture;
    }?>
    <?php if ($page == 0) { ?><h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2><?php }; ?>
    <?php if($node->teaserimage!=""){?><img class="teaserimage" src="<?=$node->teaserimage?>" alt="<?=$title?>"><?php }?>
    
    
    <div class="content">
  
    <?php if(!$page){?><a href="<?php print $node_url?>"><?php print trim(strip_tags($content, "<img>"))?></a><?}else{print $content;}?>
    
    </div>
    <?php if ($links) { ?><div class="links"><?php print $links?></div><?php }; ?>
    
  </div>
