<?php

namespace App\Entity;

use App\Repository\TranscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranscriptionRepository::class)]
class Transcription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $fileid = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $start = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $stop = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $who = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $context = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileid(): ?int
    {
        return $this->fileid;
    }

    public function setFileid(int $fileid): static
    {
        $this->fileid = $fileid;

        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getStop(): ?string
    {
        return $this->stop;
    }

    public function setStop(string $stop): static
    {
        $this->stop = $stop;

        return $this;
    }

    public function getWho(): ?string
    {
        return $this->who;
    }

    public function setWho(string $who): static
    {
        $this->who = $who;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(?string $context): static
    {
        $this->context = $context;

        return $this;
    }
}
