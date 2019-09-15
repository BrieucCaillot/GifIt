<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteRepository")
 */
class Favorite
{

    use EntityTrait;
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gif", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gif;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGif(): ?Gif
    {
        return $this->gif;
    }

    public function setGif(?Gif $gif): self
    {
        $this->gif = $gif;

        return $this;
    }
}
