<?php


namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [
                'onKernelResponse',
            ],
        ];
    }
    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        // Определил MIME тип для ответа
        $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
    }

}