<?php
/**
 * Created by PhpStorm.
 * User: morlack
 * Date: 18-4-16
 * Time: 21:13
 */

namespace BlokkrBundle\DataFixtures\ORM;


use BlokkrBundle\Entity\Authentication\BlokkrUser;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadBlokkrUserData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;


    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');

        // Create our user and set details
        $user = $userManager->createUser();
        $user->setUsername('user');
        $user->setEmail('user@blokkr.com');
        $user->setPlainPassword('user');
        $user->setEnabled(true);
//        $user->setRoles(array('ROLE_ADMIN'));

        // Update the user
        $userManager->updateUser($user, true);
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}