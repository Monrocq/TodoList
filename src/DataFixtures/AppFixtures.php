<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        /* for ($i = 0; $i < 100; $i++) {
            $task = new Task();
            //$task->setCreatedAt('2019-09-24 00:00:00');
            $task->setTitle('Titre numéro '.$i);
            $task->setContent('Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.');
            $task->isDone(0);
            $manager->persist($task);
        } */
        $user = new User();
        $user->setUsername('test');
        $user->setPassword('$argon2i$v=19$m=65536,t=4,p=1$T3FXSEJkTEZCR2duVjFXZw$08K9eN1c9XoVX6Q5lDhqUoXAwgYniioIVmp3PWkzfIQ');
        $user->setEmail('test@test.fr');
        $user->setRole(1);
        $manager->persist($user);
        $manager->flush();
    }
}
