<?php

namespace Sxt_Box;

class Embed_URL_Builder
{
    protected $url;
    protected $title;

    public function __construct(string $url, string $title)
    {
        $this->url = $url;
        $this->title = $title;
    }

    /**
     * Build URL with properly encoded query string parameters.
     * @param string $url
     * @param array $params
     * @return string
     */
    protected function build_url(string $url, array $params): string
    {
        return $url . urldecode(http_build_query($params));
    }

    /**
     * Return the value of a method that is intended for getting a URL string.
     * For example, $this->facebook is the same as $this->getFacebookUrl()
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $methodName = "get" . ucfirst($name) . "url";

        if (method_exists($this, $methodName)){
            return $this->{$methodName}();
        }

        $classShortName = (new \ReflectionClass($this))->getShortName();
        throw new \InvalidArgumentException("Undefined property: {$classShortName}::{$name}");
    }

    public function getMP4PlayerUrl(): string
    {
       return $this->build_url("",
		[
            "url" => $this->url,
			//"title" => urlencode($this->title),
        ]);
    }

    public function getFacebook_Url(string $appId = null): string
    {
        $env = function_exists("env") ? "env" : "getenv";

        return $this->build_url("https://www.facebook.com/dialog/share?",
		[
            "app_id" => $appId ?? $env("FACEBOOK_APP_ID") ?: "",
            "href" => $this->url,
            "display" => "page",
            "title" => urlencode($this->title),
        ]);
    }

/*
https://www.facebook.com/webmoderators/videos/2411617505650058
https://www.facebook.com/plugins/video.php?height=314&href=https://www.facebook.com/webmoderators/videos/2411617505650058/&show_text=false&width=560&t=0
FULL VIDEO URL https://www.facebook.com/webmoderators/videos/2411617505650058/
*/
    public function getFacebookUrl_(): string
    {
        return $this->build_url("https://www.facebook.com/video/embed?video_id=",
		[
           "url" => $this->url,
        ]);
    }

/*
https://developers.facebook.com/docs/plugins/embedded-video-player/
https://www.facebook.com/video.php?v={id}
VIDEO ID https://www.facebook.com/video.php?v=2411617505650058/
*/
    public function getFacebookUrl(): string
    {
        return $this->build_url("https://www.facebook.com/video.php?v=",
		[
           "url" => $this->url,
        ]);
    }

    public function getTwitterUrl(): string
    {
        return $this->build_url("https://twitter.com/intent/tweet?",
		[
            "url" => $this->url,
            "text" => urlencode($this->limit($this->title, 240)),
        ]);
    }

    public function getWhatsappUrl(): string
    {
        return $this->build_url("https://wa.me/?",
		[
            "text" => urlencode($this->title . ' ' . $this->url),
        ]);
    }

    public function getLinkedinUrl(): string
    {
        return $this->build_url("https://www.linkedin.com/shareArticle?mini=true&",
		[
            "url" => $this->url,
            "summary" => urlencode($this->title),
        ]);
    }

    public function getPinterestUrl(): string
    {
        return $this->build_url("https://pinterest.com/pin/create/button/?media=&",
		[
            "url" => $this->url,
            "description" => urlencode($this->title),
        ]);
    }

    public function getDropBoxUrl(): string
    {
		// https://www.dropboxforum.com/t5/Dropbox-files-folders/How-to-embed-a-video-from-your-Dropbox-account-on-a-website/td-p/208019
		// https://www.dropbox.com/s/4bd215jgva9w9a5/Michael%20Cretu%20-%20Samurai%20%28German%20Version%29.mp4?dl=0
		// https://www.dropbox.com/s/4bd215jgva9w9a5/Michael%20Cretu%20-%20Samurai%20%28German%20Version%29.mp4?raw=1
		// ?dl=0 at the end to ?raw=1
        return $this->build_url("",
		[
            //"url" => $this->url,
			"url" => str_replace("?dl=0", "?raw=1", $this->url),
			//"title" => urlencode($this->title),
			//"title" => urlencode("Dropbox Player"),
        ]);
    }

// NULL
    public function getGoogleUrl(): string
    {
        return $this->build_url("https://plus.google.com/share?",
		[
            "url" => $this->url,
			//"title" => urlencode($this->title),
			"title" => urlencode("Google Plus Player"),
        ]);
    }

    public function getYouTubeUrl(): string
    {
		// https://www.youtube.com/embed/tVgVVIOPjZs
		// https://www.youtube.com/watch?v=tVgVVIOPjZs
        return $this->build_url("https://www.youtube.com/embed/",
		[
            "url" => $this->url,
			//"title" => urlencode($this->title),
			"title" => urlencode("YouTube Player"),
        ]);
    }

    public function getVimeoUrl(): string
    {
		// https://player.vimeo.com/video/512345103
        return $this->build_url("https://player.vimeo.com/video/",
		[
           "url" => $this->url,
			//"title" => urlencode($this->title),
			"title" => urlencode("Vimeo Player"),
        ]);
    }


    public function getGoogleDriveUrl(): string
    {
		// https://drive.google.com/file/d/1I97_2xGW0q-Is0Sgocpkc8E_qdxHIEz9/view?usp=sharing
		// duhet vetem id
        return $this->build_url("https://drive.google.com/file/d/",
		[
           "url" => $this->url."/preview",
		    //"title" => urlencode($this->title),
			"title" => urlencode("Google Drive Player"),
        ]);
    }

    public function getEmbedUrl(): string
    {
        return $this->build_url("",
		[
           "url" => $this->url,
        ]);
    }

		// https://www.dailymotion.com/video/x81a55w
    public function getDailymotionUrl(): string
    {
        return $this->build_url("https://www.dailymotion.com/embed/video/",
		[
           "url" => $this->url,
		    //"title" => urlencode($this->title),
			"title" => urlencode("Dailymotion Player"),
        ]);
    }

    public function getWistiaUrl(): string
    {
		// https://fast.wistia.com/embed/iframe/26sk4lmiix
        return $this->build_url("https://fast.wistia.com/embed/iframe/",
		[
           "url" => $this->url,
		    //"title" => urlencode($this->title),
			"title" => urlencode("Wistia Player"),
        ]);
    }

    public function getVudeoUrl(): string
    {
		//https://vudeo.io/embed-aqgypxct9pmq.html
        return $this->build_url("https://vudeo.io/embed-",
		[
           "url" => $this->url . ".html",
		   	//"title" => urlencode($this->title),
			"title" => urlencode("Vudeo Player"),
        ]);
    }

    public function getStreamableUrl(): string
    {
		// https://streamable.com/d9jkh9
        return $this->build_url("https://streamable.com/o/",
		[
           "url" => $this->url,
		   	//"title" => urlencode($this->title),
			//"title" => urlencode("streamable Player"),
        ]);
    }

    /**
     * Limit the number of characters in a string.
     *
     * @param string $value
     * @param integer $limit
     * @param string $end
     * @return string
     */
    protected function limit(string $value, int $limit = 100, string $end = "..."): string
    {
        if (mb_strwidth($value, "UTF-8") <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', "UTF-8")).$end;
    }
}
