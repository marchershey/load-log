<?php

namespace App\Http\Pages\Loads;

use App\Http\Pages\Loads\Forms\LoadForm;
use App\Models\Load;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Loads')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $query;

    // Loads table - sorts and filters
    public string $table_sort_by = 'date';
    public string $table_sort_dir = 'desc';
    public bool $only_hidden_loads = false;

    // Load modal
    public LoadForm $load_form;
    public bool $show_load_modal = false;

    // Delete modal
    public Load $load_to_delete;
    public bool $show_delete_modal = false;

    public function render()
    {
        return view('pages.loads.index');
    }

    public function sort($column)
    {
        if ($this->table_sort_by === $column) {
            $this->table_sort_dir = $this->table_sort_dir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->table_sort_by = $column;
            $this->table_sort_dir = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed(cache: true, persist: true)]
    public function loads()
    {
        $sortColumns = [
            'id' => 'loads.id',
            'number' => 'loads.number',
            'bol' => 'loads.bol',
            'trailers.number' => 'trailers.number',
            'lanes.name' => 'lanes.name',
            'date' => 'loads.date',
            'created_at' => 'loads.created_at',
        ];

        $query = Load::query();

        if ($this->only_hidden_loads) {
            $query->onlyTrashed();
        }

        $loads = $query->join('trailers', 'loads.trailer_id', '=', 'trailers.id')
            ->join('lanes', 'loads.lane_id', '=', 'lanes.id')
            ->select('loads.*', 'trailers.number as trailer_number', 'lanes.name as lane_name')
            ->orderBy($sortColumns[$this->table_sort_by], $this->table_sort_dir)
            ->orderBy('loads.date', 'desc')
            ->orderBy('loads.created_at', 'desc')
            ->paginate(10);

        // $this->log($loads);
        // $this->log('current: ' . $loads->currentPage());
        // $this->log('last: ' . $loads->lastPage());
        // $this->log($this->loads()->current_page);
        // $this->log('Current Page: ' . $this->getPage());

        // if ($loads->currentPage() > $loads->lastPage()) {
        //     $this->resetPage();
        //     $this->log('Setting page: ' . $loads->lastPage());
        //     // $this->setPage($loads->lastPage());
        //     // $this->gotoPage($loads->lastPage());
        // }

        // $this->log('New Page: ' . $this->getPage());

        // if ($loads->isEmpty() && $this->getPage() > 1) {
        //     // $this->setPage($loads->last_page);
        //     // $this->log('loads is empty');
        // } else {
        //     // $this->log('loads is NOT empty');
        // }

        return $loads;
    }

    function updatedPage($page)
    {
        // $loads = $this->loads();

        // $this->log('Page: ' . $page);
        // if ($loads->currentPage() > $loads->lastPage()) {
        //     $this->log('Setting page: ' . $loads->lastPage());
        //     $this->gotoPage($loads->lastPage());
        //     // $this->gotoPage($loads->lastPage());
        // }
        $this->handleEmptyPaginationPage();
    }

    // ///////////////////////////////////////////////////

    #[On('load-added')]
    function loadAdded(): void
    {
        $this->show_load_modal = false;
    }

    function updated($field): void
    {

        $this->handleEmptyPaginationPage();
    }

    function addLoad(): void
    {
        $this->show_load_modal = true;
    }

    function editLoad(Load $load_id): void
    {
        $this->dispatch('set-load', $load_id)->to(LoadForm::class);
        $this->show_load_modal = true;
    }

    function hideLoad($load_id): void
    {
        Load::destroy($load_id);
    }

    function unhideLoad($load_id): void
    {
        Load::withTrashed()
            ->where('id', $load_id)
            ->restore();
    }

    function confirmDeleteLoad($load_id): void
    {
        $this->load_to_delete = Load::withTrashed()->find($load_id);
        $this->show_delete_modal = true;
    }

    function deleteLoad(): void
    {
        $deleted_load_number = $this->load_to_delete->number;
        $this->load_to_delete->forceDelete();
        $this->show_delete_modal = false;
        Flux::toast('Load ' . $deleted_load_number . ' was successfully deleted.', heading: 'Load Deleted', variant: 'success');
    }

    /**
     * If you delete all paginated items on the current page
     * it will stay on the page instead of navigating to the
     * previous page. So we need to check to see if there are
     * more items on a previous page, then navigate to that
     * page.
     */
    function handleEmptyPaginationPage(): void
    {
        $loads = $this->loads();

        if ($loads->currentPage() > $loads->lastPage()) {
            $this->gotoPage($loads->lastPage());
        }
    }
}
