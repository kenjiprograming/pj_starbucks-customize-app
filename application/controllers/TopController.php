<?php

/**
 * @property $twig
 */
class TopController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $assign['a'] = 'aa';

        $this->twig->render('/templates/top.html.twig', $assign);
    }

    public function privacy_policy(): void
    {
        $this->twig->render('/templates/privacy-policy.html.twig');
    }

}