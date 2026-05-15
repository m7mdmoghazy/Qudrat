<?php

class Pagination {
    private $totalItems;
    private $itemsPerPage;
    private $currentPage;
    private $url;

    public function __construct($totalItems, $itemsPerPage, $currentPage, $url) {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
        $this->url = $url;
    }

    public function getOffset() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getTotalPages() {
        return ceil($this->totalItems / $this->itemsPerPage);
    }
    
    public function render() {
        $totalPages = $this->getTotalPages();
        if ($totalPages <= 1) return '';
        
        $html = '<nav><ul class="pagination justify-content-center">';
        
        // Prev
        if ($this->currentPage > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->url . '?page=' . ($this->currentPage - 1) . '">&laquo;</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
        }
        
        // Pages
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $this->currentPage) ? 'active' : '';
            $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="' . $this->url . '?page=' . $i . '">' . $i . '</a></li>';
        }
        
        // Next
        if ($this->currentPage < $totalPages) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->url . '?page=' . ($this->currentPage + 1) . '">&raquo;</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link">&raquo;</span></li>';
        }
        
        $html .= '</ul></nav>';
        return $html;
    }
}
