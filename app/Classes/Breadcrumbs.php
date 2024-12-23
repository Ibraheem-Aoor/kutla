<?php

namespace App\Classes;

class Breadcrumbs
{
    protected $breadcrumbs;

    protected $divider = '<i class="fa fa-angle-left"></i>';

    protected $rootClass = 'page-breadcrumb breadcrumb';

    public function setDivider($divider)
    {
        $this->divider = $divider;

        return $this;
    }

    public function setRootClass($class)
    {
        $this->rootClass = $class;

        return $this;
    }

    public function add($name, $link = null, $class = null)
    {
        $open = "<li>";
        if(strlen($this->breadcrumbs)) {
            $open .= ' ' . $this->divider . ' ';
        }

        $open .= "<i class=\"$class\"></i>";
        $close = "</li>";

        $breadCumb = $open . ($link ? "<a href=\"$link\">$name</a>" : "<span>$name</span>") . $close;

        $this->breadcrumbs = $this->breadcrumbs . $breadCumb;

        return $this;
    }

    public function render()
    {
        if(!strlen($this->breadcrumbs)) {
            echo "";
        }

        $open = "<ul class=\"$this->rootClass\">";
        $close = "</ul>";

        return $open . $this->breadcrumbs . $close;
    }

}