
<h2 style="margin-top:2em;">ex machina</h2>
<table>
<?
$file = fopen("http://www.google.com/reader/public/atom/user/10020190705343921498/state/com.google/broadcast", "r");
while($line = fgets($file)){
	$string .= $line;
}
$xml = simplexml_load_string($string);
foreach ($xml->entry as $entry){
	?>
	<tr>
		<td style="text-align:right; width:237px;  overflow:hidden;">
			<? print substr(strtolower($entry->source->title), 0,25);
				if(strlen($entry->source->title)>25){print " …";}
			?>
		</td>
		<td style="padding-left:10px; width:482px;">
			<a href="<?=$entry->link["href"]?>"><?print substr(strtolower($entry->title),0,58); if(strlen($entry->title)>58){print " …";}?></a>
		</td>
	</tr><?
}

?>
</table>
