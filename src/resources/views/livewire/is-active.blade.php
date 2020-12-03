<label class="pl-0 custom-switch d-inline-block">
    <input wire:model.debounce.500ms="isActive"
           wire:change="update({{ ($isActive) ? 0 : 1 }})"
           type="checkbox"
           name="{{ rand() }}"
           class="custom-switch-input">
    <span class="custom-switch-indicator"></span>
    <span class="custom-switch-description sr-only">{{ ($isActive) ? 'Ativo' : 'Inativo' }}</span>
</label>
