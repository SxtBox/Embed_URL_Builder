<?php

use Sxt_Box\Embed_URL_Builder;

if (! function_exists("Embed_Link")) {
    /**
     * Generate Automatically Embed Player for Various Social Media Websites
     *
     * @param string $url
     * @param string $title
     * @return Embed_URL_Builder
     */
    function Embed_Link(string $url, string $title): Embed_URL_Builder
    {
        return new Embed_URL_Builder($url, $title);
    }
}
