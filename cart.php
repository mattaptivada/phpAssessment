<?php 
include __DIR__ . "/interfaces/CartInterface.php";

/*** Products ***
Title       Price

Valheim     19.99
Loop Hero   12.74
Rust        39.99
Hades       24.99
*/

$products = [
    [
        'id' => 1,
        'title' => 'Valheim', 
        'price' => 19.99,
    ],
    [
        'id' => 2,
        'title' => 'Loop Hero',
        'price' => 12.74,
    ],
    [
        'id' => 3,
        'title' => 'Rust',
        'price' => 39.99,
    ],
    [
        'id' => 4,
        'title' => 'Hades',
        'price' => 24.99,
    ],
];

function getProductById($id){
    global $products;
  // return product
    $index = array_search($id, array_column($products, 'id'));
  // throw error if not found
    if ($index !== false) {
        return $products[$index];
    }
    else {
        return false;
    }
}

class Cart implements Interfaces\CartInterface {
    public $items = [];
    
    function addProduct($id, $quantity = 1) {
        $cartIndex = array_search($id, array_column($this->items, 'id'));

        if ($cartIndex !== false) {
            if ($quantity == 1) {
                $this->items[$cartIndex]['quantity'] += $quantity;
            }
            elseif ($quantity > 1) {
                $this->items[$cartIndex]['quantity'] = $quantity;
            } else {
                $this->removeProduct($id);
            }

        } else {
            //add to $items
            $product = getProductById($id);
            $product['quantity'] = $quantity;

            array_push($this->items, $product);
        }
    }

    function removeProduct($id){
        $cartIndex = array_search($id, array_column($this->items, 'id'));

        if ($cartIndex !== false) {
            unset($this->items[$cartIndex]);
        }
    }

    function getTotalPrice(){
        $totalPrice = 0;

        foreach($this->items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return $totalPrice;
    }

    function getTotalItems(){
        $totalItems = 0;

        foreach($this->items as $item) {
            $totalItems += $item['quantity'];
        }

        return $totalItems;
    }

    function printCart(){
        $html = "<table><tr><th>Item</th><th>Quantity</th><th>Total Price</th></tr>";

        foreach($this->items as $item) {
            $html .= "<tr><td>" . $item['title'] . "</td><td>" . $item['quantity'] ."</td><td>" . $item['quantity'] * $item['price'] . "</td></tr>";
        }

        $html .= "</table>";

        return $html;
    }
}



