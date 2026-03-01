<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $email = $form->getData()->getEmail();
            $username = preg_replace('/([^@]*).*/', '$1', $email);
            $user->setUsername($username);

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            //$this->emailVerifier->sendEmailConfirmation(
            //    'app_verify_email',
            //    $user,
            //    (new TemplatedEmail())
            //        ->from(new Address('root@neoamd.myfeup.com', 'Cpanel Admin'))
            //        ->to($user->getEmail())
            //        ->subject('Please Confirm your Email')
            //        ->htmlTemplate('registration/confirmation_email.html.twig')
            //);
            // do anything else you need here, like send an email

            $this->addFlash('success', 'Your registration was successful. You may now proceed to log in using your email and password.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/verify-email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }


    #[Route(path: '/recovery', name: 'app_recovery')]
    public function recovery(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserRepository $db): Response
    {

        $user = new User();
        $form = $this->createFormBuilder(
            $user,
            [
                'attr' => [
                    'class' => 'login-form',
                    'id' => 'loginForm',
                    'novalidate' => true
                ]
            ]
        )
            ->setAction($this->generateUrl('app_recovery'))
            ->setMethod('POST')
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'row_attr' => [
                    'class' => 'input-wrapper',
                ],
                'attr' => [
                    'autocomplete' => 'email',
                    'autofocus' => false,
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a email',
                    ]),
                    new Email(),
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            // Form is invalid for sure
            if (!$form->isValid()) {
                $violations = $form['email']->getErrors();
                foreach ($violations as $error) {
                    if ("There is already an account with this email" !== $error->getMessage()) {
                        return $this->render('registration/recovery.html.twig', [
                            'recoveryForm' => $form,
                        ]);
                    }
                }
            }

            $userEmail = $form->getData()->getEmail();

            // Check if user exist
            $user = $db->loadUserByIdentifier($userEmail);

            if (is_null($user)) {
                $this->addFlash('warning', 'User not found on our system.');
                return $this->redirectToRoute('app_login');
            }

            // TODO: Generate a recovery url and email it to the user
            //$this->emailVerifier->sendEmailConfirmation(
            //    'app_recovery_password',
            //    $user,
            //    (new TemplatedEmail())
            //        ->from(new Address('root@neoamd.myfeup.com', 'Cpanel Admin'))
            //        ->to($user->getEmail())
            //        ->subject('Please Confirm your Email')
            //        ->htmlTemplate('registration/confirmation_email.html.twig')
            //);

            $this->addFlash('success', 'The recovery link was successfully sent. You may now check your email and follow the link to set a new password.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/recovery.html.twig', [
            'recoveryForm' => $form,
        ]);
    }
}
