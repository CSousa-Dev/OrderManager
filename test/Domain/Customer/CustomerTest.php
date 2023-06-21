<?php

namespace Test\Domain\Customer;

use OrderManager\Domain\Customer\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{

  public function testThrowExceptionIfNameIsEmpty()
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('É necessário informar nome e sobrenome para um cliente.');
    
    new Customer('');
  }

  public function testThrowExceptionIfLastNameIsMissing()
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('É necessário informar nome e sobrenome para um cliente.');

    new Customer('first');
  }

  public function testThrowExceptionIfNameIsTooShort()
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('O nome informado é muito curto!');

    new Customer('xxx xxx');
  }

  public function testThrowExceptionIfNameIsTooLong()
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('O nome informado é muito longo!');

    new Customer('xxx xxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxx');
  }
} 