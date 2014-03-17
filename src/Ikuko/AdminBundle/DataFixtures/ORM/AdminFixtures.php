<?php

namespace Ikuko\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ikuko\AdminBundle\Entity\Admin;


/**
 * Description of AdminFixtures
 *
 * @author laptop1
 */
class AdminFixtures extends AbstractFixture implements ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $admin = new Admin();

        $admin->setLogin('admincris');
        $admin->setSalt(md5(time()));
        $encoder = $this->container->get('security.encoder_factory')
                ->getEncoder($admin);
        $passwordOriginal = 'dundee2014';
        $passwordCodificat = $encoder->encodePassword(
                $passwordOriginal, $admin->getSalt()
        );
        $admin->setPassword($passwordCodificat);

        $manager->persist($admin);

        $manager->flush();
    }

}
