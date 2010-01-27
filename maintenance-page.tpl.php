<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
</head>

<body>

<div id="arena" class="grid-widthfull arg0-<?=arg(0)?> arg1-<?=arg(1)?> arg2-<?=arg(2)?> arg01-<?=arg(0)?>-<?=arg(1)?>">
	<div id="arena-inner">
		<div id="page">
		
<div id="header">  
      <?php if ($logo) { ?><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
      <?php if ($site_name) { ?><h1 class='site-name'><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
      <?php if ($site_slogan) { ?><div class='site-slogan'><?php print $site_slogan ?></div><?php } ?>    
      <?php if (isset($secondary_links)) { ?><?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')) ?><?php } ?>
      <?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' => 'links', 'id' => 'navlist')) ?><?php } ?>
      <?php print $search_box ?>   
  		<?php print $header ?>
</div>

<div id="main" >
  
		
    <?php if ($left) { ?>
    <div class="sidebar sidebar-left">
      <?php print $left ?>
    </div><?php } ?>
    
    <?php if ($right) { ?>
    <div id="navibar" class="sidebar sidebar-right">	
    	<?php print $right ?>    	
    </div>
    <?php } ?>  
    
    
    <div id="thecenter">
      <?php if ($mission) { ?><div id="mission"><?php print $mission ?></div><?php } ?>
      <div >
        <?php //print $breadcrumb ?>
        <h2 class="title"><?php print $title ?></h2>       
       	<img src="http://anmutunddemut.de/themes/mies/anmut-und-demut-ist-offline.jpg" />
      </div>
    </div>
      
</div>

<div id="footer">
  <?php print $footer_message ?>
  <?php print $footer ?>
</div>

<?php print $closure ?>
		
			
			<!-- Blogcensus 

			1 : [b16388be789bd866]
			2 : [f5ce2ab595ed90a1]
			3 : [5166bc41f643bae6]
			4 : [a90ce1629c221d38]
			
			-->
		</div>
	</div>
</div>
</body>
</html>
