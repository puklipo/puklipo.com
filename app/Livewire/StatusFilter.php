<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class StatusFilter extends Component
{
    #[Locked]
    protected array $default_filter = [1];

    #[Locked]
    public array $filter;

    public function mount(): void
    {
        $this->filter = session('status_filter', $this->default_filter);
    }

    /**
     * @throws ValidationException
     */
    public function filterChange(int $id): void
    {
        validator(
            ['id' => $id],
            ['id' => Rule::in($this->default_filter)]
        )->validate();

        $this->filter = collect($this->filter)
            ->when(in_array($id, $this->filter),
                fn (Collection $collection) => $collection->reject(fn ($value) => $value === $id),
                fn (Collection $collection) => $collection->push($id)
            )
            ->unique()
            ->values()
            ->toArray();

        session(['status_filter' => $this->filter]);

        $this->dispatch('statusCreated', scroll: true);
    }

    #[Computed]
    public function users(): Collection
    {
        return User::whereIntegerInRaw('id', $this->default_filter)->get();
    }
}
