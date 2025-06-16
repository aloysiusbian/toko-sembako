<h1 style="font-size:2rem; margin-bottom: 24px;">Login to Your Account</h1>
<form action="<?= base_url('/auth/login') ?>" method="post" novalidate style="max-width: 360px;">
    <?= csrf_field() ?>
    <div style="margin-bottom: 16px;">
        <label for="email" style="display:block; font-weight:600; margin-bottom: 6px;">Email</label>
        <input type="email" id="email" name="email" value="<?= set_value('email') ?>" required aria-describedby="emailHelp" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #d1d5db;">
        <?php if (isset($validation) && $validation->hasError('email')): ?>
            <div style="color: #b91c1c; margin-top: 4px;" role="alert"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
    </div>
    <div style="margin-bottom: 16px;">
        <label for="password" style="display:block; font-weight:600; margin-bottom: 6px;">Password</label>
        <input type="password" id="password" name="password" required aria-describedby="passwordHelp" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #d1d5db;">
        <?php if (isset($validation) && $validation->hasError('password')): ?>
            <div style="color: #b91c1c; margin-top: 4px;" role="alert"><?= $validation->getError('password') ?></div>
        <?php endif; ?>
    </div>
    <button type="submit" style="background:#4f46e5; color:#fff; padding: 12px 16px; border:none; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%;">Login</button>
</form>