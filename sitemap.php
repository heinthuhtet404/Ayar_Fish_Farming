<?php require __DIR__.'/includes/lib.php';header('Content-Type: application/xml; charset=utf-8');
$b=(isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['SCRIPT_NAME']),'/').'/';
$u=['index.php','fish-species.php','fish-gallery.php','about.php','contact.php'];foreach($CATS as $c)foreach($c['items'] as $i)$u[]=$i[1];
echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';foreach(array_unique($u) as $x)echo '<url><loc>'.h($b.$x).'</loc></url>';echo '</urlset>';
