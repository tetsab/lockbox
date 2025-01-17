<?php

namespace App\Models;

use Core\Database;
use Carbon\Carbon;

class Note
{
    public $id;
    public $user_id;
    public $title;
    public $note;
    public $date_creation;
    public $date_update;

    public function dateCreated()
    {
        return Carbon::parse($this->date_creation);
    }

    public function dateUpdated()
    {
        return Carbon::parse($this->date_update);
    }

    public function note()
    {
        if (session()->get('show')) {
            return decrypt($this->note);
        }

        return str_repeat('*', rand(10, 100));
    }

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

    public static function create($data)
    {
        $database = new Database(config('database'));

        $database->query(
            "insert into notes (user_id, title, note, date_creation, date_update) 
            values (:user_id, :title, :note, :date_creation, :date_update)",
            params: array_merge($data, [
                'date_creation' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s')
        ])
      );
    }
 
    public static function update($id, $title, $note)
    {
        $db = new Database(config('database'));
        $set = "title = :title";
        
        if ($note) {
            $set .= ", note = :note";
        }

        $db->query(
            query: "
                update notes
                set $set
                where id = :id",
            params: array_merge([
                'title' => $title,
                'id' => $id,
            ], $note ? ['note' => encrypt($note)] : [])
        );
    }

    public static function delete($id)
    {
        $db = new Database(config('database'));
        $db->query(
            query: "delete from notes where id = :id",
            params: ['id' => $id],
        );
    }
}

// https://www.php.net/manual/en/function.openssl-encrypt.php