<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Contrat;
use App\Entity\Enfant;
use App\Entity\Mission;
use App\Entity\UParent;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    
    public function load(ObjectManager $manager): void
    {
        $parent = new  User();
        $parent->setFirstName('TestParent');
        $parent->setLastName('TestParent');
        $parent->setEmail('parent');
        $parent->setPassword($this->userPasswordHasherInterface->hashPassword($parent, 'parent'));
        $parent->setRoles(['parent']);
        $manager->persist($parent);

        $enfant = new User();
        $enfant->setFirstName('TestEnfant');
        $enfant->setLastName('TestEnfant');
        $enfant->setEmail('enfant');
        $enfant->setPassword($this->userPasswordHasherInterface->hashPassword($enfant, 'enfant'));
        $enfant->setParent($parent);
        $enfant->setRoles(['enfant']);
        $manager->persist($enfant);

        for ($i=0; $i < 3; $i++) {
            $enfant = new User();
            $enfant->setFirstName('TestEnfant' . $i);
            $enfant->setLastName('TestEnfant' . $i);
            $enfant->setEmail('enfant@email' . $i . '.com');
            $enfant->setPassword($this->userPasswordHasherInterface->hashPassword($enfant, 'enfant' . $i));
            $enfant->setParent($parent);
            $enfant->setRoles(['enfant']);
            $manager->persist($enfant);
        }

        $contrat = new Contrat();
        $contrat->setSignatureParent(true);
        $contrat->setSignatureEnfant(true);
        $manager->persist($contrat);

        $categorie = new Categorie();
        $categorie->setNom('CategorieTest');
        $categorie->setCouleur('#FF5733');
        $manager->persist($categorie);

        for ($i=0; $i < 10; $i++) {
            $mission = new Mission();
            $mission->setTitre('Test Mission' . $i);
            $mission->setKins(random_int(1, 100));
            $mission->setEtat('Etat' . $i);
            $mission->setEvaluation('Evaluation: ' . $i);
            $mission->setCategorie($categorie);
            $manager->persist($mission);
            $mission ->addUser($enfant);
        }
        $manager->flush();
    }
}
