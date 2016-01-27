<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeveloperController extends Controller
{
    public function listAction(Request $request)
    {
        $developerProfileCollection = $this->get('rqs.developer.searcher')->search($request->query);

        return new JsonResponse($developerProfileCollection);
    }
}
