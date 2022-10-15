<?php

class Top extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $assign['a'] = 'aa';

        $this->twig->render('/templates/top.html.twig', $assign);
    }

}