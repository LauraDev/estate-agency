<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=2, max=100)
   */
  private $firstname;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=2, max=100)
   */
  private $lastname;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Regex(
   * pattern="/[0-9]{10}/"
   * )
   */
  private $phone;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Email()
   */
  private $mail;

  /**
   * @var string|null
   * @Assert\NotBlank()
   * @Assert\Length(min=10)
   */
  private $message;

  /**
   * @var Property|null
   */
  private $property;


  /**
   * Get the value of firstname
   *
   * @return  string|null
   */ 
  public function getFirstname(): ?string
  {
    return $this->firstname;
  }

  /**
   * Set the value of firstname
   *
   * @param  string|null  $firstname
   *
   * @return  self
   */ 
  public function setFirstname($firstname): self
  {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get the value of lastname
   *
   * @return  string|null
   */ 
  public function getLastname(): ?string
  {
    return $this->lastname;
  }

  /**
   * Set the value of lastname
   *
   * @param  string|null  $lastname
   *
   * @return  self
   */ 
  public function setLastname($lastname): self
  {
    $this->lastname = $lastname;

    return $this;
  }

  /**
   * Get pattern="/[0-9]{10/"}
   *
   * @return  string|null
   */ 
  public function getPhone(): ?string
  {
    return $this->phone;
  }

  /**
   * Set pattern="/[0-9]{10/"}
   *
   * @param  string|null  $phone  pattern="/[0-9]{10/"}
   *
   * @return  self
   */ 
  public function setPhone($phone): self
  {
    $this->phone = $phone;

    return $this;
  }

  /**
   * Get the value of mail
   *
   * @return  string|null
   */ 
  public function getMail(): ?string
  {
    return $this->mail;
  }

  /**
   * Set the value of mail
   *
   * @param  string|null  $mail
   *
   * @return  self
   */ 
  public function setMail($mail): self
  {
    $this->mail = $mail;

    return $this;
  }

  /**
   * Get the value of message
   *
   * @return  string|null
   */ 
  public function getMessage(): ?string
  {
    return $this->message;
  }

  /**
   * Set the value of message
   *
   * @param  string|null  $message
   *
   * @return  self
   */ 
  public function setMessage($message): self
  {
    $this->message = $message;

    return $this;
  }

  /**
   * Get the value of property
   *
   * @return  Property|null
   */ 
  public function getProperty(): ?Property
  {
    return $this->property;
  }

  /**
   * Set the value of property
   *
   * @param  Property|null  $property
   *
   * @return  self
   */ 
  public function setProperty($property): self
  {
    $this->property = $property;

    return $this;
  }
}
