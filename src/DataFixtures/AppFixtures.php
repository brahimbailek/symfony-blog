<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = [];
        $categories = [];

        for ($i = 0; $i < 50; $i++) {
            //creation d'un user
            $user = new User();
            // utilisation des setters pour lui affecter des valeurs
            $user->setUsername($faker->name)
                ->setFirstname($faker->firstname)
                ->setLastname($faker->lastname)
                ->setEmail($faker->email)
                ->setPassword($faker->password)
                // on utilise \DateTime parce que c'est pas un objet que nous avons instancié, c un objet natif de PHP
                ->setCreatedAt(new \DateTime);

            // enregistrer les données coté PHP
            $manager->persist($user);

            $users[] = $user;
        }

        for ($i = 0; $i < 15; $i++) {
            $categorie = new Category();
            $categorie->setTitle($faker->text(50))->setDescription($faker->text(250))->setImage($faker->imageUrl());
            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        for ($i = 0; $i < 100; $i++) {

            $article = new Article();

            $article->setTitle($faker->text(50))
                ->setContent($faker->text(6000))
                ->setImage($faker->imageUrl())
                ->setCreatedAt(new \DateTime)

                ->addCategory($categories[$faker->numberBetween(0, 14)])
                //                               $categories [  12   ]   ==> objet de type categ

                ->setAuthor($users[$faker->numberBetween(0, 49)]);

            $manager->persist($article);

            //  $categories :        [   0 : new Category(),     1 : new Category(),  2 :  new Category(),   ...    14: new Category()    ]
            //   $users  [ 0 : new user(), 1 : new user(), 2 : new user, ....  49: new user]
        }


        $manager->flush();
    }
}
