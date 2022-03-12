<?php
session_start();
include_once  'DBInterface.php';

class Cart
{
    private $lineItems;
    function __construct($products)
    {
        $this->lineItems = $products;
        print_r($this->lineItems);
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
            $existProduct['qty'] = 1;
            array_push($this->lineItems, $existProduct);
            print_r($this->lineItems);
        }
    }
    function increaseItemQty($lineItemId)
    {
        foreach ($this->lineItems as $key => $items) {
            if ($items['product_id'] == $lineItemId) {
                $this->lineItems[$key]['qty'] += 1;
            }
        }
    }
    function getLineItems()
    {
        return  $this->lineItems;
    }
}