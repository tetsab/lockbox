<div class="grid grid-cols-2">
    <div class="hero min-h-screen flex ml-40">
        <div class="hero-content -mt-20">
            <div>
                <p class="py-2 text-xl">Welcome to</p>
                <h1 class="text-6xl font-bold">LockBox</h1>
                <p class="py-2 pb-4 text-xl">where you save <span class="italic">everything</span> safely.</p>
            </div>
        </div>
    </div>
    <div class="bg-white hero mr-40 min-h-scren text-black">
        <div class="hero-content -mt-20">
            <form method="POST" action="/register">
                <?php $validations = flash()->get('validations');?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Create a new account</div>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-black">Name</span>
                            </div>
                            <input type="text" name="name"
                            class="input input-bordered w-full max-w-xs bg-white" 
                            value="<?=old('name')?>"
                            />
                            <?php if (isset($validations['name'])): ?>
                                <div class="label text-xs text-error"><?=$validations['name'][0]?></div>
                            <?php endif;?>
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-black">Email</span>
                            </div>
                            <input type="text" name="email"
                            class="input input-bordered w-full max-w-xs bg-white" 
                            value="<?=old('email')?>"/>
                            <?php if (isset($validations['email'])): ?>
                                <div class="label text-xs text-error"><?=$validations['email'][0]?></div>
                            <?php endif;?>
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-black">Confirm email</span>
                            </div>
                            <input type="text" name="email_confirmation"
                            class="input input-bordered w-full max-w-xs bg-white" 
                            "/>
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-black">Password</span>
                            </div>
                            <input type="password" name="password"
                            class="input input-bordered w-full max-w-xs bg-white" 
                            />
                            <?php if (isset($validations['password'])): ?>
                                <div class="label text-xs text-error"><?=$validations['password'][0]?></div>
                            <?php endif;?>
                        </label>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-block">Sign Up</button>
                            <a href="/login" class="btn btn-link">Already have an account?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>