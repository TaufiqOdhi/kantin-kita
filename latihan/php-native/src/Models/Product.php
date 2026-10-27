<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

final class Product
{
    public function __construct(private PDO $db) {}

    public function all(): array
    {
        return $this->db->query('SELECT id,name,price,stock FROM products ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, int $price, int $stock): void
    {
        $q = $this->db->prepare('INSERT INTO products(name,price,stock) VALUES (:name,:price,:stock)');
        $q->execute(['name' => $name, 'price' => $price, 'stock' => $stock]);
    }
}
