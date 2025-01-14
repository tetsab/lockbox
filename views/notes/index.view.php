<?php $validations = flash()->get('validations');?>

<div class="menu bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-base-100">
    <?php foreach($notes as $key => $note): ?>
        <a href="/notes?id=<?=$note->id?><?=request()->get('search', '', '&search=')?>"
        class="u-full p-2 cursor-pointer hover:bg-base-200 
        <?php if ($key == 0): ?> rounded-tl-box <?php endif;?>
        <?php if ($note->id == $filteredNote->id): ?> bg-base-200 <?php endif;?>">
            <?=$note->title ?> <br/>
            <span class="text-xs">id:  <?=$note->id?></span>
        </a>
    <?php endforeach; ?>
</div>

<div class="bg-base-200 rounded-r-box w-full p-10 flex flex-col space-y-6">
<form action="/note" method="POST" id="form-update">
    <input type="hidden" name="__method" value="PUT" />
    <input type="hidden" name="id" value="<?=$filteredNote->id?>" />
    <label class="form-control w-full">
        <div class="label">
            <span class="label-text">Title</span>
        </div>
        <input name="title" placeholder="Type here" class="input input-bordered w-full max-w-xs" 
        value="<?=$filteredNote->title?>"/>
        <?php if (isset($validations['title'])): ?>
            <div class="label text-xs text-error"><?=$validations['title'][0]?></div>
        <?php endif;?>
    </label>

    <label class="form-control">
        <div class="label">
            <span class="label-text">Note</span>
        </div>
        <textarea name="note" class="textarea textarea-bordered h-24" placeholder="Write here."><?=$filteredNote->note?></textarea>
        <?php if (isset($validations['note'])): ?>
            <div class="label text-xs text-error"><?=$validations['note'][0]?></div>
        <?php endif;?>
    </label>
</form>

    <div class="flex justify-between items-center">
        <form action="/note" method="POST">
            <input type="hidden" name="__method" value="DELETE">
            <input type="hidden" name="id" value="<?=$filteredNote->id?>">
            <button type="submit" class="btn btn-error">Delete</button>
        </form>
        <button class="btn btn-primary" type="submit" form="form-update">Update</button>
    </div>
</div>
