<?php

namespace Test\Domain\Customer;

use OrderManager\Domain\Customer\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{

  /**
   * @dataProvider invalidCpfsList
   */
  public function testThrowExceptionWithInvalidCpfs($invalidCpfNumber, $errorMessage)
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage($errorMessage);
    
    new Cpf($invalidCpfNumber);
  }

  public function testValidCpfReturn()
  {
    $cpf = new Cpf('668.498.850-57');
    $this->assertEquals('66849885057', $cpf);
  }

  public static function invalidCpfsList()
  {
    return [
      "EmptyCpf" => ['', 'O CPF deve possuir 11 digitos.'],
      "WithMoreThan11Characters" => ['668.498.850-57-4444', 'O CPF deve possuir 11 digitos.'],
      "withLessThan11Characters" => ['668.498.850-5', 'O CPF deve possuir 11 digitos.'],
      "allDigitsAreEqual" => ['555.555.555-55', 'O CPF informado possui todos os digitos iguais!'],
      "invalidCpf" => ['668.498.850-55', 'O CPF informado não é valido!']
    ];
  }
}