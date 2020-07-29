<?php

namespace App\Entity;

use App\Repository\ChannelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChannelRepository::class)
 */
class Channel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var string $name
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false, options={"default": 168})
     * Value is in hours
     */
    private $vodValidity = 14;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $cdnLabel;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=100, nullable=true, name="cdn_stream_resource_url")
     */
    private $cdnStreamResourceUrl;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $cdnSecureToken;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Return hours which mean how long we can play channel as VOD after channel is finished
     *
     * @return int
     */
    public function getVodValidity(): int
    {
        return $this->vodValidity;
    }

    /**
     * @param int $vodValidity
     */
    public function setVodValidity(int $vodValidity): void
    {
        $this->vodValidity = $vodValidity;
    }

    /**
     * @return string|null
     */
    public function getCdnLabel(): ?string
    {
        return $this->cdnLabel;
    }

    /**
     * @param string|null $cdnLabel
     */
    public function setCdnLabel(?string $cdnLabel): void
    {
        $this->cdnLabel = $cdnLabel;
    }

    /**
     * @return string|null
     */
    public function getCdnStreamResourceUrl(): ?string
    {
        return $this->cdnStreamResourceUrl;
    }

    /**
     * @param string|null $cdnStreamResourceUrl
     */
    public function setCdnStreamResourceUrl(?string $cdnStreamResourceUrl): void
    {
        $this->cdnStreamResourceUrl = $cdnStreamResourceUrl;
    }

    /**
     * @return string|null
     */
    public function getCdnSecureToken(): ?string
    {
        return $this->cdnSecureToken;
    }

    /**
     * @param string|null $cdnSecureToken
     */
    public function setCdnSecureToken(?string $cdnSecureToken): void
    {
        $this->cdnSecureToken = $cdnSecureToken;
    }

}
