<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AuthController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class AuthController extends AbstractController implements LoggerAwareInterface
{

    use LoggerAwareTrait;

    public const AUTH_MISSING_KEY = 'Some parameters are missing. The request must provide login and password.';
    public const AUTH_NOT_FOUND_USER = 'The provided login does not exist.';
    public const AUTH_INVALID_PASSWORD = 'The provided password in invalid.';

    /**
     * @var UserRepository
     */
    private $entityManager;

    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    public function __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $manager;
        $this->encoder = $encoder;
    }

    /**
     * @Route(path="/auth", name="auth:authenticate", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function authenticate(Request $request): Response
    {
        $login = $request->request->get('login');
        $password = $request->request->get('password');

        if (!isset($login, $password)){
            throw new BadRequestHttpException(self::AUTH_MISSING_KEY);
        }

        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $login]);

        if (!isset($user) || !$user instanceof User){
            throw new NotFoundHttpException(static::AUTH_NOT_FOUND_USER);
        }

        if (!$this->encoder->isPasswordValid($user, $password)){
            throw new AccessDeniedHttpException(static::AUTH_INVALID_PASSWORD);
        }

        $data = array(
            'data' => array(
                'token' => $user->getApiToken()
            ),
        );

        return new JsonResponse($data);
    }
}
