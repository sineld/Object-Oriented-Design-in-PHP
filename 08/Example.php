<?php
require 'Renderers.php';

class Page
{
    protected $renderers = [];

    public function add(Renderer $renderer)
    {
        $this->renderers[] = $renderer;
    }

    public function render()
    {
        $content = '';
        $content .= "--Start of Page--\n";
        $content .= array_reduce($this->renderers, function($output, $r) {
            return $output .= $r->render()."\n";
        }, '');
        $content .= "--End of Page--\n";

        return $content;
    }
}

$page = new Page();
$page->add(new BlogRenderer());
$page->add(new ArticleRenderer());
$page->add(new GraphRenderer());
// $page->add(new Page());

echo $page->render();
