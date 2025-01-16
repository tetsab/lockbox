<div class="navbar bg-base-100">
    <div class="flex-1">
        <a href="/notes" class="btn btn-ghost text-xl">Lockbox</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li>
                <?php if (session()->geT('show')): ?>   
                    <a href="/hide">🫣</a></li>
                <?php else: ?>
                    <a href="/confirm">👀</a></li>
                <?php endif; ?>
            <li>
                <details>
                    <summary><?= auth()->name ?></summary>
                    <ul class="bg-base-100 rounded-t-none p-2">
                        <li><a>Profile</a></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>
