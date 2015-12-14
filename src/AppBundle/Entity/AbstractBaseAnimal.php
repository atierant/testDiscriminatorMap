<?php
 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
 
 
/**
 * AbstractbaseAnimal
 *
 * @ORM\Table(name="animal_base")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AbstractBaseAnimalRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="animal_type", type="string")
 * @ORM\DiscriminatorMap({
 *    "dog" : "AppBundle\Entity\Dog",
 *    "cat" : "AppBundle\Entity\Cat",
 * })
 * @Serializer\ExclusionPolicy("None")
 * @Serializer\Discriminator(field = "animal_type", map = {
 *    "dog" : "AppBundle\Entity\Dog",
 *    "cat" : "AppBundle\Entity\Cat",
 * })
 */
abstract class AbstractBaseAnimal
{
 
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\SerializedName("batch_id")
     */
    protected $id;

    public function getId() {
    	return $this->id;
    }

}