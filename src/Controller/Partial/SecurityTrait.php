<?php

declare(strict_types=1);

namespace Intriro\Symfony\Controller\Partial;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

trait SecurityTrait
{
    /**
     * @return TokenStorageInterface|null
     *
     * @throws \LogicException If SecurityBundle is not available
     */
    public function getTokenStorage(): ?TokenStorageInterface
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('token_storage');
    }

    /**
     * @return AuthorizationCheckerInterface|null
     *
     * @throws \LogicException If SecurityBundle is not available
     */
    public function getAuthorizationChecker(): ?AuthorizationCheckerInterface
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker');
    }

    /**
     * Checks if the attributes are granted against the current authentication token and optionally supplied object.
     *
     * @param mixed $attributes The attributes
     * @param mixed $object     The object
     *
     * @return bool
     *
     * @throws \LogicException
     */
    public function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

    /**
     * Throws an exception unless the attributes are granted against the current authentication token and optionally
     * supplied object.
     *
     * @param mixed  $attributes The attributes
     * @param mixed  $object     The object
     * @param string $message    The message passed to the exception
     *
     * @throws AccessDeniedException
     */
    public function denyAccessUnlessGranted($attributes, $object = null, $message = 'Access Denied.')
    {
        if (!$this->isGranted($attributes, $object)) {
            $exception = $this->createAccessDeniedException($message);
            $exception->setAttributes($attributes);
            $exception->setSubject($object);

            throw $exception;
        }
    }

    /**
     * Returns an AccessDeniedException.
     *
     * This will result in a 403 response code. Usage example:
     *
     *     throw $this->createAccessDeniedException('Unable to access this page!');
     *
     * @param string          $message  A message
     * @param \Exception|null $previous The previous exception
     *
     * @return AccessDeniedException
     */
    public function createAccessDeniedException($message = 'Access Denied.', \Exception $previous = null)
    {
        return new AccessDeniedException($message, $previous);
    }
}
