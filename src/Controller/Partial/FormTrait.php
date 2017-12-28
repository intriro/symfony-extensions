<?php

declare(strict_types=1);

namespace Intriro\Symfony\Controller\Partial;

use Psr\Container\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

/**
 * @property ContainerInterface $container
 */
trait FormTrait
{
    /**
     * Creates and returns a Form instance from the type of the form.
     *
     * @final since version 3.4
     */
    public function createForm(string $type, $data = null, array $options = []): FormInterface
    {
        return $this->container->get('form.factory')->create($type, $data, $options);
    }

    /**
     * Creates and returns a form builder instance.
     *
     * @final since version 3.4
     */
    public function createFormBuilder($data = null, array $options = []): FormBuilderInterface
    {
        return $this->container->get('form.factory')->createBuilder(FormType::class, $data, $options);
    }
}
