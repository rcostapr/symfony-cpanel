<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'There is already an module with this name')]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(type: 'integer', options: ['default' => null])]
    private ?int $menuid = null;

    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    private int $menuorder = 1;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getMenuid(): int
    {
        return $this->menuid;
    }

    public function setMenuid(int $menuid): static
    {
        $this->menuid = $menuid;

        return $this;
    }

    public function getMenuorder(): int
    {
        return $this->menuorder;
    }

    public function setMenuorder(int $menuorder): static
    {
        $this->menuorder = $menuorder;

        return $this;
    }
}
