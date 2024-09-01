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

    public function getItems() {
        return $this->items;
    }
}

class InvoicePrinter {
    public function print(Invoice $invoice) {
        echo "Items:\n";
        foreach ($invoice->getItems() as $item) {
            echo $item['name'] . " - " . $item['quantity'] . " x " . $item['price'] . "\n";
        }
        echo "Total: " . $invoice->calculateTotal() . "\n";
    }
}

class InvoiceSaver {
    public function saveToFile(Invoice $invoice, $filename) {
        $file = fopen($filename, 'w');
        fwrite($file, "Items:\n");
        foreach ($invoice->getItems() as $item) {
            fwrite($file, $item['name'] . " - " . $item['quantity'] . " x " . $item['price'] . "\n");
        }
        fwrite($file, "Total: " . $invoice->calculateTotal() . "\n");
        fclose($file);
    }
}
// Contoh data item
$items = [
    ['name' => 'Laptop Pro', 'quantity' => 1, 'price' => 2000],
    ['name' => 'Wireless Mouse', 'quantity' => 2, 'price' => 50],
    ['name' => 'Mechanical Keyboard', 'quantity' => 1, 'price' => 150],
];

// Membuat objek Invoice
$invoice = new Invoice($items);

// Mencetak invoice
$printer = new InvoicePrinter();
$printer->print($invoice);

// Menyimpan invoice ke file
$saver = new InvoiceSaver();
$saver->saveToFile($invoice, 'invoice.txt');

