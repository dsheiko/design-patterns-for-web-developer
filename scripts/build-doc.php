<?php


class Context
{

}

abstract class Interpreter
{
    public function interpret($expression, View $context);

}
class WikiInterpreter
{
    public function interpret($expression, View $context)
    {

    }
}
// translate macros
// translate inline
// trnslate lists
class Macros
{
    // 
    public function __construct()
    {

    }
}
class Client
{
    static public function convert($markup)
    {
        preg_match_all("/\[(\w+)\:(.*?)\]/", $markup, $matches);
    }
}

// *xxx* - bold
// _xxx_ - italic
// -xxx- - strike
// +xxx+ - underline
// ^xxx^ - superscript
// h1. xxx - header
// [title|link] or [link] - external link
//      [title|abbr:text] - abbreviated phrase (http://reference.sitepoint.com/html/abbr)
//      [title|acronym:text] - acronym (http://reference.sitepoint.com/html/acronym)
//      [dfn:text] - defining instance of a term (http://reference.sitepoint.com/html/dfn)
//      [samp:text] - a sample of characters (http://reference.sitepoint.com/html/samp)
//      [var:text] - variable (http://reference.sitepoint.com/html/var)
//      [blockquote:quote|author|title|url]
//
//
// !filename|title=title! - atttached image
//  * xxx - list
//  *# xxx - list
// ||col1||col2|| - table
// |cell1|cell2|
// {code:php}xxx{code} - code
// {html}xxx{html} - html
// {quote}xxx{quote} - quoting



class Client
{
    static public convert($markup)
    {
        if (!$markup) {
            return null;
        }
        $lines = explode("\n", $markup);
        $this->_tokens = $this->_tokenGetAll($lines);
        foreach ($lines as $index => $line) {
            $lines[$index] = $this->_handleLine($line, $index);
        }
        $text = implode("\n", $lines);
        $text = $this->_handleBlocks($text);
        return $text;
    }
}

class ConfluenceConvertor
{
    private $_tokens;
    private $_filePath;

    private $_lineRegexes = array(
        "/\s\*([^\s\*].*?[^\s\*])\*\s/" => " <strong>\$1</strong> ",
        "/\s_([^\s_].*?[^\s_])_/" => " <em>\$1</em> ",
        "/\s\-([^\s\-].*?[^\s\-])\-\s/" => " <strike>\$1</strike> ",
        "/\s\+([^\s\+].*?[^\s\+])\+\s/" => " <u>\$1</u> ",
        "/\s\^([^\s\^].*?[^\s\^])\^\s/" => " <super>\$1</super> ",
        "/^\s*?h(\d)\.(.*?)$/" => "<h\$1>\$2</h\$1>",
    );

    private $_blockquoteTpl = '<blockquote cite="[url]">
<p>[quote]</p>
<footer>%26mdash; <cite><a title="[title]" href="[url]">[author]</a></cite></footer>
</blockquote>';

    const CODE_CODE = 'code';
    const CODE_QUOTE = 'quote';
    const CODE_HTML = 'html';
    const CODE_UL = 'ul';
    const CODE_OL = 'ol';
    const CODE_THEAD = 'thead';
    const CODE_TBODY = 'tbody';
    const CODE_H = 'h';

    private function _tokenTriggerHelper($condition, $code, $i, &$tokens)
    {
        if ($condition) {
            $tokens[$i]['code'] = $code;
            if ($i > 0 && $code == $tokens[$i - 1]['code']) {
                $tokens[$i]['closer'] = true;
            } else{
                $tokens[$i]['opener'] = true;
            }
        }
        if ($i > 0 && $code == $tokens[$i - 1]['code'] && !$tokens[$i - 1]['closer']) {
            $tokens[$i]['code'] = $code;
        }
    }
    /**
     * Mimics PHP token_get_all
     *
     * @param array $lines
     * @param array $tokens
     */
    private function _tokenGetAll($lines)
    {
        $tokens = array();
        $openers = array();

        foreach ($lines as $i => $line) {

            $tokens[$i] = array(
                'code' => null,
                'scope' => 0,
                'opener' => false,
                'closer' => false,
                'tails' => array(),
            );

            // Simple triggers {quote}, {code}, {html}

            $this->_tokenTriggerHelper(false !== strstr($line, '{quote}')
                , self::CODE_QUOTE, $i, $tokens);
            $this->_tokenTriggerHelper(false !== strstr($line, '{html}')
                , self::CODE_HTML, $i, $tokens);
            $this->_tokenTriggerHelper(preg_match("/\{code([^\}]*?)\}/", $line)
                , self::CODE_CODE, $i, $tokens);

            if (preg_match("/^\s*?h(\d)\./", $line)) {
                $tokens[$i]['code'] = self::CODE_H;
            }
            if (isset ($tokens[$i][self::CODE_CODE]) || isset ($tokens[$i][self::CODE_HTML])) {
                continue;
            }

            // Find all li */# xxx
            if (preg_match("/^\s*?([\*#]+)/", $line, $parts)) {
                if (!preg_match("/\*[^\*]+\*/" , $line)){
                    $tokens[$i]['code'] =
                        substr($parts[1], -1, 1) == "*" ? self::CODE_UL : self::CODE_OL;
                    $tokens[$i]['scope'] = strlen(trim($parts[1]));
                }
            }
            if ($i > 0 && in_array($tokens[$i - 1]['code'], array(self::CODE_UL, self::CODE_OL)))
            {
                if (in_array($tokens[$i]['code'], array(self::CODE_UL, self::CODE_OL))) {
                    if ($tokens[$i]['scope'] > $tokens[$i - 1]['scope']) {
                        $tokens[$i]['opener'] = true;
                        $openers[$tokens[$i]['scope']] = $tokens[$i]['code'];
                    }
                    if ($tokens[$i]['scope'] < $tokens[$i - 1]['scope']) {
                        $tokens[$i - 1]['closer'] = true;
                        // When it skiped several scopes
                        $_clone = $openers;
                        $tokens[$i - 1]['tails'] = array_reverse(
                            array_splice($_clone, $tokens[$i]['scope']));
                        array_splice($openers, - ($tokens[$i - 1]['scope'] - $tokens[$i]['scope']));
                    }
                } else {
                    $tokens[$i - 1]['closer'] = true;
                    $tokens[$i - 1]['tails'] = array_reverse($openers);
                    $openers = array();
                }
            } else {
                if (in_array($tokens[$i]['code'], array(self::CODE_UL, self::CODE_OL))) {
                    $tokens[$i]['opener'] = true;
                    $openers[1] = $tokens[$i]['code'];
                }
            }

            // Find all TR - ||xxx||
            if (preg_match("/^\s*?\|\|.*?\|\|/", $line)) {
                $tokens[$i]['code'] = self::CODE_THEAD;
                if ($i == 0 || self::CODE_THEAD != $tokens[$i - 1]['code']) {
                    $tokens[$i]['opener'] = true;
                }
            // Find all TR - |xxx|
            }elseif (preg_match("/^\s*?\|.*?\|/", $line)) {
                $tokens[$i]['code'] = self::CODE_TBODY;
                if ($i == 0 || self::CODE_TBODY != $tokens[$i - 1]['code']) {
                    $tokens[$i]['opener'] = true;
                }
            }

            if ($i > 0 && self::CODE_THEAD == $tokens[$i - 1]['code']
                    && self::CODE_THEAD != $tokens[$i]['code'])
            {
                $tokens[$i - 1]['closer'] = true;
            }
            if ($i > 0 && self::CODE_TBODY == $tokens[$i - 1]['code']
                    && self::CODE_TBODY != $tokens[$i]['code'])
            {
                $tokens[$i - 1]['closer'] = true;
            }

        }

        return $tokens;
    }
    /**
     * Callback for preg_replace of Code element
     *
     * @param array $matches
     * @return string
     */
    public function codeCallback($matches)
    {
        $allowedTypes = array("js", "php", "bash", "xml", "java", "css", "plain");
        $type = strtolower(ltrim($matches[1], ':'));
        $code = ltrim($matches[2], "\n");
        $code = rtrim($code, "\n ");
        if (!in_array($type, $allowedTypes)) {
            if (empty($type)){
                $type = "php";
            } else if ('html' === $type) {
                $type = "xml";
            } else {
                $type = "plain";
            }
        }
        return '<pre class="brush: ' . $type . '">'
            . htmlentities($code) . '</pre>';
    }
    /**
     * Process the list item when neccessary
     *
     * @param string $line
     * @param int $i
     * @return string line
     */
    private function _processLists($line, $i)
    {
        if (in_array($this->_tokens[$i]['code'], array(self::CODE_UL, self::CODE_OL))) {
            $line = preg_replace("/^\s*?(\*|#)+(.*?)$/", "<li>\$2</li>", $line);
            if ($this->_tokens[$i]['opener']) {
                $this->_openers[] = $this->_tokens[$i]['code'];
                $line = sprintf("<%s>\n", $this->_tokens[$i]['code']) . $line;
            }
            if ($this->_tokens[$i]['closer']) {
                foreach ($this->_tokens[$i]['tails'] as $code) {
                    $line = $line . sprintf("</%s>\n", $code);
                }
            }
        }
        return $line;
    }
    /**
     * Decorates TH of the line by token map
     *
     * @param string $line
     * @return string
     */
    private function _wrapThs($line)
    {
        $out = '';
        $slices = explode("||", trim($line,"| "));
        foreach ($slices as $slice) {
            $out .= "<th>{$slice}</th>";
        }
        return $out;
    }
    /**
     * Decorates TD of the line by token map
     *
     * @param string $line
     * @return string
     */
    private function _wrapTds($line)
    {
        $out = '';
        $slices = explode("|", trim($line,"| "));
        foreach ($slices as $slice) {
            $out .= "<td>{$slice}</td>";
        }
        return $out;
    }
    /**
     * Process table row when neccessary
     *
     * @param string $line
     * @param int $i
     * @return string line
     */
    private function _processTables($line, $i)
    {

        if (self::CODE_THEAD == $this->_tokens[$i]['code']) {
            $line = '<tr>' . $this->_wrapThs($line) . '</tr>';
            if ($this->_tokens[$i]['opener']) {
                $line = "<table>\n<thead>\n" . $line;
            }
            if ($this->_tokens[$i]['closer']) {
                $line = $line . "\n</thead>\n";
            }
        }
        if (self::CODE_TBODY == $this->_tokens[$i]['code']) {
            $line = '<tr>' . $this->_wrapTds($line) . '</tr>';
            if ($this->_tokens[$i]['opener']) {
                if (self::CODE_THEAD == $this->_tokens[$i - 1]['code']) {
                    $line = "<tbody>\n" . $line;
                } else {
                    $line = "<table>\n<tbody>\n" . $line;
                }
            }
            if ($this->_tokens[$i]['closer']) {
                $line = $line . "\n</tbody>\n</table>\n";
            }
        }
        return $line;
    }
    /**
     * Callback for preg_replace of:
     * links    [title|link] or [link]
     * abbr     [title|abbr:text]
     * acronym  [title|acronym:text]
     * dfn      [dfn:text]
     * samp     [samp:text]
     * var      [var:text]
     * blockquote [quote|author|title|url]
     *
     * @param array $matches
     * @return string
     */
    public function referenceCallback($matches)
    {
        if (false !== strstr($matches[1], "|")) {
            list($title, $subject) = explode("|", $matches[1]);
            $subject = trim($subject);
            if (preg_match("/^http[s]?:/is", $subject)) {
                // Goes with a link
                return "<a href=\"{$subject}\" title=\"{$title}\">{$title}</a>";
            } elseif (preg_match("/^blockquote:/is", $subject)) {
                $parts = explode("|", $matches[1]);
                $subject = strtr($this->_blockquoteTpl, array(
                   "[quote]" => $parts[0],
                   "[author]" => $parts[2],
                   "[title]" => $parts[3],
                   "[url]" => $parts[4],
                ));
                preg_replace("/^blockquote:/is", "", $subject);
                return "<abbr title=\"{$title}\">{$subject}</abbr>";
            } elseif (preg_match("/^abbr:/is", $subject)) {
                 // Goes with an abbreviated phrase
                $subject = preg_replace("/^abbr:/is", "", $subject);
                return "<abbr title=\"{$title}\">{$subject}</abbr>";
            } elseif (preg_match("/^acronym:/is", $subject)) {
                 // Goes with an abbreviated phrase
                $subject = preg_replace("/^acronym:/is", "", $subject);
                return "<abbr title=\"{$title}\">{$subject}</abbr>"; // The acronym element is obsolete. Use the abbr element instead.
            } else {
                // As it is
                return $matches[0];
            }
        } else {
            // There is no | delimiter, so let's assume that's a link
            $matches[1] = trim($matches[1]);
            if (preg_match("/^http[s]?:/is", $matches[1])) {
                // Goes with a link
                $title = preg_replace("/http[s]?:\/\//is", "", $matches[1]);
                return "<a href=\"{$matches[1]}\" title=\"{$title}\">{$title}</a>";
            } elseif (preg_match("/^dfn:/is", $matches[1])) {
                 // Goes with a definition
                return "<dfn>" . preg_replace("/^dfn:/is", "", $matches[1]) . "</dfn>";
            } elseif (preg_match("/^samp:/is", $matches[1])) {
                 // Goes with a sample
                return "<samp>" . preg_replace("/^samp:/is", "", $matches[1]) . "</samp>";
            } elseif (preg_match("/^var:/is", $matches[1])) {
                 // Goes with a variable
                return "<var>" . preg_replace("/^var:/is", "", $matches[1]) . "</var>";
            } else {
                // As it is
                return $matches[0];
            }
        }
    }
    /**
     * Callback for preg_replace of images
     * !url|title=!
     * @param array $matches
     * @return string
     */
    public function imageCallback($matches)
    {
        if (false !== strstr($matches[1], "|")) {
            list($url, $title) = explode("|", $matches[1]);
            $title = preg_replace("/^(title|alt)=/is", "", $title);
        } else {
            $url = $matches[1];
            $title = '';
        }
        if (false === strstr($url, "http:")) {
            return "<img src=\"{$this->_filePath}/{$url}\" title=\"{$title}\" alt=\"{$title}\" />";
         } else {
            return "<img src=\"{$url}\" title=\"{$title}\" alt=\"{$title}\" />";
         }
    }

    /**
     *
     * @param string $line
     * @return string
     */
    private function _guessExtLinks($line)
    {
        // entities
        $line = str_replace(' -- ', ' &mdash; ', $line);
        $line = str_replace('(C)', '&copy;', $line);
        $line = str_replace('(R)', '&reg;', $line);
        $line = str_replace('(TM)', '&trade;', $line);
        // @TODO: fix me
        $line = str_replace('%26', '&', $line);

       // guess links
       $urls = null;
       if (preg_match_all("#[^\"] ((?:http|https|ftp|nntp)://[^ ]+)#", $line, $urls))
       {
          foreach ($urls[1] as $url)
          {
             $line = str_replace($url, "<a href=\"{$url}\">{$url}</a>", $line);
          }
       }
       if (preg_match_all("# (www\.[^\n\%\ ]+[^\n\%\,\.\ ])#", $line, $urls))
       {
          foreach ($urls[1] as $url)
          {
             $line = str_replace($url, "<a href=\"http://{$url}\">{$url}</a>", $line);
          }
       }
      return $line;
    }
    /**
     * Handle every line for Wiki instructions
     *
     * @param string $line
     * @param int $i
     * @return string line
     */
    private function _handleLine($line, $i)
    {
        if (empty ($line)) {
            if (null !== $this->_tokens[$i]['code']) {
                return $line;
            }
            return '<br />';
        }
        if (!in_array($this->_tokens[$i]['code'], array(self::CODE_HTML, self::CODE_CODE))) {

            foreach($this->_lineRegexes as $pattern => $sub) {
                $line = preg_replace($pattern, $sub, $line);
            }
            // Convert all [title|url] into <a href="url">title</a>
            $line = preg_replace_callback("/\[(.*?)\]/", array($this, 'referenceCallback')
                , $line);
            // Convert all !url.ext! into <img src="url.ext" />
            $line = preg_replace_callback("/\!([^\!]{5,200})\!/", array($this, 'imageCallback')
                , $line);
            $line = $this->_guessExtLinks($line);
        }
        $line = $this->_processLists($line, $i);
        $line = $this->_processTables($line, $i);



        // When it's not a line of a list (ul/ol) or table
        // then we can convert into a paragraph
        if (null !== $this->_tokens[$i]['code']) {
            return $line;
        }
        return '<p>' . $line . '</p>';

    }
    /**
     * Traverses whole text to parse block declarations:
     * {quote}, {code}, {html}
     *
     * @param string $text
     * @return string
     */
    private function _handleBlocks($text)
    {
        $text = preg_replace("/\{quote\}(.*?)\{quote\}/s", "\n<q>\$1</q>\n", $text);
        $text = preg_replace_callback("/\{code([^\}]*?)\}(.*?)\{code\}/s"
            , array($this, 'codeCallback'), $text);
        $text = str_replace('{html}', '', $text);
        return $text;
    }
    /**
     *
     * @param string $text
     * @return string
     */
    public function convert($text, $filePath = null)
    {
        if (empty ($text)) {
            return null;
        }

        $this->_filePath = $filePath;

        $lines = explode("\n", $text);
        $this->_tokens = $this->_tokenGetAll($lines);
        foreach ($lines as $index => $line) {
            $lines[$index] = $this->_handleLine($line, $index);
        }
        $text = implode("\n", $lines);
        $text = $this->_handleBlocks($text);
        return $text;
    }
}