<?php

declare(strict_types=1);
/**
 * MicrofyClass.php
 * v0.1.3 
 * Author: SirCode
 */
class Microfy
{
    

    // Safe array accessor
    public static function val(array $array, $key, $default = null)
    {
        return $array[$key] ?? $default;
    }

    // GET/POST/REQUEST
    public static function getVar($key, $default = '')
    {
        return self::val($_GET, $key, $default);
    }
    public static function postVar($key, $default = '')
    {
        return self::val($_POST, $key, $default);
    }
    public static function requestVar($key, $default = '')
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    // Extract specific keys
    public static function extractKeys(array $keys, array $source, string $prefix = ''): array
    {
        $out = [];
        foreach ($keys as $key) {
            $out["{$prefix}{$key}"] = $source[$key] ?? '';
        }
        return $out;
    }

    public static function getVars(array $keys, string $prefix = '')
    {
        return self::extractKeys($keys, $_GET, $prefix);
    }
    public static function postVars(array $keys, string $prefix = '')
    {
        return self::extractKeys($keys, $_POST, $prefix);
    }
    public static function reqVars(array $keys, string $prefix = '')
    {
        return self::extractKeys($keys, $_REQUEST, $prefix);
    }
    public static function getVarsWithPrefix(array $keys): array
    {
        return self::getVars($keys, 'get_');
    }

    // Map & load key=>label or key=>[label,default]
    public static function loadInputs(array $map, array $source): array
    {
        $out = [];
        foreach ($map as $var => $rule) {
            [$key, $default] = is_array($rule) ? $rule + ['', ''] : [$rule, ''];
            $out[$var] = $source[$key] ?? $default;
        }
        return $out;
    }

    public static function getAll(array $map)
    {
        return self::loadInputs($map, $_GET);
    }
    public static function postAll(array $map)
    {
        return self::loadInputs($map, $_POST);
    }
    public static function reqAll(array $map)
    {
        return self::loadInputs($map, $_REQUEST);
    }

    // Export to $GLOBALS
    public static function injectGlobals(array $source, array $allow, string $prefix = ''): void
    {
        foreach ($allow as $key) {
            $GLOBALS[$prefix . $key] = $source[$key] ?? '';
        }
    }



    // --- PDO connection ---
    public static function dbPdo($host, $dbname, $user, $pass, $charset = 'utf8mb4', $driver = 'mysql'): ?PDO
    {
        if ($driver === 'pgsql') {
            $dsn = "pgsql:host=$host;dbname=$dbname";
        } else {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        }

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            self::dd("PDO Connection failed: " . $e->getMessage());
            return null;
        }
    }

    // --- DB helpers ---
    public static function dbAll(PDO $pdo, string $sql, array $params = []): array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // <-- fix here
    }

    public static function dbOne(PDO $pdo, string $sql, array $params = []): mixed
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public static function dbVal(PDO $pdo, string $sql, array $params = []): mixed
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public static function dbCount(PDO $pdo, string $sql, array $params = []): int
    {
        return (int) self::dbVal($pdo, $sql, $params);
    }

    public static function dbExec(PDO $pdo, string $sql, array $params = []): bool
    {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function dbInsertId(PDO $pdo): string
    {
        return $pdo->lastInsertId();
    }

    public static function dbExists(PDO $pdo, string $table, string $column, $value): bool
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            return false; // invalid table name
        }
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
            return false; // invalid column name
        }

        $sql = "SELECT 1 FROM `$table` WHERE `$column` = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetchColumn() !== false;
    }


    public static function dbError(PDOException $e): void
    {
        self::dd("DB Error: " . $e->getMessage());
    }

    // --- MySQLi connection ---
    public static function dbMysqli($host, $user, $pass, $dbname, $port = 3306): mysqli
    {
        $mysqli = new mysqli($host, $user, $pass, $dbname, $port);

        if ($mysqli->connect_error) {
            self::dd("MySQLi Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }


    /* 
    Usage Examples
    $pdo = Microfy::dbPdo('localhost', 'mydb', 'user', 'pass');
    $rows = Microfy::dbAll($pdo, "SELECT * FROM users");
    Microfy::pp($rows);
    */

    // --- debug ---

    // --- Pretty Print (print_r) ---
    public static function pp($data, $limit = null): void
    {
        echo self::ppr($data, $limit);
    }

    public static function ppd($data, $limit = null): void
    {
        self::pp($data, $limit);
        die();
    }

    public static function mpp(...$args): void
    {
        foreach ($args as $arg) {
            echo self::ppr($arg);
        }
    }

    public static function mppd(...$args): void
    {
        self::mpp(...$args);
        die();
    }

    public static function ppr($data, $limit = null): string
    {
        $output = print_r($data, true);
        if ($limit !== null) {
            $lines = explode("\n", $output);
            $output = implode("\n", array_slice($lines, 0, $limit));
        }
        return "<pre>$output</pre>";
    }

    public static function pper($data, $limit = null): string
    {
        $output = self::ppr($data, $limit);
        echo $output;
        return $output;
    }

    // --- Var Dump (dumps) ---
    public static function pd($var, $label = null): void
    {
        echo self::pdr($var, $label);
    }

    public static function pdd($var, $label = null): void
    {
        self::pd($var, $label);
        die();
    }

    public static function pdr($var, $label = null): string
    {
        ob_start();
        echo "<pre>";
        if ($label) echo "$label:\n";
        var_dump($var);
        echo "</pre>";
        return ob_get_clean();
    }

    // --- Simple dump shortcuts ---
    public static function d(...$args): void
    {
        foreach ($args as $arg) {
            echo self::pdr($arg);
        }
    }

    public static function dd(...$args): void
    {
        self::d(...$args);
        die();
    }

    // --- Logging ---
    public static function mlog($text, $label = null, $file = 'debug.log'): void
    {
        $entry = ($label ? "$label:\n" : "") . $text . "\n";
        file_put_contents($file, $entry, FILE_APPEND);
    }

    public static function logPr($var, $label = null, $file = 'debug_pr.log'): void
    {
        self::mlog(print_r($var, true), $label, $file);
    }

    public static function logVd($var, $label = null, $file = 'debug_vd.log'): void
    {
        self::mlog(self::pdr($var, $label), null, $file);
    }

    public static function debugSession(): void
    {
        echo "<div style='font-family: monospace; color: black; background: #f8f8f8; border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
        echo "<strong>Session Name:</strong> " . session_name() . "<br>";
        echo "<strong>Session ID:</strong> " . session_id() . "<br>";
        echo "<strong>\$_SESSION:</strong><br>";
        echo "<pre>" . htmlspecialchars(print_r($_SESSION, true)) . "</pre>";
        echo "</div>";
    }



    // --- ENV / TIME ---

    public static function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }

    public static function now(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format);
    }

    // --- FILES ---

    public static function jsonf(string $file, bool $assoc = true)
    {
        if (!file_exists($file)) return null;
        $content = file_get_contents($file);
        return json_decode($content, $assoc);
    }

    // --- HTML HELPERS ---

    public static function a(string $href, ?string $text = null, string $target = '', string $class = ''): string
    {
        if (!preg_match('#^https?://#', $href)) {
            $href = "https://$href";
        }

        $text = $text ?? $href;
        $targetAttr = $target ? " target=\"$target\"" : '';
        $classAttr  = $class  ? " class=\"$class\""   : '';

        return "<a href=\"$href\"$targetAttr$classAttr>$text</a>";
    }

    public static function htmlTableSafe(array $rows, string $cssClass = '', string $id = ''): string
    {

        $array = $rows;
        $class = $cssClass;

        if (empty($array)) {
            return "<p><em>No data.</em></p>";
        }
        if (!isset($array[0]) || !is_array($array[0]) || empty($array[0])) {
            return "<p><em>No columns to display.</em></p>";
        }

        $idAttr = $id !== ''
            ? " id='" . htmlspecialchars((string)$id, ENT_QUOTES, 'UTF-8', false) . "'"
            : '';
        $classAttr = $class !== ''
            ? " class='" . htmlspecialchars((string)$class, ENT_QUOTES, 'UTF-8', false) . "'"
            : " border='1' cellpadding='6' cellspacing='0'";

        $html = "<table{$idAttr}{$classAttr}>";

        // thead
        $html .= "<thead><tr>";
        foreach (array_keys($array[0]) as $col) {
            $colStr = (string)$col;
            $html .= '<th>'
                . htmlspecialchars($colStr, ENT_QUOTES, 'UTF-8', false)
                . '</th>';
        }
        $html .= "</tr></thead>";

        // tbody
        $html .= "<tbody>";
        foreach ($array as $row) {
            if (!is_array($row)) {
                continue; // skip invalid rows
            }
            $html .= "<tr>";
            foreach ($row as $cell) {
                if (is_array($cell) || is_object($cell)) {
                    $cellStr = '';
                } else {
                    $cellStr = (string)$cell;
                }
                $html .= '<td>'
                    . htmlspecialchars($cellStr, ENT_QUOTES, 'UTF-8', false)
                    . '</td>';
            }
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";

        return $html;
    }

    /**
     * Builds an HTML table, escaping every cell by default—
     * but allowing raw HTML in any column you whitelist.
     *
     * @param array       $rows         Row-data, as an array of associative arrays
     * @param string[]    $allowRawCols  Column-names whose values are already-safe HTML
     * @param string      $cssClass         Optional CSS class
     * @param string      $id            Optional element ID
     * @return string                    HTML string of the table (or a “no data” message)
     */
    public static function htmlTable(
        array  $rows,
        array  $allowRawCols = [],
        string $cssClass       = '',
        string $id          = ''
    ): string {


        $array = $rows;
        $class = $cssClass;

        if (empty($array)) {
            return "<p><em>No data.</em></p>";
        }
        if (!isset($array[0]) || !is_array($array[0]) || empty($array[0])) {
            return "<p><em>No columns to display.</em></p>";
        }

        // build id and class (or default border attrs) safely
        $idAttr = $id !== ''
            ? " id='" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8', false) . "'"
            : '';
        $classAttr = $class !== ''
            ? " class='" . htmlspecialchars($class, ENT_QUOTES, 'UTF-8', false) . "'"
            : " border='1' cellpadding='6' cellspacing='0'";

        $html = "<table{$idAttr}{$classAttr}>";

        // thead
        $html .= "<thead><tr>";
        foreach (array_keys($array[0]) as $col) {
            $colStr = (string)$col;
            $html .= '<th>'
                . htmlspecialchars($colStr, ENT_QUOTES, 'UTF-8', false)
                . '</th>';
        }
        $html .= "</tr></thead>";

        // tbody
        $html .= "<tbody>";
        foreach ($array as $row) {
            if (!is_array($row)) {
                continue;
            }
            $html .= "<tr>";
            foreach ($row as $col => $cell) {
                // normalize to string
                if (is_array($cell) || is_object($cell)) {
                    $cellStr = '';
                } else {
                    $cellStr = (string)$cell;
                }

                // if this column is whitelisted, output raw; else escape
                if (in_array($col, $allowRawCols, true)) {
                    $html .= "<td>{$cellStr}</td>";
                } else {
                    $html .= '<td>'
                        . htmlspecialchars($cellStr, ENT_QUOTES, 'UTF-8', false)
                        . '</td>';
                }
            }
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";

        return $html;
    }



    // --- MISC OUTPUT ---

    public static function cList(array $items, bool $reset = false): void
    {
        static $counter = 1;
        if ($reset) $counter = 1;

        foreach ($items as $item) {
            echo $counter++ . '. ' . $item . '<br>';
        }
    }

    /* 
    Usage Examples
    echo Microfy::now();
    $data = Microfy::jsonf('users.json');
    echo Microfy::a('example.com', 'Example');
    echo Microfy::htmlTable($data);
    Microfy::cList(['apple', 'banana', 'cherry']);

    */

    // --- LOADER / CONST ---

    public static function load(string $file): void
    {
        include_once __DIR__ . "/$file.php";
    }

    public static function def(string $name, $value): void
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    // --- RESPONSE / OUTPUT ---

    public static function hsc(string $str): void
    {
        echo htmlspecialchars($str);
    }

    public static function json($data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function ok(string $msg = 'OK'): void
    {
        self::json(['status' => 'ok', 'msg' => $msg]);
    }

    public static function fail(string $msg = 'Error'): void
    {
        self::json(['status' => 'fail', 'msg' => $msg]);
    }

    public static function jsonArray(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function jsonString(string $msg, bool $ok = true): string
    {
        return self::jsonArray([
            'status' => $ok ? 'ok' : 'fail',
            'msg'    => $msg,
        ]);
    }


    // --- STRING ---

    public static function slugify(string $string): string
    {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        return trim($string, '-');
    }

    // --- STYLE / HTML OUTPUT ---

    public static function h(int $level, string $text, string $class = ''): void
    {
        $level = max(1, min(6, $level));
        $classAttr = $class ? " class=\"$class\"" : '';
        echo "<h$level$classAttr>$text</h$level>";
    }

    public static function b(string $text = '', string $class = ''): string
    {
        $classAttr = $class ? " class=\"$class\"" : '';
        return "<b$classAttr>$text</b>";
    }

    public static function i(string $text = '', string $class = ''): string
    {
        $classAttr = $class ? " class=\"$class\"" : '';
        return "<i$classAttr>$text</i>";
    }

    public static function bi(string $text = '', string $class = ''): string
    {
        $classAttr = $class ? " class=\"$class\"" : '';
        return "<b$classAttr><i>$text</i></b>";
    }

    public static function small(string $text = '', string $class = ''): string
    {
        $classAttr = $class ? " class=\"$class\"" : '';
        return "<small$classAttr>$text</small>";
    }

    public static function mark(string $text = '', string $class = ''): string
    {
        $classAttr = $class ? " class=\"$class\"" : '';
        return "<mark$classAttr>$text</mark>";
    }


    /* 
    Example Usage
    Microfy::def('APP_NAME', 'microfy');
    Microfy::load('config');

    Microfy::h(2, 'Welcome');
    echo Microfy::b('Bold text');
    echo Microfy::slugify('This is a title!');
    Microfy::ok(); // JSON response

    */


    // --- BLOCK ELEMENTS ---

    public static function p(string $text = '', string $class = ''): void
    {
        echo "<p" . self::classAttr($class) . ">$text</p>";
    }

    public static function span(string $text = '', string $class = ''): void
    {
        echo "<span" . self::classAttr($class) . ">$text</span>";
    }

    public static function div(string $text, array $attrs = []): string
    {
        $attrStr = self::buildAttr($attrs);
        return "<div$attrStr>$text</div>";
    }
    public static function section(string $text = '', string $class = ''): void
    {
        echo "<section" . self::classAttr($class) . ">$text</section>";
    }

    public static function buildAttr(array $attrs): string
    {
        $parts = [];
        foreach ($attrs as $k => $v) {
            $parts[] = "$k=\"" . htmlspecialchars($v) . "\"";
        }

        return $parts ? ' ' . implode(' ', $parts) : '';
    }

    // --- CODE BLOCKS ---

    public static function code(string $content, string $lang = ''): void
    {
        $class = $lang ? " class=\"language-$lang\"" : '';
        echo "<pre><code$class>" . htmlspecialchars($content) . "</code></pre>";
    }

    public static function codejs(string $text): void
    {
        self::code($text, 'js');
    }
    public static function codephp(string $text): void
    {
        self::code($text, 'php');
    }
    public static function codejson(string $text): void
    {
        self::code($text, 'json');
    }
    public static function codehtml(string $text): void
    {
        self::code($text, 'html');
    }
    public static function codesql(string $text): void
    {
        self::code($text, 'sql');
    }
    public static function codebash(string $text): void
    {
        self::code($text, 'bash');
    }
    public static function codec(string $text): void
    {
        self::code($text, 'c');
    }

    // --- LISTS ---

    public static function ul(array $items, string $class = ''): void
    {
        echo "<ul" . self::classAttr($class) . ">";
        foreach ($items as $item) {
            echo "<li>$item</li>";
        }
        echo "</ul>";
    }

    public static function ulOpen(): void
    {
        echo "<ul>";
    }
    public static function ulClose(): void
    {
        echo "</ul>";
    }
    public static function li(string $text): void
    {
        echo "<li>$text</li>";
    }

    // --- LINE BREAKS & HR ---

    public static function br(...$args): void
    {
        if (empty($args)) echo '<br>';
        else foreach ($args as $arg) echo '<br>' . $arg;
    }

    public static function bra(...$args): void
    {
        if (empty($args)) echo '<br>';
        else foreach ($args as $arg) echo $arg . '<br>';
    }

    public static function hr(...$args): void
    {
        if (empty($args)) echo '<hr>';
        else foreach ($args as $arg) echo '<hr>' . $arg;
    }

    public static function hra(...$args): void
    {
        if (empty($args)) echo '<hr>';
        else foreach ($args as $arg) echo $arg . '<hr>';
    }

    // --- COUNTER ---

    public static function c(string $text = ''): void
    {
        static $counter = 1;
        echo $counter++ . '. ' . $text;
    }

    public static function cStr(string $text = ''): string
    {
        static $counter = 1;
        return $counter++ . '. ' . $text;
    }

    // --- SHARED UTILITY ---

    protected static function classAttr(string $class): string
    {
        return $class ? " class=\"$class\"" : '';
    }

    /*
    Example Usage
    Microfy::p('Paragraph text', 'highlight');
    Microfy::codephp('<?php echo "Hello"; ?>');
    Microfy::ul(['Item 1', 'Item 2']);
    Microfy::br();
    Microfy::c('Step A'); */
}
