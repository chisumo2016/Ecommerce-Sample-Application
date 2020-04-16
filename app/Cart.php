<?php

namespace App;

class Cart
{
    public  $items =null;  //group of products
    public  $totalQty = 0;
    public  $totalPrice = 0;

    public  function  __construct($oldCart)
    {
        if($oldCart){
            $this->items        = $oldCart->items;
            $this->totalQty     = $oldCart->totalQty;
            $this->totalPrice   = $oldCart->totalPrice;
        }
    }

    public  function  add($item, $id)
    {
        $storeItem = [
             'qty'      => 0,
            'price'     => $item->price,
             'item'      => $item
        ];

        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storeItem = $this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['price'] =  $item->price * $storeItem['qty'];
        $this->items[$id] = $storeItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public  function  reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price']-= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice  -= $this->items[$id]['item']['price'];

        //check if items is 0
        if ($this->items[$id]['qty'] <= 0){
            //remove from the card
            unset($this->items[$id]);
        }
    }

    public  function  removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];;
        $this->totalPrice  -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}

