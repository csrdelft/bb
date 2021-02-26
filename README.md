# C.S.R. BB Parser

This package was originally based on [eamBBParser](https://sourceforge.net/projects/eambbparser/). Some parser internals are still based on that implementation.

## Installation

Install with composer

```
composer require csrdelft/bb
```

## Usage

Either use the `DefaultParser` or implement your own parser.

```php
$parser = new \CsrDelft\BbBundle\DefaultParser();

echo $parser->getHtml('[h=1]Hello World[/h]');
```

### Tags
The default tags available are:

|Tag name|Description|
|---|---|
|`[b]`| Bold text |
|`[i]`|Italic|
|`[u]`|Underline|
|`[s]`|Strikethrough|
|`[sub]`|Subscript|
|`[sup]`|Superscript|
|`[clear]`|Clear|
|`[code]`|Code block|
|`[commentaar]`|Comment|
|`[div class=? w=? h=? float=left/right clear?]`|Div|
|`[email]`|Email|
|`[h]`|Header|
|`[hr]`|Horizontal rule|
|`[1337]`|Leet speak|
|`[lishort]`, `[*]`| List item|
|`[list]`, `[ulist]`| List|
|`[li]`|List item|
|`[me]`| /me|
|`[rn]`| New line|
|`[nobold]`|Disable `[b]`|
|`[quote]`|Blockquote|
|`[table]`|Table element|
|`[td]`| Table cell|
|`[th]`| Table header|
|`[tr]`|Table Row|

### Custom tags

Tags must extend the `\CsrDelft\BbBundle\Parser\BbTag` class. Tags must implement the `parse($arguments)` and `getTagName()` methods.

The `getTagName` method retuns a string or list of strings with the name(s) of this tag.

The `parse` method receives a map of arguments. The `readContent` method can be used to retrieve the contents of
the tag, this content is parsed by the parser when it is received. The parser reads the input until an end tag is
found. `readContent` has an optional parameter for tags which are forbidden to be in this tag. For instance a `[sup]`
tag cannot contain another sup tag or a sub tag.

A tag has access to an environment, which is by default of type `CsrDelft\BbBundle\Parser\Bbenv` (can be overridden).

### Custom tag example

```php
class BbSuperscript extends BbTag {
	public static function getTagName() {
		return 'sup';
	}

	public function render() {
		return '<sup class="bb-tag-sup">' . $this->getContent() . '</sup>';
	}
    
    public function parse($arguments = []) {
         $this->readContent(['sub', 'sup']);
       }
}
```

### Custom parser

A custom parser must extend `Parser` and contains a list of tags in the `$tags` field. See `DefaultParser` for the 
list of default tags.
