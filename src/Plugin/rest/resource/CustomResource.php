<?php

namespace Drupal\custom_resource\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Solarium\Exception\HttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "bodeboca_custom_resource_extended:custom_resource",
 *   label = @Translation("Custom resource"),
 *   uri_paths = {
 *     "canonical" = "/custom_resource/{entity}",
 *     "https://www.drupal.org/link-relations/create" = "/custom_resource"
 *   }
 * )
 */
class CustomResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new BodebocaNodeExtended object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('custom_resource'),
      $container->get('current_user')
    );
  }

  /**
   * Responds to GET requests.
   *
   * @param int $entity
   *   Entity id.
   *
   * @return \Drupal\rest\ResourceResponse
   *   a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   *   Throws exception expected.
   */
  public function get($entity) {

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    //  Implements stuff.
    $response = [];

    return new ResourceResponse($response);
  }

  /**
   * Modify a custom_resource.
   */
  public function post($data) {


    // Create stuff.

    // Return an empty value with code 200.
    return new ResourceResponse([], 200);
  }

  /**
   * Remove custom_resource.
   *
   * @param int $entity
   *   Order id.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   204 status if all is ok.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   */
  public function delete($entity) {
       
  }
}
