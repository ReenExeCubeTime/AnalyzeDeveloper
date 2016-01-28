<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class FilterController extends Controller
{
    public function listAction()
    {
        return new JsonResponse(
            $this->get('rqs.developer.profile.parameter')->getFilter()
        );
    }
}
