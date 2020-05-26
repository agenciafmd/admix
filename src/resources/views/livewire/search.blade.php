<div class="w-100 d-none d-lg-block">
    <div class="flex-fill mx-auto max-w-md">
        <div class="input-icon">
            <span class="input-icon-addon">
                <i class="icon fe-search"
                   wire:loading.class.remove="fe-search"
                   wire:loading.class="fe-loader"></i>
            </span>
            <input wire:model="searchTerm" type="text" class="form-control" placeholder="Buscar"
                   tabindex="-1">
            @if(count($results) > 0)
                <div class="dropdown-menu w-100 show p-0">
                    @foreach($results as $type => $modelSearchResults)
                        <span class="dropdown-item-text border-bottom bg-gray-lightest py-2 font-weight-bold">
                            {{ $type }}
                        </span>
                        @foreach($modelSearchResults as $searchResult)
                            <a class="dropdown-item py-2 border-bottom text-truncate" href="{{ $searchResult->url }}">
                                {{ $searchResult->title }}
                            </a>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
