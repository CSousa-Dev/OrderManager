<?php

namespace Test\Domain\Customer;

use OrderManager\Domain\Customer\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
  private string $validEmailAddress = 'renato@renato.com';
  private string $validCpfNumber = '668.498.850-57';

  /**
   * @dataProvider invalidNamesList
   */
  public function testThrowExceptionIfNameIsInvalid(string $invalidCustomerName, string $errorMessage)
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage($errorMessage);
    new Customer($invalidCustomerName, $this->validEmailAddress, $this->validCpfNumber);
  }

  public function testValidNameReturn()
  {
    $customer = new Customer('Renato Sousa', $this->validEmailAddress, $this->validCpfNumber);
    $formatedCpf = preg_replace('/[.-]/', '' , $this->validCpfNumber);

    $this->assertEquals('Renato Sousa', $customer->name());
    $this->assertEquals($this->validEmailAddress, $customer->email());
    $this->assertEquals($formatedCpf, $customer->cpf());
  }

  public static function invalidNamesList()
  {
    return  [
      "EmptyName" => ['', 'É necessário informar nome e sobrenome para um cliente.'],
      "MissingLastName" => ['Renato', 'É necessário informar nome e sobrenome para um cliente.'],
      "TooShortName" => ['Ren ato', 'O nome informado é muito curto!'],
      "TooLongName" => ['xxx xxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx', 'O nome informado é muito longo!']
    ];
  }
} 