<h1 style="font-size:2rem; margin-bottom: 24px;">Your Shopping Cart</h1>
<?php if(empty($cartItems)): ?>
  <p>Your cart is empty. <a href="<?= base_url('/products') ?>">Continue shopping</a>.</p>
<?php else: ?>
  <form action="<?= base_url('/cart/update') ?>" method="post" style="margin-bottom: 24px;">
  <table style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
        <th style="padding: 12px;">Product</th>
        <th style="padding: 12px;">Price</th>
        <th style="padding: 12px; width:120px;">Quantity</th>
        <th style="padding: 12px;">Total</th>
        <th style="padding: 12px;"></th>
      </tr>
    </thead>
    <tbody>
      <?php $grandTotal = 0; ?>
      <?php foreach($cartItems as $item): ?>
        <?php $itemTotal = $item['price'] * $item['quantity']; $grandTotal += $itemTotal; ?>
      <tr style="border-bottom: 1px solid #e5e7eb;">
        <td style="padding: 12px; display:flex; gap: 12px; align-items:center;">
          <img src="<?= esc($item['image_url']) ?>" alt="<?= esc($item['name']) ?>" style="width: 64px; height: 64px; object-fit: cover; border-radius: 8px;" loading="lazy" />
          <span><?= esc($item['name']) ?></span>
        </td>
        <td style="padding: 12px;">Rp <?= number_format($item['price'],0,",",".") ?></td>
        <td style="padding: 12px;">
          <input type="number" min="1" name="quantities[<?= esc($item['id']) ?>]" value="<?= esc($item['quantity']) ?>" style="width: 60px; padding:4px; font-size:1rem;" required />
        </td>
        <td style="padding: 12px;">Rp <?= number_format($itemTotal,0,",",".") ?></td>
        <td style="padding: 12px;">
          <a href="<?= base_url('/cart/remove/'.$item['id']) ?>" style="color:#ef4444; font-weight: 700;" onclick="return confirm('Remove this item?');" aria-label="Remove <?= esc($item['name']) ?> from cart">
            <span class="material-icons" aria-hidden="true">delete</span>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr style="font-weight: 700; border-top: 2px solid #e5e7eb;">
        <td colspan="3" style="padding: 12px; text-align: right;">Grand Total:</td>
        <td colspan="2" style="padding: 12px;">Rp <?= number_format($grandTotal,0,",",".") ?></td>
      </tr>
    </tfoot>
  </table>
  <div style="margin-top: 20px; display:flex; gap:16px; flex-wrap: wrap;">
    <button type="submit" style="background:#2563eb; color:#fff; border:none; padding: 12px 20px; border-radius: 8px; font-weight: 700; cursor:pointer;">
      Update Cart
    </button>
    <a href="<?= base_url('/checkout') ?>" style="background:#16a34a; color:#fff; padding: 12px 20px; border-radius: 8px; font-weight: 700; text-align: center; display: inline-block; text-decoration:none;" role="button">
      Proceed to Checkout
    </a>
    <a href="<?= base_url('/cart/clear') ?>" style="background:#ef4444; color:#fff; padding: 12px 20px; border-radius: 8px; font-weight: 700; text-align: center; display: inline-block; text-decoration:none;" role="button" onclick="return confirm('Clear your entire cart?');">
      Clear Cart
    </a>
  </div>
  </form>
<?php endif; ?>
