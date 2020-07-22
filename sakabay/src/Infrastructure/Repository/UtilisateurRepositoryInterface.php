<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Utilisateur;

/**
 * Interface UtilisateurRepositoryInterface.
 */
interface UtilisateurRepositoryInterface
{
    public function save(Utilisateur $utilisateur): void;

    public function delete(Utilisateur $utilisateur): void;

}
