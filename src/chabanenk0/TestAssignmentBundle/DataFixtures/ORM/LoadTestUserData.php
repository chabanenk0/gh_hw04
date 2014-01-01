<?php

namespace chabanenk0\TestAssignmentBundle\DataFixtures\ORM;;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use chabanenk0\TestAssignmentBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class LoadTestUserData implements FixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        public function load(ObjectManager $manager)
        {
            $user=new User();
            $user->setName("First");
            $user->setNick("FirstUser");
            $user->setPasswd("111");
            $user->setEmail("u1@mail.ru");
            $manager->persist($user);
            $manager->flush();
        }
    }

?>