<?php $validations = flash()->get('validations');?>

<div class="bg-base-300 rounded-l-box w-56">
    <div class="bg-base-200 p-4 rounded-tl-box">
        + New note
    </div>
</div>

<div class="bg-base-200 rounded-r-box w-full p-10">
    <form action="/notes/create" method="POST" class="flex flex-col space-y-6">
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">Title</span>
            </div>
            <input type="text" name="title" class="input input-bordered w-full" />
            <?php if (isset($validations['title'])): ?>
                <div class="label text-xs text-error"><?=$validations['title'][0]?></div>
            <?php endif;?>
        </label>

        <label class="form-control">
            <div class="label">
                <span class="label-text">Note</span>
            </div>
            <textarea class="textarea textarea-bordered h-24" name="note"></textarea>
            <?php if (isset($validations['note'])): ?>
                <div class="label text-xs text-error"><?=$validations['note'][0]?></div>
            <?php endif;?>
        </label>

        <div class="flex justify-end items-center">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
