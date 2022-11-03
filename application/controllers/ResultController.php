<?php
declare(strict_types=1);

/**
 * @property Twig       $twig
 * @property CI_Input   $input
 * @property CI_Config  $config
 */
class ResultController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->config('data');
    }

    public function index(): void
    {
        $post = $_POST;

        $drink = $this->config->item('drinks')[$post['name']];

        $ice_or_hot    = $post['ice_or_hot'];
        $selectedPrice = $post['selectedPrice'];

        $name       = $drink['name'];
        $price      = $drink['price'];
        $imageUrl   = $drink['imageUrl'];
        $customizes = $drink['customizes'];


        $assign = [
            'customizes' => $customizes[$ice_or_hot],
            'name' => $name,
            'price' => $price,
            'selectedPrice' => $selectedPrice,
            'imageUrl' => $imageUrl,
        ];

        echo '<pre>';
        print_r($assign);
        exit();

        $this->twig->render('/templates/result.html.twig', $assign);
    }

}