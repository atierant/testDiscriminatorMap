<?php

namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Dog
 *
 * @ORM\Table(name="dog")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DogRepository")
 */
class Dog extends AbstractBaseAnimal
{
	/*
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * Serializer\SerializedName("id")
     */
	//private $id;
}