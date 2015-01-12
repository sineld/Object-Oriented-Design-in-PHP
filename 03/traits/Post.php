<?php
require '../../TablePrinter.php';

trait Categorizable
{
    public function getCategoryTable() { return "I am the table {$this->categoryTableName}"; }
    public function getCategories() { return ['Awesome', 'Even More Awesome']; }
}

trait Taggable
{
    public function getTagTable() { return "I am the table {$this->tagTableName}"; }
    public function getTags() { return ['#awesome', '#evenmoreawesome']; }
}

class FakeORM
{
    public $id;

    // Stubbed out instead of making a DB call
    public static function find($id) { return new static($id); }

    // Stubbed out instead of making a DB call
    public function __construct($id) { $this->id = $id; }
}

class Post extends FakeORM
{
    use Categorizable, Taggable;

    protected $categoryTableName = 'post_categories';
    protected $tagTableName = 'post_tags';
}

$post = Post::find(1);

$tp = new TablePrinter(['Method', 'Names', 'Results']);

$tp->addRow('Post::getCategoryTable()', $post->getCategoryTable(), join(', ', $post->getCategories()));
$tp->addRow('Post::getTagTable()', $post->getTagTable(), join(', ', $post->getTags()));

echo $tp->output();
