<?php

namespace Drupal\biography_subdomain;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
  public function checkRedirect(GetResponseEvent $event) {
    if ($event->getRequest()->getHost() !== 'biography.id') {
        $event->setResponse(new TrustedRedirectResponse('http://biography.id/'));
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkRedirect', 20);
    return $events;
  }
}
