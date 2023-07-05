<?php

namespace Test\Domain\Order;

use OrderManager\Domain\Product\Product;
use OrderManager\Domain\Order\OrderProduct;
use OrderManager\Domain\Product\ProductInterface;
use PHPUnit\Framework\TestCase;

class OrderProductTest extends TestCase
{
  private ProductInterface $product;

  protected function setUp(): void
  {
    $this->product = new Product(
      'Teclado F3520',
      'Teclado mecânico fluorescente com entrada USB e cores RGBA em Led.',
        100
    );
  }
  
  public function testProvideProductQuantity()
  {
    $orderProduct = new OrderProduct($this->product, 3.5);
    $this->assertEquals(3.5, $orderProduct->quantity());
    $this->assertEquals(350, $orderProduct->totalAmount());
    $this->assertEquals($this->product->id(), $orderProduct->productId());
  }

  public function testThrowsExceptionIfQuantityIsNonNumeric()
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage('Um valor não numérico foi passado para quantidade do produto ' . $this->product->name() . '!');
    
    $orderProduct = new OrderProduct($this->product, 'abcdefg');
  }

  public function testThrowsExceptionIfQuantityIsEmpty()
  {
    $this->expectException(\DomainException::class);
    $this->expectExceptionMessage('Um valor nulo foi passado para quantidade do produto ' . $this->product->name() . '!');
    
    $orderProduct = new OrderProduct($this->product, '0');
  }
}