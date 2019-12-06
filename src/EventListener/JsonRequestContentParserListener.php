<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class JsonRequestContentParserListener {

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getContent() && in_array($request->getContentType(), ['json', 'application/json'])) {

            $data = json_decode($request->getContent(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new BadRequestHttpException('Invalid json body : ' . json_last_error_msg());
            }

            $request->request->replace(is_array($data) ? $data : array());
        }
    }
}
