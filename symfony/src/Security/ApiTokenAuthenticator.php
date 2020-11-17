<?php

namespace App\Security;

use App\Repository\ApiTokenRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    private ApiTokenRepository $apiTokenRepo;
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * ApiTokenAuthenticator constructor.
     * @param ApiTokenRepository $apiTokenRepo
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(ApiTokenRepository $apiTokenRepo, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->apiTokenRepo = $apiTokenRepo;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request): bool
    {
        return $request->headers->has('Authorization')
            && 0 === strpos(
                $request->headers->get('Authorization'),
                'Bearer '
            );
    }

    public function getCredentials(Request $request)
    {
        $authorizationHeader = $request->headers->get('Authorization');

        // skip beyond "Bearer "
        return substr($authorizationHeader, 7);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $this->apiTokenRepo->findOneBy(
            [
                'token' => $credentials,
            ]
        );

        if (!$token) {
            throw new CustomUserMessageAuthenticationException(
                'Invalid API Token'
            );
        }

        if ($token->isExpired()) {
            throw new CustomUserMessageAuthenticationException(
                'Token expired'
            );
        }

        return $token->getUser();
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(
            [
                'message' => $exception->getMessageKey(),
            ], 401
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
    }

    public function start(Request $request, AuthenticationException $authException = null): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => $authException->getMessageKey(),
            ], 401
        );
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }
}
