<?php
class Invoice {
    private $items;

    public function __construct($items) {
        $this->items = $items;
    }

    public function calculateTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function printInvoice() {
        echo "Items:\n";
        foreach ($this->items as $item) {
            echo $item['name'] . " - " . $item['quantity'] . " x " . $item['price'] . "\n";
        }
        echo "Total: " . $this->calculateTotal() . "\n";
    }

    public function saveToFile($filename) {
        $file = fopen($filename, 'w');
        fwrite($file, "Items:\n");
        foreach ($this->items as $item) {
            fwrite($file, $item['name'] . " - " . $item['quantity'] . " x " . $item['price'] . "\n");
        }
        fwrite($file, "Total: " . $this->calculateTotal() . "\n");
        fclose($file);
    }
}
// Contoh data item
$items = [
    ['name' => 'Gaming Laptop', 'quantity' => 1, 'price' => 2000],
    ['name' => 'Gaming Mouse', 'quantity' => 2, 'price' => 50],
    ['name' => 'Mechanical Keyboard', 'quantity' => 1, 'price' => 150],
];

// Membuat objek Invoice
$invoice = new Invoice($items);

// Mencetak invoice
$invoice->printInvoice();

// Menyimpan invoice ke file
$invoice->saveToFile('invoice.txt');
