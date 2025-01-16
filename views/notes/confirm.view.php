<?php 
    $validations = flash()->get('validations');
?>

<div class="bg-base-300 rounded-box w-full text-3xl font-bold pt-20 flex flex-col items-center">
    <form action="/show" method="POST" class="max-w-md flex flex-col gap-4">
        <div class="text-center">Type your password again to see all your notes decrypted.</div>
    </form>
    <label class="form-control">
        <div class="label">
            <span class="label-text">Password</span>
        </div>
        <input type="password" name="password" class="input input-bordered bg-white" />
        <?php if (isset($validations['password'])): ?>
        <div class="label text-xs text-error"><?= $validations['password'][0] ?></div>
        <?php endif;?>
    </label>

    <button class="btn btn-primary">Open my notes</button>
</div>
