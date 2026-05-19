<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use App\Models\Category;
use App\Models\Type;
use App\Models\Tag;

class BookFilter extends Component
{
    use WithPagination;

    public $category = '';
    public $selectedTypes = [];
    public $selectedTags = [];
    public $sort = '';
    public $search = '';

    protected $queryString = [
        'category' => ['except' => ''],
        'selectedTypes' => ['except' => []],
        'selectedTags' => ['except' => []],
        'sort' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Book::query()->with(['tags', 'type']);

        if ($this->search) {
            $query->where('designation', 'like', "%{$this->search}%");
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if (!empty($this->selectedTypes)) {
            $query->whereIn('type_id', $this->selectedTypes);
        }

        if (!empty($this->selectedTags)) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('tags.id', $this->selectedTags);
            });
        }

        if ($this->sort) {
            switch ($this->sort) {
                case "designation":
                    $query->orderBy('designation');
                    break;
                case "created_at":
                    $query->orderBy('created_at', 'desc');
                    break;
                case "prix":
                    $query->orderBy('prix');
                    break;
            }
        }

        return view('livewire.book-filter', [
            'books' => $query->paginate(10),
            'categories' => Category::all(),
            'types' => Type::all(),
            'tags' => Tag::all(),
        ]);
    }
}
