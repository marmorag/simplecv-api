<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
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
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1200)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
