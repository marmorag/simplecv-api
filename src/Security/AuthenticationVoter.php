<?php
declare(strict_types=1);

namespace App\Security;


use App\Repository\UserRepository;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AuthenticationVoter extends Voter implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public const VIEW = 'auth_view';

    private $request;
    private $userRepository;

    public function __construct(RequestStack $requestStack, UserRepository $userRepository)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->userRepository = $userRepository;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports(string $attribute, $subject): bool
    {
        return $attribute === static::VIEW;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param mixed $subject
     *
     * @return bool
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        if (!$this->request->headers->has('X-AUTH-TOKEN')) {
            $this->logger->debug('no auth token provided');
            return false;
        }

        $apiToken = $this->request->headers->get('X-AUTH-TOKEN');
        $this->logger->debug(sprintf('found auth token : %s', $apiToken));

        $user = $this->userRepository->getByApiToken($apiToken);

        $this->logger->debug(print_r($user, true));

        return $user !== null;
    }
}