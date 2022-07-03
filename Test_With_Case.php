<?php
include("src/Embed_URL_Builder.php");

$video_url = isset($_GET["url"]) && !empty($_GET["url"]) ? $_GET["url"] : "https://streamable.com/d9jkh9";
$site_title = isset($_GET["site_title"]) && !empty($_GET["site_title"]) ? $_GET["site_title"] : "TRC4.COM";

$url = new \Sxt_Box\Embed_URL_Builder($video_url, $site_title);

$mp4_player    = preg_match("/(www.?|)mp4|mov\/.*/", $video_url, $match); // OK
$hls_player    = preg_match("/(www.?|)m3u|m3u8\/.*/", $video_url, $match); // OK
$vudeo_dot_net = preg_match("/(www.?|)vudeo.net\/.*/", $video_url, $match); // OK
$vudeo_dot_io  = preg_match("/(www.?|)vudeo.io\/.*/", $video_url, $match); // OK
$dropbox       = preg_match("/(www.?|)dropbox.com\/.*/", $video_url, $match); // OK
$dailymotion   = preg_match("/(www.?|)dailymotion.com\/.*/", $video_url, $match); // OK
$streamable    = preg_match("/(www.?|)streamable.com\/.*/", $video_url, $match); // OK
$facebook      = preg_match("/(www.?|)facebook.com\/.*/", $video_url, $match); // ?
$vimeo         = preg_match("/(www.?|)vimeo.com\/.*/", $video_url, $match); // OK
$youtube       = preg_match("/(www.?|)youtube.com\/.*/", $video_url, $match); // OK
$google_drive  = preg_match("/(www.?|)drive.google.com\/.*/", $video_url, $match); // OK
$wistia        = preg_match("/(www.?|)wistia.com\/.*/", $video_url, $match); // OK
$google_photos = preg_match("/(www.?|)(photos.google.com|photos.app.goo.gl)\/.*/", $video_url, $match); // NO
$mediafire     = preg_match("/(www.?|)mediafire.com\/.*/", $video_url, $match); // NULL

// ?url={YT URL}
$youtube = $url->youtube;
$youtube = str_replace("url=", "", $youtube);
$youtube_title = ("Youtube Embed Player");
//echo $youtube;
//echo $url->youtube;

// ?url={VM URL}
$vimeo = $url->vimeo;
$vimeo = str_replace("url=", "", $vimeo);
$vimeo_title = ("Vimeo Embed Player");
//echo $vimeo;
//echo $url->vimeo;

// ?url={VU URL}
$vudeo = $url->vudeo;
$vudeo = str_replace("url=", "", $vudeo);
$vudeo_title = ("Vudeo Embed Player");
//echo $vudeo;
//echo $url->vudeo;

// ?url={Streamable URL}
$streamable = $url->Streamable;
$streamable = str_replace("url=", "", $streamable);
$streamable = str_replace("https://streamable.com/", "https://streamable.com/o/", $video_url);
$streamable_title = ("Streamable Embed Player");
//echo $streamable;
//echo $url->streamable;

// ?url={Dailymotion URL}
$dailymotion = $url->Embed;
$dailymotion = str_replace("url=", "", $dailymotion);
$dailymotion = str_replace("https://www.dailymotion.com/video/", "https://www.dailymotion.com/embed/video/", $video_url);
$dailymotion_title = ("Dailymotion Embed Player");
//https://www.dailymotion.com/video/x81a55w
//echo $dailymotion;
//echo $url->Dailymotion;

// ?url={Facebook URL}
$facebook = $url->Facebook;
$facebook = str_replace("url=", "", $facebook);
$facebook_title = ("Facebook Embed Player");
//echo $facebook;
//echo $url->Facebook;

// ?url={WIstia URL}
$wistia = $url->wistia;
$wistia = str_replace("url=", "", $wistia);
$wistia_title = ("Wistia Embed Player");
//echo $wistia;
//echo $url->wistia;

// ?url={Google Drive URL}
$google_drive = $url->GoogleDrive;
$google_drive = str_replace("url=", "", $google_drive);
$google_drive = str_replace("/view?usp=sharing", "/preview", $google_drive);
$google_drive_title = ("Google Drive Embed Player");
//echo $google_drive;
//echo $url->GoogleDrive;

// ?url={MP4 URL}
$mp4_player = $url->MP4Player;
$mp4_player = str_replace("url=", "", $mp4_player);
$mp4_title = "MP4 Player";
//echo $mp4_player;
//echo $url->mp4_player;

// ?url={Dropbox URL}
$dropbox = $url->dropbox;
$dropbox = str_replace("url=", "", $dropbox);
$dropbox = str_replace("?dl=0", "?raw=1", $dropbox);
$dropbox_title = ("Dropbox Embed Player");
//echo $dropbox;
//echo $url->dropbox;

switch (true) {
	case $mp4_player:
	// ?url=https://kodi.al/app_stream_tester/E-Type_-_Here_I_Go_Again.mp4
		$sources = $mp4_player;
		$titles = $mp4_title;
	break;

	case $hls_player:
		$titles = ("HLS Player");
		// ?url=https://abr.de1se01.v2beat.live/playlist.m3u8
		$sources = $mp4_player;
	break;

	case $dropbox:
		$titles = $dropbox_title;
		// ?url=https://www.dropbox.com/s/4bd215jgva9w9a5/Michael%20Cretu%20-%20Samurai%20%28German%20Version%29.mp4?dl=0
		$sources = $dropbox;
		//"title" => urlencode("streamable Player");
	break;

	case $google_drive:
		$titles = $google_drive_title;
		// ?url=https://drive.google.com/file/d/1fs1w46hlyHAzyBh_EWr4jH-k_2wTKd5g/view?usp=sharing
		$sources = $google_drive;
	break;

	case $google_photos:
		$titles = $google_drive_title;
		// ?url=https://drive.google.com/file/d/1fs1w46hlyHAzyBh_EWr4jH-k_2wTKd5g/view?usp=sharing
		$sources = $google_drive;
	break;

	case $vimeo:
		// ?url=https://player.vimeo.com/video/512345103
		$sources = $vimeo;
		$titles = $vimeo_title;
	break;

	case $dailymotion:
		// ?url=https://www.dailymotion.com/video/x81a55w
		$sources = $dailymotion;
		$titles = $dailymotion_title;
	break;

	case $streamable:
		// ?url=https://streamable.com/d9jkh9
		$sources = $streamable;
		$titles = $streamable_title;
	break;

	case $youtube:
		// ?url=https://www.youtube.com/watch?v=tVgVVIOPjZs
		$sources = $youtube;
	break;

	case $wistia:
		// ?url=https://fast.wistia.com/embed/iframe/26sk4lmiix
		$sources = $wistia;
	break;

	case $vudeo:
		// ?url=https://vudeo.io/embed-aqgypxct9pmq.html
		$sources = $vudeo;
	break;
default:

break;
}

$title = $titles;
$source = $sources;

function manipulate_embed_sources($source){
$source = str_replace(
array("?dl=0","/view?usp=sharing","https://www.dailymotion.com/video/","https://streamable.com/","watch?v="),
array("?raw=1","/preview","https://www.dailymotion.com/embed/video/","https://streamable.com/o/","embed/"),
$source
);
return ($source);
}

/* manipulate_embed_sources
$source = str_replace("?dl=0", "?raw=1", $source); // dropbox
$source = str_replace("/view?usp=sharing", "/preview", $source); // gdrive
$source = str_replace("https://www.dailymotion.com/video/", "https://www.dailymotion.com/embed/video/", $source); // dailymotion
$source = str_replace("https://streamable.com/", "https://streamable.com/o/", $source); // streamable
$source = str_replace("watch?v=", "embed/", $source); // youtube
*/

?>
<html lang="en">
    <head data-cast-api-enabled="true">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title; ?></title>
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
