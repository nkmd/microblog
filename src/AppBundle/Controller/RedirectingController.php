<?php
/**
 * "Редирект"
 * перенаправлять URL-адреса с косой чертой в конце на тот же URL-адрес без косой черты
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RedirectingController extends Controller
{
    /**
     * @Route("/{url}", name="remove_trailing_slash",
     *     requirements={"url" = ".*\/$"})
     */
    public function removeTrailingSlashAction(Request $request)
    {
        // ...

        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();

        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

        // 308 (Permanent Redirect) is similar to 301 (Moved Permanently) except
        // that it does not allow changing the request method (e.g. from POST to GET)
        return $this->redirect($url, 308);

    }
}

