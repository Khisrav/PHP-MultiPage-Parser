<?php
	require 'simplehtmldom.php';

	$url = 'PAGE_TO_PARSE';
	$abs_url = 'https://domain.com';
	$path = 'http://saving_path/';
	$i=1;
	$html = file_get_html($url);
	foreach ($html->find('a') as $link) {
		$foo = parse_url($link->href);
		if ($foo['host']==''){
			$page_url = $abs_url.$foo['path'];
		} else {
			$page_url = $link->href;
		}
		$page = file_get_html($page_url);
		$l = $foo['host'].$foo['path'];
		echo $i.'. '.$l;

		if (!file_exists($l)){
			mkdir($l, 0777, true);
			echo ' - New Folder';
		}

		$file = fopen($l.'index.html', 'w');
		fwrite($file, $page);
		fclose($file);
		echo '<br>';
	}
?>
