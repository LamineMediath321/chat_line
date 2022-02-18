<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;

/**
 ** @ORM\Table(name="`messages`")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recepteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emmeteur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     */
    private $recepteur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmmeteur(): ?User
    {
        return $this->emmeteur;
    }

    public function setEmmeteur(?User $emmeteur): self
    {
        $this->emmeteur = $emmeteur;

        return $this;
    }

    public function getRecepteur(): ?User
    {
        return $this->recepteur;
    }

    public function setRecepteur(?User $recepteur): self
    {
        $this->recepteur = $recepteur;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
}
