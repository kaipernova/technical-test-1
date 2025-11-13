<?php

namespace App;

use App\Models\Note;

trait HasNotes
{
    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function addNote($content)
    {
        return $this->notes()->create([
            'note' => $content,
        ]);
    }

    public function latestNotes($limit = 5) {
        return $this->notes()->latest()->limit($limit)->get();
    }
}
