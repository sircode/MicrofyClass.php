## MicrofyClass.php

**Minimal utility helpers for everyday PHP tasks** (object-oriented version) 

Status: EXPERIMENTAL

---

## 🧰 What is it?

**MicrofyClass.php** is the object-oriented version of [`microfy.php`](https://github.com/sircode/microfy.php) — a minimalist utility class packed with static helper methods to simplify everyday PHP development.

It brings the same no-bloat, no-dependency philosophy — now in a class-based format — offering tools for request handling, debugging, logging, HTML snippets, database access, and more.

Forget frameworks when all you need is power and speed — **Microfy** is your coding pocketknife.

---

## 💡 Why use it?

* You're tired of repetitive boilerplate like `isset($_GET['x']) ? $_GET['x'] : ''`
* You want clean, expressive, and testable PHP code
* You work in an OOP environment but don’t want bulky libraries
* You need practical helpers like `Microfy::getVar()`, `Microfy::pp()`, `Microfy::dbAll()` right away
* You value full control with zero magic

---

## ✨ Features 

* **Request Access**: `getVar()`, `postVar()`, `requestVar()` and prefixed variants
* **Debug Tools**: `pp()`, `pd()`, `mpp()`, `mlog()`, with optional returns (`pdd()`, `pdr()`)
* **Database**: PDO helpers like `dbPdo()`, `dbAll()`, `dbExists()`, etc.
* **HTML Snippets**: `h()`, `br()`, `codePhp()`, `mark()`, `a()`, `b()`, `ul()`, `li()` and more
* **Array Utils**: `getArray()` (formerly `getR()`) for safe key lookups
* **Slugify**: Easily generate SEO-safe slugs
* **JSON Reader**: `jsonf()` for simple flat-file configs
* **List Helpers**: `cList()`, `cStr()` for smart numbered headings and counters

#### 🧱 **HTML Builder Functions** (v0.1.04+) 

Use these to generate clean, semantic HTML in PHP — all methods return strings.

#### 📦 Core & Generic

* `tag()`: Low-level generic tag builder
* `html_tag()`: Alias to `tag()` for semantic grouping
* `pretty_html()`: Formats raw HTML for human-friendly display

#### 📄 Document Structure

* `html_html()`, `html_head()`, `html_body()`
* `html_header()`, `html_footer()`, `html_section()`, `html_article()`, `html_nav()`, `html_aside()`

#### 📚 Content Blocks

* `html_div()`, `html_span()`, `html_p()`, `html_blockquote()`, `html_pre()`, `html_code()`
* `html_h1()` → `html_h6()`

#### 📑 Lists

* `html_ul()`, `html_ol()`, `html_li()`
* `html_dl()`: Takes an array of `['term' => ..., 'desc' => ...]`

#### 📊 Tables

* `html_table()`, `html_thead()`, `html_tbody()`
* `html_tr()`, `html_th()`, `html_td()`

#### 📝 Forms

* `html_form()`, `html_label()`, `html_input()`, `html_textarea()`, `html_select()`, `html_button()`

#### 🧩 Self-closing & Inline

* `html_br()`, `html_hr()`, `html_img()`, `html_meta()`, `html_link()`

#### 🔧 Embeds & Styles

* `html_script()`, `html_style()`

---

Here’s a clean, concise addition you can drop into your `README.md`:

---

### 🔁 Echoing Helpers (`e_` aliases)

If you'd rather use functions like `e_p()`, `e_div()`, or `e_html_ul()` instead of writing `echo Microfy::p(...)`, you can include the optional alias file:

```php
require_once 'microfy_echo_aliases.php';
```

This file defines convenient `e_` versions of all output-generating methods in `Microfy`. For example:

```php
e_p("Hello"); // same as echo Microfy::p("Hello");
e_html_ul(["One", "Two"]); // same as echo Microfy::html_ul([...]);
```

These aliases are safe, optional, and designed for quick prototyping or simplified views.

> Only methods that return markup or formatted output get `e_` aliases — utilities like `slugify()` or `now()` are excluded.

---

## 📌 When to Use MicrofyClass.php

Use `MicrofyClass.php` when:

* You prefer structured, class-based projects but want minimal dependencies
* You’re building tools, scripts, or APIs and don’t need full frameworks
* You want to keep code readable, consistent, and DRY — especially in shared teams
* You want the best of both worlds: OOP and shortcut-style aliases

---

## 🛠 Bonus: Procedural Aliases

Want the simplicity of `pp($data)` or `dbAll(...)` in your OOP project?

Just include microfy_aliases.php to use short, procedural-style aliases for all **Microfy:: methods** — no need to prefix everything manually.

```php
require_once 'MicrofyClass.php';
require_once 'microfy_aliases.php'; // optional

pp(['quick', 'debug']); // works alongside Microfy::pp(...)
```



---

## 🚀 Usage Examples

```php
require_once 'MicrofyClass.php';
```

### 🔍 Access & Debug

```php
Microfy::pp($_GET);
$name  = Microfy::getVar('name', 'Guest');
$email = Microfy::getArray(['email' => 'test@test.com'], 'email', 'none');
```

### 🎯 Extract Prefixed GET Vars

```php
extract(Microfy::getVarsPrefixed(['path', 'id']));

// Example: $_GET = ['path' => 'demo', 'id' => '42'];
// Results: $get_path = 'demo'; $get_id = '42';
```

### 🗃️ Database Access

```php
$pdo  = Microfy::dbPdo('localhost', 'mydb', 'user', 'pass');
$rows = Microfy::dbAll($pdo, "SELECT * FROM users");
Microfy::pp($rows);
```

### 🕒 Utilities & Output

```php
echo Microfy::now();
$data = Microfy::jsonf('users.json');
echo Microfy::a('example.com', 'Example');
echo Microfy::htmlTable($data);
echo Microfy::htmlTable($data, $class, $id);
Microfy::cList(['apple', 'banana', 'cherry']);
```

### ⚙️ Config & System

```php
Microfy::def('APP_NAME', 'microfy');
Microfy::load('config');
```

### 🖼️ HTML Helpers

```php
Microfy::h(2, 'Welcome');
echo Microfy::b('Bold text');
echo Microfy::slugify('This is a title!');
Microfy::ok(); // JSON response
```

### 📝 UI Components

```php
Microfy::p('Paragraph text', 'highlight');
Microfy::codephp('<?php echo "Hello"; ?>');
Microfy::ul(['Item 1', 'Item 2']);
Microfy::br();
Microfy::c('Step A');
```

## 📘 [More Examples](https://itnb.com/MicrofyClass/)

---

## 🤝 Contributing

We welcome contributions! See [CONTRIBUTING.md](CONTRIBUTING.md) for details.

---

### 🔒 License

**MIT License** — © 2024–2025 [SirCode](https://itnb.com/) |
This project is not affiliated with or endorsed by the PHP Foundation.
Use at your own risk — no warranties, no guarantees, just useful code.

---

### 📦 Also Available as Procedural Version

Prefer short global functions like `pp()`, `getVar()`, or `dbAll()`?
👉 [`microfy.php`](https://github.com/sircode/microfy.php) offers the same features — no classes required.


---

