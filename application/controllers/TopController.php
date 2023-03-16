<?php

/**
 * @property $twig
 * @property $config
 */
class TopController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->config('data');
    }

    public function index(): void
    {
        $assign['kinds'] = $this->config->item('kinds');
        $this->twig->render('/templates/top.html.twig', $assign);
    }

    public function privacy_policy(): void
    {
        $this->twig->render('/templates/privacy-policy.html.twig');
    }

}