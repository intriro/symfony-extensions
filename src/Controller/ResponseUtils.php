<?php
declare(strict_types = 1);

namespace Intriro\Symfony\Controller;

use Intriro\Symfony\Controller\Partial\ResponseTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class ResponseUtils implements ContainerAwareInterface
{
    use ResponseTrait;
    use ContainerAwareTrait;
}