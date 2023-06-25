<?php

namespace OrderManager\Domain\Customer;

class Email 
{
  private string $address;
  public function __construct(string $address)
  {
    $this->validateMailAddress($address);
    $this->checkIfEmailIsTooShort($address);
    $this->checkIfEmailIsTooLong($address);

    $this->address = $address;
  }

  private function validateMailAddress($address)
  {
    if(filter_var($address, FILTER_VALIDATE_EMAIL) == false){
      throw new \InvalidArgumentException('O endereço de e-mail informado não está completo, informe um endereço de e-mail válido!');
    }
  }

  private function checkIfEmailIsTooShort(string $address)
  {
    $numberOfLetters = strlen($address);
    if($numberOfLetters < 8)
    {
      throw new \InvalidArgumentException('O endereço de e-mail informado é muito curto!');
    }
  }

  public function checkIfEmailIsTooLong(string $address)
  {
    $numberOfLetters = strlen($address);
    if($numberOfLetters > 55)
    {
      throw new \InvalidArgumentException('O endereço de e-mail informado é muito longo!');
    }
  }


  public function __toString()
  {
    return $this->address;
  }
}