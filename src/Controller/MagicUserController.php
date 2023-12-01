<?php

namespace Drupal\magic_user\Controller;

use Drupal\Core\Controller\ControllerBase;
use MagicAdmin\Magic;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use MagicAdmin\Util\Http;

/**
 * Returns responses for Magic User routes.
 */
class MagicUserController extends ControllerBase {

  /**
   * The configuration service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  private $magic;


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('module_handler')
    );
  }


// constructor
  public function __construct(ConfigFactoryInterface $config_factory) {
      // TODO get apikey from config
     $config = $config_factory->get('magic_user.settings');

    $this->configFactory = $config;
    $apikeysecret = $config->get('apikeysecret');
    
//    $magic = new \MagicAdmin\Magic($apikeysecret);
//    $this->magic = $magic;
//    $token = $magic->token;
//    $did_token = \MagicAdmin\Util\Http::parse_authorization_header_value(
//      getallheaders()['authorization']
//    );
//
//    //TODO Get did_token from public address magic javascript object
//
//
//    if ($did_token == null) {
//      // DIDT is missing from the original HTTP request header. You can handle this by
//      // remapping it to your application error.
//$magic->token->get_public_address;
//    }
//   // $this->magic = new Magic('sk_live_8D8A307024C07B22',5,5,0.01,);
//dump($this->magic, $did_token);
//    try {
//      $this->magic->token->validate($did_token);
//      $issuer = $this->magic->token->get_issuer($did_token);
//      dump($issuer, $did_token);
//    } catch (\MagicAdmin\Exception\DIDTokenException $e) {
//      dump($e);
//      // DIDT is malformed. You can handle this by remapping it to your application
//      // error.
//    }
//    $this->magic->token = '<KEY>';
  }

  /**
   * Builds the response.
   */
  public function build() {

//     $headers = getallheaders();

//     // Check if the Authorization header is present.
//     if (isset($headers['Authorization'])) {
//       $did_token = Http::parse_authorization_header_value($headers['Authorization']);
// dump($did_token, $headers);
//       // Add your authentication logic using the $did_token here.
//       // You might want to validate the token and authenticate the user.

//       // For demonstration purposes, let's return a JSON response.
//       return new JsonResponse(['message' => 'Authentication successful']);
//     }
//     else {
//       // Authorization header is missing.
//       return new JsonResponse(['error' => 'Authorization header is missing'], 401);
//     }





    // $magic = $this->magic;
    // dump($magic, $this->magic->token);
    $build['content'] = [
      '#attached' => [
        'library' => [
          'magic_user/frontend',
        ],
      ],
      '#markup' => $this->t('It works! issuer: @issuer',['@issuer' => 'leo']),
    ];

    return $build;
  }

}
