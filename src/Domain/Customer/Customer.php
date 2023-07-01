<?php

namespace OrderManager\Domain\Customer;
use OrderManager\Domain\Customer\{Cpf, Email};
use OrderManager\Domain\Helpers\DataValidator;

class Customer 
{
  use DataValidator;

  private string $name;
  private Cpf $cpf;
  private Email $email;

  public function __construct(string $name, string $emailAddress, string $cpf)
  {
    $this->validateName($name);
    $this->cpf = new Cpf($cpf);
    $this->email = new Email($emailAddress);
    $this->name = $name;
  }

  private function validateName(string $name)
  {
    $this->throwExceptionIfValueIsEmpty($name, 'É necessário informar nome e sobrenome para um cliente.');
    $this->checkIfLastNameIsMissing($name);
    $this->throwExceptionIfStringValueLessThan($name, 8, 'O nome informado é muito curto!');
    $this->throwExceptionIfStringValueGreaterThan($name, 55, 'O nome informado é muito longo!');
  }

  private function checkIfLastNameIsMissing(string $name)
  {
    $numberOfWords = count(explode(' ', $name));
    if($numberOfWords < 2)
    {
      throw new \DomainException('É necessário informar nome e sobrenome para um cliente.');
    }
  }

  public function name()
  {
    return $this->name;
  }

  public function email()
  {
    return $this->email;
  }

  public function cpf()
  {
    return $this->cpf;
  }
}