@if ($component->searchIsEnabled())
    <div class="input-group input-group-flat">
        <input wire:model{{ $component->getSearchOptions() }}="{{ $component->getTableName() }}.search"
               placeholder="{{ __('Search') }}" type="text" class="form-control" autocomplete="off">
        <span class="input-group-text">
            <a href="#" wire:click.prevent="clearSearch" class="link-secondary" -data-bs-toggle="tooltip"
               aria-label="{{ __('Clear search') }}" data-bs-original-title="{{ __('Clear search') }}"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path
                            stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path
                            d="M6 6l12 12"></path></svg>
            </a>
        </span>
    </div>
@endif