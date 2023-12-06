<?php
/**
 *  #### Redirect if Route Not Found ####
 *  (см. service.yml)
 */
    namespace AppBundle\Controller;

    use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    class ErrorRedirectController
    {
      public function onKernelException(GetResponseForExceptionEvent $event)
      {
          $exception = $event->getException();

          if ($exception instanceof NotFoundHttpException) {
              // redirect to '/' router or '/error'
              //$event->setResponse(...........);
              header("Location: /404");
              exit;
          }
      }
    }