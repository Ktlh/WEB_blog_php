<?php
class Pagination
{
    public $page;
    public $per_page;
    public $total;

    public function __construct($page = 1, $per_page = 10, $total = 0)
    {
        $this->page = (int)$page;
        $this->per_page = (int)$per_page;
        $this->total = (int)$total;
    }

    public function offset()
    {
        return ($this->page - 1)*$this->per_page;
    }

    public function count_pages()
    {
        return ceil($this->total / $this->per_page);
    }

    public function previous_page()
    {
        return $this->page - 1;
    }

    public function next_page()
    {
        return $this->page + 1;
    }

    public function has_previous_page()
    {
        return $this->previous_page() >= 1 ? true : false;
    }

    public function has_next_page()
    {
        return $this->next_page() <= $this->count_pages() ? true : false;
    }
}