<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: Pop::class)]
    private Collection $pops;

    public function __construct()
    {
        $this->pops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Pop>
     */
    public function getPops(): Collection
    {
        return $this->pops;
    }

    public function addPop(Pop $pop): static
    {
        if (!$this->pops->contains($pop)) {
            $this->pops->add($pop);
            $pop->setSerie($this);
        }

        return $this;
    }

    public function removePop(Pop $pop): static
    {
        if ($this->pops->removeElement($pop)) {
            // set the owning side to null (unless already changed)
            if ($pop->getSerie() === $this) {
                $pop->setSerie(null);
            }
        }

        return $this;
    }
}
