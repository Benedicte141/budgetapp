<?php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof \App\Entity\User) {
            return;
        }

        if (!$user->isVerified()) {
            // Empêche la connexion si l'email n'est pas vérifié
            throw new CustomUserMessageAuthenticationException('Votre email doit être vérifié avant de pouvoir vous connecter.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        // Vous pouvez ajouter d'autres vérifications si nécessaire
    }
}
