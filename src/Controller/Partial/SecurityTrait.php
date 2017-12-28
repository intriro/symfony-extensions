<?php

declare(strict_types=1);

namespace Intriro\Symfony\Controller\Partial;

use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @property ContainerInterface $container
 */
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
     * Checks if the attributes are granted against the current authentication token and optionally supplied subject.
     *
     * @throws \LogicException
     *
     * @final since version 3.4
     */
    public function isGranted($attributes, $subject = null): bool
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $subject);
    }

    /**
     * Throws an exception unless the attributes are granted against the current authentication token and optionally
     * supplied subject.
     *
     * @throws AccessDeniedException
     *
     * @final since version 3.4
     */
    public function denyAccessUnlessGranted($attributes, $subject = null, string $message = 'Access Denied.')
    {
        if (!$this->isGranted($attributes, $subject)) {
            $exception = $this->createAccessDeniedException($message);
            $exception->setAttributes($attributes);
            $exception->setSubject($subject);

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
     * @final since version 3.4
     */
    public function createAccessDeniedException(string $message = 'Access Denied.', \Exception $previous = null): AccessDeniedException
    {
        return new AccessDeniedException($message, $previous);
    }
}
