<?php

namespace Drupal\biography_subdomain;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

/**
 * Provides a MyModuleSubscriber.
 */
class BiographySubdomainRedirect implements EventSubscriberInterface {

  /**
   * @see Symfony\Component\HttpKernel\KernelEvents for details
   *
   * @param Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   The Event to process.
   */
  public function checkRedirectBiographySubdomain(GetResponseEvent $event) {
    if ($event->getRequest()->getHost() !== 'biography.id') {
        $event->setResponse(new TrustedRedirectResponse('https://biography.id/'));
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkRedirectBiographySubdomain', 2000);
    return $events;
  }
}
