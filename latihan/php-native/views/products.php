<?php
function e(string $v): string
{
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html><html lang="id"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Katalog Kasir H6</title><link rel="stylesheet" href="style.css">
<main><h1>Katalog produk</h1><p>Latihan PHP Native — tambah dan lihat produk</p>
<p role="status"><?= e($flash) ?></p>
<?php foreach ($errors as $error) { ?><p role="alert"><?= e($error) ?></p><?php } ?>
<form method="post" action="index.php">
<input type="hidden" name="token" value="<?= e($_SESSION['token']) ?>">
<label>Nama <input name="name" required maxlength="100" value="<?= e($old['name']) ?>"></label>
<label>Harga (Rp) <input name="price" type="number" min="0" max="4294967295" required value="<?= e($old['price']) ?>"></label>
<label>Stok <input name="stock" type="number" min="0" max="4294967295" required value="<?= e($old['stock']) ?>"></label>
<button>Simpan produk</button></form>
<table><thead><tr><th>Produk</th><th>Harga (Rp)</th><th>Stok</th></tr></thead><tbody>
<?php foreach ($products as $item) { ?><tr><td><?= e($item['name']) ?></td><td><?= number_format((int) $item['price'], 0, ',', '.') ?></td><td><?= (int) $item['stock'] ?></td></tr><?php } ?>
</tbody></table></main></html>
