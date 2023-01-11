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

    public function index($kind): void
    {
        $post = $_POST;

        $drink = $this->config->item('drinks')[$post['name']];

        $ice_or_hot    = $post['ice_or_hot'];

        $name       = $drink['name'];
        $price      = $drink['price'];
        $imageUrl   = $drink['imageUrl'];
        $customizes = $drink['customizes'];
        $recommend = $drink['recommend'];

        $totalPrices = [];

        foreach ($customizes[$ice_or_hot] as $catchPhrase => $customize)
        {
            $totalPrice = $price;
            foreach ($customize as $custom => $addPrice)
            {
                 $totalPrice += $addPrice;
            }
            $totalPrices[$catchPhrase] = $totalPrice;
        }

        $assign = [
            'customizes'  => $customizes[$ice_or_hot],
            'totalPrices' => $totalPrices,
            'kind'        => $kind,
            'name'        => $name,
            'price'       => $price,
            'imageUrl'    => $imageUrl,
            'ice_or_hot'  => $ice_or_hot,
            'recommend'   => $recommend,
        ];

        $this->twig->render('/templates/result.html.twig', $assign);
    }

}