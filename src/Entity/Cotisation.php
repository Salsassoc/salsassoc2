<?php

namespace App\Entity;

use App\Repository\CotisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CotisationRepository::class)]
class Cotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $label = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FiscalYear $fiscalYear = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CotisationType $cotisationType = null;

    #[ORM\OneToMany(mappedBy: 'cotisation', targetEntity: MembershipCotisation::class)]
    private Collection $membershipCotisations;

    public function __construct()
    {
        $this->membershipCotisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getFiscalYear(): ?FiscalYear
    {
        return $this->fiscalYear;
    }

    public function setFiscalYear(?FiscalYear $fiscalYear): self
    {
        $this->fiscalYear = $fiscalYear;

        return $this;
    }

    public function getCotisationType(): ?CotisationType
    {
        return $this->cotisationType;
    }

    public function setCotisationType(?CotisationType $cotisationType): self
    {
        $this->cotisationType = $cotisationType;

        return $this;
    }

    /**
     * @return Collection<int, MembershipCotisation>
     */
    public function getMembershipCotisations(): Collection
    {
        return $this->membershipCotisations;
    }

    public function addMembershipCotisation(MembershipCotisation $membershipCotisation): self
    {
        if (!$this->membershipCotisations->contains($membershipCotisation)) {
            $this->membershipCotisations->add($membershipCotisation);
            $membershipCotisation->setCotisation($this);
        }

        return $this;
    }

    public function removeMembershipCotisation(MembershipCotisation $membershipCotisation): self
    {
        if ($this->membershipCotisations->removeElement($membershipCotisation)) {
            // set the owning side to null (unless already changed)
            if ($membershipCotisation->getCotisation() === $this) {
                $membershipCotisation->setCotisation(null);
            }
        }

        return $this;
    }
}
