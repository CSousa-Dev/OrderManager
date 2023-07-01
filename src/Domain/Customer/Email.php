<?php

namespace OrderManager\Domain\Customer;

use OrderManager\Domain\Helpers\DataValidator;

class Email 
{
  private string $address;
  use DataValidator;

  public function __construct(string $address)
  {
    $this->validateMailAddress($address);
    $this->throwExceptionIfStringValueLessThan($address, 8, 'O endereço de e-mail informado é muito curto!');
    $this->throwExceptionIfStringValueGreaterThan($address, 55, 'O endereço de e-mail informado é muito longo!');

    $this->address = $address;
  }

  private function validateMailAddress($address)
  {
    if(filter_var($address, FILTER_VALIDATE_EMAIL) == false){
      throw new \DomainException('O endereço de e-mail informado não está completo, informe um endereço de e-mail válido!');
    }
  }

  public function __toString()
  {
    return $this->address;
  }
}