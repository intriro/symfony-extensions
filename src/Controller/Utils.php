<?php

declare(strict_types=1);

namespace Intriro\Symfony\Controller;

use Intriro\Symfony\Controller\Partial\FormTrait;
use Intriro\Symfony\Controller\Partial\ResponseTrait;
use Intriro\Symfony\Controller\Partial\SecurityTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Controller Utilities Service.
 *
 * Contains most of the helper methods present in the FrameworkBundle base Controller.
 */
class Utils implements ContainerAwareInterface
{
    use ResponseTrait;
    use FormTrait;
    use SecurityTrait;
    use ContainerAwareTrait;
}
