<?php

namespace App\Models;

use Core\Database;

class Note
{
    public $id;
    public $user_id;
    public $title;
    public $note;
    public $date_creation;
    public $date_update;

    public static function all(?string $filter = null): ?array
    {
        $db = new Database(config('database'));
        return $db->query(
            query: "select * from notes where user_id = :user_id" . (
                $filter ? " and title like :search" : null
            ),
            class: self::class,
            params: array_merge(
                ['user_id' => auth()->id,], 
                $filter ? ['search' => "%$filter%"] : []
            )
        )->fetchAll();
    }
}
