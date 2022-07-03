<?php
include("src/Embed_URL_Builder.php");

$video_url = isset($_GET["url"]) && !empty($_GET["url"]) ? $_GET["url"] : "https://streamable.com/d9jkh9";
$site_title = isset($_GET["site_title"]) && !empty($_GET["site_title"]) ? $_GET["site_title"] : "TRC4.COM";

$url = new \Sxt_Box\Embed_URL_Builder($video_url, $site_title);

$youtube = $url->youtube;
$youtube = str_replace("url=", "", $youtube);
//echo $youtube;
//echo $url->youtube;

$vimeo = $url->vimeo;
$vimeo = str_replace("url=", "", $vimeo);
//echo $vimeo;
//echo $url->vimeo;

$vudeo = $url->vudeo;
$vudeo = str_replace("url=", "", $vudeo);
//echo $vudeo;
//echo $url->vudeo;

$streamable = $url->Streamable;
$streamable = str_replace("url=", "", $streamable);
//echo $streamable;
//echo $url->Streamable;

$embed_player = $url->MP4Player;
$embed_player = str_replace("url=", "", $embed_player);

$Dailymotion = $url->Dailymotion;
$Dailymotion = str_replace("url=", "", $Dailymotion);
//echo $Dailymotion;
//echo $url->Dailymotion;

//$Facebook = $url->Facebook;
//$Facebook = str_replace("url=", "", $Facebook);
//echo $Facebook;
//echo $url->Facebook;

$Facebook = $url->Facebook_;
$Facebook = str_replace("url=", "", $Facebook);
//echo $Facebook;
//echo $url->Facebook;

$wistia = $url->wistia;
$wistia = str_replace("url=", "", $wistia);
//echo $wistia;
//echo $url->wistia;

$GoogleDrive = $url->GoogleDrive;
$GoogleDrive = str_replace("url=", "", $GoogleDrive);
//echo $GoogleDrive;
//echo $url->GoogleDrive;

$MP4 = $url->MP4Player;
$MP4 = str_replace("url=", "", $MP4);
//echo $MP4;
//echo $url->MP4;

$dropbox = $url->dropbox;
$dropbox = str_replace("url=", "", $dropbox);
$dropbox = str_replace("?dl=0", "?raw=1", $dropbox);
//echo $dropbox;
//echo $url->dropbox;

function manipulate_embed_sources($source){
$source = str_replace(
array("?dl=0","/view?usp=sharing","https://www.dailymotion.com/video/","https://streamable.com/","watch?v="),
array("?raw=1","/preview","https://www.dailymotion.com/embed/video/","https://streamable.com/o/","embed/"),
$source
);
return ($source);
}

/*
CHANGE MANUAL PLAYER FUNCTION HERE
$embed_player = --> src="<?php echo manipulate_embed_sources($source); ?>"
*/
$source = $embed_player;
?>
<html lang="en">
    <head data-cast-api-enabled="true">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Embed Player</title>
    <link rel="shortcut icon" href="https://kodi.al/panel.ico"/>
    <link rel="icon" href="https://kodi.al/panel.ico"/>
    <meta http-equiv="cache-control" content="no-store">
    <meta name="description" content="Embed Player" />
    <meta name="author" content="Olsion Bakiaj - Endrit Pano" />
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
    <meta name="referrer" content="no-referrer"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Albdroid TV">
    <meta name="keywords" content="Albdroid TV" />
    <meta name="application-name" content="Albdroid TV">
    <meta name="msapplication-tooltip" content="Albdroid TV">
    <meta name="msapplication-starturl" content="http://cdn.kodi.al">
    <meta property="og:type" content="Television" />
    <meta name="msapplication-TileColor" content="#0F0">
    <meta name="msapplication-navbutton-color" content="#0F0">
    <meta name="theme-color" content="#0F0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#0F0">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://cdn.kodi.al">
    <meta property="og:site_name" content="Embed Player">
    <meta property="og:title" content="Albdroid TV">
    <meta property="og:description" content="Albdroid.al">
    <meta property="og:locale" content="en_US">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@trc4com">
    <meta name="twitter:title" content="Albdroid.al">
    <meta name="twitter:description" content="Albdroid.al">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#0F0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="metatags generator">
    <meta name="robots" content="noindex, nofollow">
    <meta name="revisit-after" content="3 month">
</head>
<style type="text/css">
body,td,th {
	color: #0F0;
}
body {
	background-color: #000;
}
</style>
<body topmargin="0" leftmargin="0" oncontextmenu="return false" style="background:black; margin: 0px" width="100%" height="100%">
<div class="video">
<iframe width="100%" height="100%" src="<?php echo manipulate_embed_sources($source); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; fullscreen">
</iframe>
</div>
</body>
</html>
