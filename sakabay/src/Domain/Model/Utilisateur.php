<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    /**
     * @var string
     */
    const PREFIX_ROLE = 'ROLE_';


    private $id;

    /**
     * @var string|null
     *
     */
    private $firstName;

    /**
     * @var string|null
     *
     */
    private $nom;

    /**
     * @var string|null
     *
     */
    private $plainPassword;

    /**
     * @var string|null
     *
     */
    private $lastName;

    /**
     * @var string|null
     *
     */
    private $prenom;

    /**
     */
    private $email;


    /**
     */
    private $login;

    /**
     *
     */
    private $roles = [];

    /**
     * @var string The hashed password
     *
     */
    private $password;

    /**
     * @var Group[]
     *
     */
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $name): self
    {
        $this->firstName = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $name): self
    {
        $this->lastName = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UtilisateurInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UtilisateurInterface
     */
    public function getSalt()
    {
        // not needed when using the "auto" algorithm in security.yaml
    }

    /**
     * @see UtilisateurInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of nom
     *
     * @return  string|null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  string|null  $nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return  string|null
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param  string|null  $prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of plainPassword
     *
     * @return  string|null
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @param  string|null  $plainPassword
     *
     * @return  self
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $this->addRolesOfGroup($group);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
            $this->updateRoles();
        }

        return $this;
    }

    /**
     * Return the security roles of the users. Security roles are the user's functions.
     * Return an array of all user's functions in uppercase prefixed by 'ROLE_'. This
     * array does not contain duplication.
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        $securityRoles = [];

        foreach ($this->getGroups() as $group) {
            foreach ($group->getRoles() as $role) {
                foreach ($role->getFonctions() as $fonction) {
                    $securityRoleName = Utilisateur::PREFIX_ROLE . mb_strtoupper($fonction->getLbCode());
                    $securityRoles[] = $securityRoleName;
                }
            }
        }
        // if ($this->getDefaultRole()) {
        //     foreach ($this->getDefaultRole()->getFonctions() as $fonction) {
        //         $securityRoleName = Utilisateur::PREFIX_ROLE.mb_strtoupper($fonction->getLbCode());
        //         $securityRoles[] = $securityRoleName;
        //     }
        // }

        return array_values(array_unique($securityRoles));
    }

    /**
     * Called when a group is added to the user.
     * Add the functions of the group to the user's security roles.
     */
    private function addRolesOfGroup($group): void
    {
        foreach ($group->getRoles() as $role) {
            foreach ($role->getFonctions() as $fonction) {
                $securityRoleName = Utilisateur::PREFIX_ROLE . mb_strtoupper($fonction->getLbCode());
                if (!in_array($securityRoleName, $this->roles)) {
                    $this->roles[] = $securityRoleName;
                }
            }
        }
    }

    /**
     * Called when a group is deleted from the groups list.
     * Remove the roles from this group which were not in other groups of the user.
     */
    private function updateRoles(): void
    {
        $tmpRoles = [];
        foreach ($this->getGroups() as $group) {
            foreach ($group->getRoles() as $role) {
                foreach ($role->getFonctions() as $fonction) {
                    $securityRoleName = User::PREFIX_ROLE . mb_strtoupper($fonction->getLbCode());
                    $tmpRoles[] = $securityRoleName;
                }
            }
        }
        $this->roles = array_values(array_unique($tmpRoles));
    }
}
