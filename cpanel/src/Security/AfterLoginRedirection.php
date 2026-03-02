<?php

/**
 * @copyright  Copyright (c) 2009-2014 Steven TITREN - www.webaki.com
 * @package    Webaki\UserBundle\Redirection
 * @author     Steven Titren <contact@webaki.com>
 */

namespace App\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

    /**
     * @param RouterInterface $router
     */
    public function __construct(private RouterInterface $router, private Security $security) {}

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
    {
        // Get list of roles for current user
        $roles = $token->getRoleNames();
        // If is a admin or super admin we redirect to the backoffice area
        if (in_array('ROLE_ADMIN', $roles, true) || in_array('ROLE_SUPER_ADMIN', $roles, true))
            $redirection = new RedirectResponse($this->router->generate('admin_home'));
        // otherwise, if is a commercial user we redirect to the crm area
        elseif (in_array('ROLE_USER', $roles, true))
            $redirection = new RedirectResponse($this->router->generate('user_home'));
        // otherwise we redirect user to the member area
        else
            $redirection = new RedirectResponse($this->router->generate('app_home'));

        return $redirection;
    }

    public function authenticatedUserHomePath()
    {
        $roles = $this->security->getToken()->getRoleNames();
        // If is a admin or super admin we redirect to the backoffice area
        if (in_array('ROLE_ADMIN', $roles, true) || in_array('ROLE_SUPER_ADMIN', $roles, true))
            $path = $this->router->generate('admin_home');
        // otherwise, if is a commercial user we redirect to the crm area
        elseif (in_array('ROLE_USER', $roles, true))
            $path = $this->router->generate('user_home');
        // otherwise we redirect user to the member area
        else
            $path = $this->router->generate('app_home');

        return $path;
    }
}
