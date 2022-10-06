<?php

namespace App\Entity;

use App\Repository\MembershipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipRepository::class)]
class Membership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'memberships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Member $member = null;

    #[ORM\Column(length: 100)]
    private ?string $lastname = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;

    #[ORM\Column]
    private ?int $gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(nullable: true)]
    private ?int $zipcode = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $phonenumber = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $phonenumber2 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $allowImageRights = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $membershipDate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MembershipType $membershipType = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FiscalYear $fiscalYear = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comments = null;

    #[ORM\OneToMany(mappedBy: 'membership', targetEntity: MembershipCotisation::class)]
    private Collection $membershipCotisations;

    public function __construct()
    {
        $this->membershipCotisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?member
    {
        return $this->member;
    }

    public function setMember(?member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(?int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getPhonenumber2(): ?string
    {
        return $this->phonenumber2;
    }

    public function setPhonenumber2(?string $phonenumber2): self
    {
        $this->phonenumber2 = $phonenumber2;

        return $this;
    }

    public function isAllowImageRights(): ?bool
    {
        return $this->allowImageRights;
    }

    public function setAllowImageRights(?bool $allowImageRights): self
    {
        $this->allowImageRights = $allowImageRights;

        return $this;
    }

    public function getMembershipDate(): ?\DateTimeInterface
    {
        return $this->membershipDate;
    }

    public function setMembershipDate(\DateTimeInterface $membershipDate): self
    {
        $this->membershipDate = $membershipDate;

        return $this;
    }

    public function getMembershipType(): ?MembershipType
    {
        return $this->membershipType;
    }

    public function setMembershipType(?MembershipType $membershipType): self
    {
        $this->membershipType = $membershipType;

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

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

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
            $membershipCotisation->setMembership($this);
        }

        return $this;
    }

    public function removeMembershipCotisation(MembershipCotisation $membershipCotisation): self
    {
        if ($this->membershipCotisations->removeElement($membershipCotisation)) {
            // set the owning side to null (unless already changed)
            if ($membershipCotisation->getMembership() === $this) {
                $membershipCotisation->setMembership(null);
            }
        }

        return $this;
    }
}
