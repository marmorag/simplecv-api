<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Skill
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ApiResource(
 *     collectionOperations={
 *         "get"={},
 *         "post"={"access_control"="is_granted('auth_view')"}
 *     },
 *     itemOperations={
 *          "get"={},
 *          "put"={"access_control"="is_granted('auth_view')"},
 *          "delete"={"access_control"="is_granted('auth_view')"}
 *     }
 * )
 */
class Skills
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Your level cant be under {{ limit }}",
     *      maxMessage = "Hmm, seems too high, try under {{ limit }}"
     * )
     */
    private $level;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}