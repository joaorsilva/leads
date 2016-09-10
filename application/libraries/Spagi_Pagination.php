<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Spagi_Pagination
 * @copyright Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */


class Spagi_Pagination {
    
    const MAX_BUTTONS = 5;
    const DEFAULT_PAGE_SIZE = 10;
    
    public $page = 0;
    public $page_size = 10;
    public $pages = 0;
    public $start_page =0;
    public $end_page =0;
    public $start_row =0;
    public $end_row =0;
    public $total_rows = 0;
    
    public function calculate($start_row=0,$page_size=Spagi_Pagination::DEFAULT_PAGE_SIZE,$total_rows=0) {
        
        $this->total_rows = $total_rows;
        $this->start_row = $start_row;
        $this->page_size = $page_size;
        $this->end_row = $start_row + $this->page_size;
        $this->pages = ceil($this->total_rows/$this->page_size);
        
        $this->page = floor($start_row/$page_size);
        if($this->page <= floor(Spagi_Pagination::MAX_BUTTONS/2)) {
            $this->start_page =0;
            $this->end_page = Spagi_Pagination::MAX_BUTTONS -1;
            if($this->end_page > $this->pages)
                $this->end_page = $this->pages-1;
        } else if($this->page >= $this->pages - floor(Spagi_Pagination::MAX_BUTTONS/2)) {
            $this->start_page = $this->pages - Spagi_Pagination::MAX_BUTTONS -1;
            $this->end_page = $this->pages -1;
        } else {
            $this->start_page = $this->page - floor(Spagi_Pagination::MAX_BUTTONS/2);
            $this->end_page = $this->page - floor(Spagi_Pagination::MAX_BUTTONS/2);
        }
        if($this->end_row > $this->total_rows)
            $this->end_row = $this->total_rows;
        
        return (array) $this;
    }
}
