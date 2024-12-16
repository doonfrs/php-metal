<?php

namespace Metal;

use Metal\Base\Tag;

use function Metal\Html\emptytag;
use function Metal\Html\link;
use function Metal\Html\script;
use function Metal\Html\style;

class Metal
{

    public static $minify = false;

    public const enqueue_position_header = 0;
    public const enqueue_position_footer = 1;
    public const enqueue_position_body_start = 2;
    public const enqueue_position_body_end = 3;


    /**
     * List of scripts to be inserted when Metal::render function called
     * This list will be filled by plugins when loaded, also will be filled by enqueueScript function you may call before or while rendering
     * before render, you still have chance to modify plugins loaded styles by modifing this array
     * Array format 
     * $scripts["id"] = ['id' => $id, 'url' => $url, 'location' => $location, 'deps' => $dependsOn, 'async' => $async, 'defer' => $defer]
     * if you want to change a plugin scripts before or while rendering
     * Metal::$scripts['bootstrap']['defer'] = true;
     * You can update the scripts from any widget or before Metal::render because render function will check and merge all enqueued scripts/stylesheets/preconnects after rending all widgets tress
     * it will be better to check the plugin config, plugin should provide configuration to be set when plugin being loaded
     */
    public static array $scripts = [];


    /**
     * List of scripts to be inserted when Metal::render function called
     * Array format 
     * $stylesheets["id"] = ['id' => $id, 'url' => $url, 'location' => $location, 'deps' => $dependsOn, 'async' => $async, 'media' => $media]
     * Metal::$stylesheets['fontawesome']['async'] = true;
     * You can update the scripts from any widget or before Metal::render because render function will check 
     * and merge all enqueued scripts/stylesheets/preconnects after rending all widgets tress
     */
    public static array $stylesheets = [];


    public static array $appendToHtml = [];



    /**
     * List of preconnects to be inserted when Metal::render function called
     * This list will be filled by plugins when loaded, also will be filled by Metal::preconnect function you may call before or while rendering
     * before render, you still have chance to modify plugins loaded styles by modifing this array
     * Array format 
     * $preconnect["id"] = ['id' => $id, 'url' => $url]
     * if you want to change a plugin stylesheet before or while rendering
     * Metal::$stylesheets['fontawesome']['async'] = true;
     * You can update the scripts from any widget or before Metal::render because render function will check 
     * and merge all enqueued scripts/stylesheets/preconnects after rending all widgets tress
     * it will be better to check the plugin config, plugin should provide configuration to be set when plugin being loaded
     */
    public static array $preconnects = [];


    /**
     * Generate a string output based on the provided tag with optional minification and output capture.
     *
     * @param null|array|string|Tag $tag The tag to render
     * @param bool $captureOutput Whether to capture the output or echo it
     * @param bool $minify Whether to minify the output
     * @return ?string The rendered output string
     */
    static function render(
        null|array|string|Tag $tag,
        bool $captureOutput = false,
        bool $minify = true,
    ): ?string {
        self::$minify = $minify;

        if (!$tag) {
            return null;
        }

        if (is_array($tag) || is_string($tag)) {
            $tag = emptytag($tag);
        }

        $output = $tag->render();
        $output = self::mergeEnqueues($output);

        if (!$minify) {
            $output = self::tidyHTML($output);
        }

        if ($captureOutput) {
            return $output;
        } else {
            echo $output;
            return $output;
        }
    }

    /**
     * Merge enqueues for stylesheets, scripts, and html content into the output.
     *
     * @param mixed $output The original output to merge enqueues into.
     * @return mixed The modified output with enqueued items.
     */
    private static function mergeEnqueues($output)
    {
        $stylesheets = [];
        $scripts = [];
        $preconnects = self::$preconnects;

        $stylesheets = self::sortDeps(self::$stylesheets);
        $scripts = self::sortDeps(self::$scripts);
        $htmls = self::sortDeps(self::$appendToHtml);


        $headerHtml = '';
        $footerHtml = '';
        $bodyStart = '';
        $bodyEnd = '';

        if ($preconnects && is_array($preconnects)) {
            foreach ($preconnects as $pre) {
                $headerHtml .= link($pre['url'], rel: 'preconnect', id: $pre['id']);
            }
        }


        foreach ($stylesheets as $options) {
            $id = $options['id'];
            if (isset($options['url'])) {

                if ($options['async'] ?? false) {
                    $inject = link(
                        href: $options['url'],
                        id: $id,
                        rel: 'stylesheet',
                        media: 'print',
                        attributes: ['onload' => "this.media='all'; this.onload = null"]
                    );
                } else {
                    $inject = link(href: $options['url'], id: $id, rel: 'stylesheet', media: $options['media']);
                }
            } else {
                $inject = style(content: $options['content'], id: $id);
            }

            if ($options['location'] == self::enqueue_position_header) {
                $headerHtml .= $inject;
            } elseif ($options['location'] == self::enqueue_position_footer) {
                $footerHtml .= $inject;
            }
        }

        foreach ($scripts as $options) {
            $id = $options['id'];

            if (isset($options['url'])) {
                $inject = script(
                    id: "script_" . $id,
                    src: $options['url'],
                    async: $options['async'] ?? null,
                    defer: $options['defer'] ?? null
                );
            } else {
                $inject = script(
                    id: "script_" . $id,
                    content: $options['content'],
                    async: $options['async'] ?? null,
                    defer: $options['defer'] ?? null
                );
            }

            if ($options['location'] == self::enqueue_position_header) {
                $headerHtml .= $inject;
            } elseif ($options['location'] == self::enqueue_position_footer) {
                $footerHtml .= $inject;
            }
        }

        foreach ($htmls as $html) {
            if ($html['location'] == self::enqueue_position_body_start) {
                $bodyStart .= $html['content'];
            } elseif ($html['location'] == self::enqueue_position_body_end) {
                $bodyEnd .= $html['content'];
            }
        }

        $output = str_replace("</head>", $headerHtml . "</head>", $output);
        $output = str_replace("</body>", $footerHtml . "</body>", $output);
        $output = str_replace("<body>", "<body>$bodyStart", $output);
        $output = str_replace("</body>", "$bodyEnd</body>", $output);

        return $output;
    }


    /**
     * A function to sort dependencies in a PHP array.
     *
     * @param array $items The array of items to sort
     * @throws \Exception Unresolved Dependency check the items
     * @return array The sorted array of items
     */
    private static function sortDeps(array $items)
    {
        $res = array();
        $doneList = array();

        // while not all items are resolved:
        while (count($items) > count($res)) {
            $doneSomething = false;

            foreach ($items as $itemIndex => $item) {
                if (isset($doneList[$item['id']])) {
                    // item already in resultset
                    continue;
                }
                $resolved = true;

                if (isset($item['deps'])) {
                    foreach ($item['deps'] as $dep) {
                        if (!isset($doneList[$dep])) {
                            // there is a dependency that is not met:
                            $resolved = false;
                            break;
                        }
                    }
                }
                if ($resolved) {
                    //all dependencies are met:
                    $doneList[$item['id']] = true;
                    $res[] = $item;
                    $doneSomething = true;
                }
            }
            if (!$doneSomething) {
                throw new \Exception("Unresolved Dependency check the items " . json_encode($items), 1);
            }
        }
        return $res;
    }

    /**
     * Enqueue a script for loading in the footer of the page.
     *
     * @param string $id The unique identifier for the script.
     * @param string $url The URL of the script to enqueue.
     * @param int $location The position where the script should be loaded, defaults to footer.
     * @param bool $replace Whether to replace the script if it already exists.
     * @param string|array|null $dependsOn Scripts that this script depends on.
     * @param ?bool $async Whether the script should be loaded asynchronously.
     * @param ?bool $defer Whether the script should be deferred.
     */
    public static function enqueueScript(
        string $id,
        string $url,
        int $location = self::enqueue_position_footer,
        bool $replace = false,
        string|array|null $dependsOn = null,
        ?bool $async = null,
        ?bool $defer =  null
    ): void {
        if (!$replace && isset(self::$scripts[$id])) return;
        if (!is_array($dependsOn) && $dependsOn) $dependsOn = [$dependsOn];
        if (!$dependsOn) $dependsOn = [];

        if (str_contains($url, '?')) {
            $url = $url . "&v=" . date("YmdH");
        } else {
            $url = $url . "?v=" . date("YmdH");
        }

        self::$scripts[$id] = ['id' => $id, 'url' => $url, 'location' => $location, 'deps' => $dependsOn, 'defer' => $defer, 'async' => $async];
    }


    /**
     * Enqueues a stylesheet for the given ID.
     *
     * @param string $id The unique identifier for the stylesheet.
     * @param string $url The URL of the stylesheet.
     * @param int $location The location where the stylesheet should be enqueued. Default is self::enqueue_position_header.
     * @param string|null $media The media type for the stylesheet.
     * @param string|array|null $dependsOn The IDs of stylesheets this stylesheet depends on.
     * @param bool|null $async Whether to load the stylesheet asynchronously.
     * @param bool $replace Whether to replace an existing stylesheet with the same ID.
     */
    public static function enqueueStyle(
        string $id,
        string $url,
        int $location = self::enqueue_position_header,
        ?string $media = null,
        string|array|null $dependsOn = null,
        ?bool $async = null,
        bool $replace = false,
    ): void {
        if (!$replace && isset(self::$stylesheets[$id])) return;
        if (!is_array($dependsOn) && $dependsOn) $dependsOn = [$dependsOn];
        if (!$dependsOn) $dependsOn = [];

        if (str_contains($url, '?')) {
            $url = $url . "&v=" . date("YmdH");
        } else {
            $url = $url . "?v=" . date("YmdH");
        }

        self::$stylesheets[$id] = [
            'id' => $id,
            'url' => $url,
            'location' => $location,
            'deps' => $dependsOn,
            'async' => $async,
            'media' => $media
        ];
    }


    /**
     * 
     */

    /**
     * A description of the entire PHP function.
     *
     * @param string $id we use this to identify the element especially for dependency
     * @param Tag|string $content the Tag or string that should be injected
     * @param int $location self::enqueue_position_body_end or self::enqueue_position_body_start
     * @param string|array|null $dependsOn array of ids or id that this should depend on, it will be added after it in the queue
     * @param bool $replace if true we will replace element if already eqnqueued, otherwise it will be ignore if there is already an element with the same id
     */
    public static function appendToHtml(
        string $id,
        Tag|string $content,
        int $location = self::enqueue_position_body_end,
        string|array|null $dependsOn = null,
        bool $replace = false,
    ): void {
        if (!$replace && isset(self::$appendToHtml[$id])) return;
        if (!is_array($dependsOn) && $dependsOn) $dependsOn = [$dependsOn];
        if (!$dependsOn) $dependsOn = [];

        self::$appendToHtml[$id] = [
            'id' => $id,
            'content' => $content,
            'location' => $location,
            'deps' => $dependsOn
        ];
    }

    /**
     * This PHP function preConnect adds a given ID and URL to a list of preconnects if not already present, with an option to replace existing entries.
     *
     * @param string $id the ID of the preconnect 
     * @param string $url the URL of the preconnect
     * @param bool|null $replace if true we will replace element if already eqnqueued, otherwise it will be ignore if there is already an element with the same id 
     */
    public static function preConnect(string $id, string $url, ?bool $replace = null): void
    {
        if (!$replace && isset(self::$preconnects[$id])) return;
        self::$preconnects[$id] = ['id' => $id, 'url' => $url];
    }

    /**
     * This code defines a function enqueueScriptSnippet that adds a script snippet to a list of scripts.
     * It allows specifying the ID, content, position, replacement behavior, dependencies, asynchronous loading, and deferred execution of the script.
     * If the script with the same ID already exists, it can be replaced based on the replace parameter.
     *
     * @param string $id The unique identifier for the script snippet.
     * @param string $script The script content to be enqueued.
     * @param int $location The position where the script should be enqueued, default is footer.
     * @param bool $replace Flag to indicate if the script should replace an existing one with the same ID.
     * @param string|array|null $dependsOn The script IDs this script depends on.
     * @param bool|null $async Whether to load the script asynchronously.
     * @param bool|null $defer Whether to defer the script execution.
     */
    public static function enqueueScriptSnippet(
        string $id,
        string $script,
        int $location = self::enqueue_position_footer,
        bool $replace = false,
        string|array|null $dependsOn = null,
        ?bool $async = null,
        ?bool $defer = null,
    ): void {
        if (!$replace && isset(self::$scripts[$id])) return;
        if (!is_array($dependsOn) && $dependsOn) $dependsOn = [$dependsOn];
        if (!$dependsOn) $dependsOn = [];

        self::$scripts[$id] = [
            'id' => $id,
            'content' => $script,
            'location' => $location,
            'defer' => $defer,
            'async' => $async,
            'deps' => $dependsOn
        ];
    }

    /**
     * This code defines a method enqueueStyleSnippet that adds a CSS style snippet to a list to be included in the page. 
     * It takes an identifier, the CSS style content, the position for enqueuing, an option to replace existing snippets, 
     * and optional dependencies for the snippet. 
     * It ensures uniqueness based on the ID and handles dependencies for the snippet.
     * @param string $id The unique identifier for the style snippet.
     * @param string $style The CSS style content to be added.
     * @param int $location The position where the style snippet should be enqueued.
     * @param bool $replace Whether to replace the style snippet if it already exists.
     * @param string|array|null $dependsOn An optional array or string specifying dependencies for the style snippet.
     */
    public static function enqueueStyleSnippet(
        string $id,
        string $style,
        int $location = self::enqueue_position_header,
        bool $replace = false,
        string|array|null $dependsOn = null
    ): void {
        if (!$replace && isset(self::$stylesheets[$id])) return;
        if (!is_array($dependsOn) && $dependsOn) $dependsOn = [$dependsOn];
        if (!$dependsOn) $dependsOn = [];

        self::$stylesheets[$id] = ['id' => $id, 'content' => $style, 'location' => $location, 'deps' => $dependsOn];
    }



    /**
     * This code snippet is a PHP function called tidyHTML that formats HTML content by adding appropriate indentation. 
     * It scans each line of the input HTML content and adjusts the indentation based on opening and closing tags. 
     * The function returns the formatted HTML content with proper indentation.
     *
     * @param mixed $content the HTML content to be formatted
     * @param string $tab the string used for indentation, defaults to "\t"
     * @return string the formatted HTML content with proper indentation
     */
    private static function tidyHTML($content, $tab = "\t")
    {
        $voidTag = null;
        $indent = 0;
        $padPrev = null;
        $content = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $content); // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
        $token = strtok($content, "\n"); // now indent the tags
        $result = ''; // holds formatted version as it is built
        $pad = 0; // initial indent
        $matches = array(); // returns from preg_matches()
        // scan each line and adjust indent based on opening/closing tags
        while ($token !== false && strlen($token) > 0) {
            $padPrev = $padPrev ?: $pad; // previous padding //Artis
            $token = trim($token);
            // test for the various tag states
            if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) { // 1. open and closing tags on same line - no change
                $indent = 0;
            } elseif (preg_match('/^<\/\w/', $token, $matches)) { // 2. closing tag - outdent now
                $pad--;
                if ($indent > 0) $indent = 0;
            } elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) { // 3. opening tag - don't pad this one, only subsequent tags (only if it isn't a void tag)
                foreach ($matches as $m) {
                    if (preg_match('/^<(area|base|br|col|command|embed|hr|img|input|keygen|link|meta|param|source|track|wbr)/im', $m)) { // Void elements according to http://www.htmlandcsswebdesign.com/articles/voidel.php
                        $voidTag = true;
                        break;
                    }
                }
                $indent = 1;
            } else { // 4. no indentation needed
                $indent = 0;
            }


            if ($token == "<textarea>") {
                $line = str_pad($token, strlen($token) + $pad, $tab, STR_PAD_LEFT); // pad the line with the required number of leading spaces
                $result .= $line; // add to the cumulative result, with linefeed
                $token = strtok("\n"); // get the next token
                $pad += $indent; // update the pad size for subsequent lines
            } elseif ($token == "</textarea>") {
                $line = $token; // pad the line with the required number of leading spaces
                $result .= $line . "\n"; // add to the cumulative result, with linefeed
                $token = strtok("\n"); // get the next token
                $pad += $indent; // update the pad size for subsequent lines
            } else {
                $line = str_pad($token, strlen($token) + $pad, $tab, STR_PAD_LEFT); // pad the line with the required number of leading spaces
                $result .= $line . "\n"; // add to the cumulative result, with linefeed
                $token = strtok("\n"); // get the next token
                $pad += $indent; // update the pad size for subsequent lines
                if ($voidTag) {
                    $voidTag = false;
                    $pad--;
                }
            }
        }
        return $result;
    }
}
