<?php

namespace App\Controllers\Notes;

use App\Models\Note;

class IndexController
{
    public function __invoke()
    {
        $notes = Note::all(
            request()->get('search')
        );

        if (!$filteredNote = $this->getFilteredNote($notes)) {
            return view('notes/not-found');
        }

        return view('notes/index', [
            'notes' => $notes,
            'filteredNote' => $filteredNote ?? null,
        ]);
    }

    private function getFilteredNote($notes) 
    {
        $id = request()->get('id', (sizeof($notes) > 0 ? $notes[0]->id : null));
        $filter = array_filter($notes, fn($n) => $n->id == $id);
        return array_pop($filter);
    }
}