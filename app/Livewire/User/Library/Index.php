<?php

namespace App\Livewire\User\Library;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]


class Index extends Component
{
    use WithPagination;

    // search + filters
    public $search = '';
    public $branch = '';
    public $semester = '';
    public $isCreating = false;

    public $type = '';
    public $subject = '';
    public $sort = 'newest'; // newest | downloads | views

    // persist these to query string
    protected $queryString = [
        'search' => ['except' => ''],
        'branch' => ['except' => ''],
        'semester' => ['except' => ''],
        'type' => ['except' => ''],
        'subject' => ['except' => ''],
        'sort' => ['except' => 'newest'],
        'page' => ['except' => 1], // pagination
    ];

    protected $listeners = ['documentUploaded' => '$refresh'];

    // when search/filter changes, ensure page resets to 1
    public function updatingSearch() { $this->resetPage(); }
    public function updatingBranch() { $this->resetPage(); }
    public function updatingSemester() { $this->resetPage(); }
    public function updatingType() { $this->resetPage(); }
    public function updatingSubject() { $this->resetPage(); }
    public function updatingSort() { $this->resetPage(); }

    public function clearFilters()
    {
        $this->reset(['search','branch','semester','type','subject','sort']);
        $this->resetPage();
    }
    public function toggleCreate()
    {
        $this->isCreating = !$this->isCreating;
    }

    public function render()
    {
        $query = Document::query();

        // search across title, description, subject (basic LIKE)
        if ($this->search) {
            $q = '%'.$this->search.'%';
            $query->where(function($qry) use ($q) {
                $qry->where('title', 'like', $q)
                    ->orWhere('description', 'like', $q)
                    ->orWhere('subject', 'like', $q);
            });
        }

        if ($this->branch) {
            $query->where('branch', $this->branch);
        }

        if ($this->semester) {
            $query->where('semester', $this->semester);
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->subject) {
            $query->where('subject', 'like', '%'.$this->subject.'%');
        }

        // sorting
        if ($this->sort === 'downloads') {
            $query->orderBy('downloads', 'desc');
        } elseif ($this->sort === 'views') {
            $query->orderBy('views', 'desc');
        } else { // newest
            $query->orderBy('created_at', 'desc');
        }

        $documents = $query->paginate(12);

        // optional: distinct lists for filter dropdowns
        $branches = Document::select('branch')->distinct()->pluck('branch')->filter()->values();
        $semesters = Document::select('semester')->distinct()->pluck('semester')->filter()->values();
        $types = Document::select('type')->distinct()->pluck('type')->filter()->values();

        return view('livewire.user.library.index', compact('documents','branches','semesters','types'));
    }
}
