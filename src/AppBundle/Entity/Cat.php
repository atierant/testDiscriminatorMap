<?php

namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Cat
 *
 * @ORM\Table(name="cat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CatRepository")
 */
class Cat extends AbstractBaseAnimal
{

}