<?php

if(is_file("themes/mies/node.".$node->type.".tpl.php")){
	include("node.".$node->type.".tpl.php");
}else{
	include("node.default.tpl.php");
}
