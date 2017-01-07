<?php
declare(strict_types = 1);

namespace Intriro\Symfony\Controller;

use Intriro\Symfony\Controller\Partial\SecurityTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class SecurityUtils implements ContainerAwareInterface
{
    use SecurityTrait;
    use ContainerAwareTrait;
}