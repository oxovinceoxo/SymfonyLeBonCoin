<?php

namespace App\Entity;

use App\Repository\RegionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionsRepository::class)
 */
class Regions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomRegion;

    /**
     * @return mixed
     */
    public function getNomRegion()
    {
        return $this->nomRegion;
    }

    /**
     * @param mixed $nomRegion
     */
    public function setNomRegion($nomRegion): void
    {
        $this->nomRegion = $nomRegion;
    }


    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="region")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCategories(): ?string
    {
        return $this->Categories;
    }

    public function setCategories(string $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setRegion($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getRegion() === $this) {
                $article->setRegion(null);
            }
        }

        return $this;
    }
}
