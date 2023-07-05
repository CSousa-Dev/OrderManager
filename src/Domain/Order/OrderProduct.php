<?php 

namespace OrderManager\Domain\Order;

use OrderManager\Domain\Helpers\DataValidator;
use OrderManager\Domain\Product\ProductInterface;

class OrderProduct
{
  use DataValidator;
  private ProductInterface $product;
  private string $quantity;

  public function __construct(ProductInterface $product, string $quantity)
  {
    $this->product = $product;

    $this->validateQuantity($quantity);
    $this->quantity = $quantity;
  }

  private function validateQuantity($quantity): void
  {
    $this->throwExceptionIfValueIsNotNumeric($quantity, 'Um valor não numérico foi passado para quantidade do produto ' . $this->product->name() . '!');
    $this->throwExceptionIfValueIsEmpty($quantity, 'Um valor nulo foi passado para quantidade do produto ' . $this->product->name() . '!');

  }

  public function productId(): string
  {
    return $this->product->id();
  }

  public function quantity(): string
  {
    return $this->quantity;
  }

  public function totalAmount(): string
  {
    $productPrice = $this->product->price();
    return bcmul($productPrice, $this->quantity);
  }
}