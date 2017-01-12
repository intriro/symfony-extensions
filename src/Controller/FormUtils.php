<?php

declare(strict_types=1);

namespace Intriro\Symfony\Controller;

use Intriro\Symfony\Controller\Partial\FormTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class FormUtils implements ContainerAwareInterface
{
    use FormTrait;
    use ContainerAwareTrait;
}
