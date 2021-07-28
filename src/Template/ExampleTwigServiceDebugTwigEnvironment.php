<?php

namespace Drupal\example_twig_service_debug\Template;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\State\StateInterface;
use Drupal\Core\Template\TwigEnvironment;

/**
 * An example of service that decorates the Drupal core twig service.
 */
class ExampleTwigServiceDebugTwigEnvironment extends TwigEnvironment {

  /**
   * The logger channel for this module.
   *
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected $logger;

  /**
   * Constructs a TwigEnvironment object and stores cache and storage
   * internally.
   *
   * @param LoggerChannelFactoryInterface $logger_factory
   *   The logger factory service.
   * @param string $root
   *   The app root.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache
   *   The cache bin.
   * @param string $twig_extension_hash
   *   The Twig extension hash.
   * @param \Drupal\Core\State\StateInterface $state
   *   The state service.
   * @param \Twig_LoaderInterface $loader
   *   The Twig loader or loader chain.
   * @param array $options
   *   The options for the Twig environment.

   */
  public function __construct(LoggerChannelFactoryInterface $logger_factory, $root, CacheBackendInterface $cache, $twig_extension_hash, StateInterface $state, \Twig_LoaderInterface $loader = NULL, array $options = []) {
    parent::__construct($root, $cache, $twig_extension_hash, $state, $loader, $options);
    $this->logger = $logger_factory->get('example_twig_service_debug');
  }

  /**
   * Invalidates all compiled Twig templates.
   *
   * @see \drupal_flush_all_caches
   */
  public function invalidate() {
    // Set parameters in debug_backtrace() as necessary to avoid OOM errors.
    $this->logger->debug(print_r(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10), TRUE));
    parent::invalidate();
  }

}
