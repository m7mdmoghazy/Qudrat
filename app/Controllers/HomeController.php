<?php

class HomeController {
    
    public function index() {
        view('home/index');
    }
    
    public function about() {
        view('home/about');
    }
    
    public function contact() {
        view('home/contact');
    }
}
