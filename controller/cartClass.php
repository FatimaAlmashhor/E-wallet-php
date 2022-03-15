<?php
session_start();
include_once  'DBInterface.php';

class Cart
{
    private $lineItems;
    public $totalPrice = 0;
    function __construct($products)
    {
        $this->lineItems = $products;
        // print_r($this->lineItems);
    }
    function setLineItem($lineItem)
    {
        $check = false;
        $index = -1;
        $existProduct = [];
        foreach ($this->lineItems as $key => $product) {
            if ($product['product_id'] == trim($lineItem['product_id'])) {
                $check = true;
                $existProduct = $product;
                $index = $key;
                break;
            }
        }
        if ($check) {
            // increase the qty
            if ($this->lineItems[$index]['qty'] <=  $this->lineItems[$index]['product_qty'])
                $existProduct['qty'] += 1;
            $this->lineItems[$index] = $existProduct;
        } else {
            // give me the product
            // $existProduct = [];
            // foreach ($this->lineItems as $product) {
            //     if ($product['product_id'] == trim($lineItem['product_id'])) {
            //         $existProduct = $product;
            //         break;
            //     }
            // }
            $existProduct = $lineItem;
            if ($this->lineItems[$index]['qty'] <=  $this->lineItems[$index]['product_qty'])
                $existProduct['qty'] = 1;
            else
                $existProduct['qty'] = 0;
            array_push($this->lineItems, $existProduct);
            print_r($this->lineItems);
        }
        $this->getTotlaPrice();
    }
    function increaseItemQty($lineItemId)
    {
        foreach ($this->lineItems as $key => $items) {
            if ($items['qty'] < $items['product_qty'])
                if ($items['product_id'] == $lineItemId) {
                    $this->lineItems[$key]['qty'] += 1;
                }
        }
        $this->getTotlaPrice();
    }
    function descreaseItemQty($lineItemId)
    {
        foreach ($this->lineItems as $key => $items) {
            if ($items['qty'] > 1)
                if ($items['product_id'] == $lineItemId) {
                    $this->lineItems[$key]['qty'] -= 1;
                }
        }
        $this->getTotlaPrice();
    }
    function deleteLineItem($lineItemIndex)
    {
        unset($this->lineItems[$lineItemIndex]);
        $this->getTotlaPrice();
    }
    function getLineItems()
    {
        return  $this->lineItems;
    }
    function getTotlaPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->lineItems as $key => $product) {
            $this->totalPrice += $product['product_price'] * $product['qty'];
        }
    }
}