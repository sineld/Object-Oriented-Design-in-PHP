<?php

interface Renderer
{
    public function render();
}

class BlogRenderer implements Renderer
{
    public function render()
    {
        return "Rendered blog";
    }
}

class ArticleRenderer implements Renderer
{
    public function render()
    {
        return "Rendered article";
    }
}

class GraphRenderer implements Renderer
{
    public function render()
    {
        return "Rendered graph";
    }
}
