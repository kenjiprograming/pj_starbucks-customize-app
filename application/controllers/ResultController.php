<?php
declare(strict_types=1);

/**
 * @property Twig $twig
 * @property CI_Input $input
 */
class ResultController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $assign = [
            'aaa' => 'a'
        ];

        $this->twig->render('/templates/result.html.twig', $assign);
    }

}