@if(isset($r['deadline']) && $deadline = $this->formatDeadline($r['deadline']))

    @include('filament-kanban::livewire.partials.records.footer-deadline')

@endif
@if(isset($r['progress']) && ((is_bool($this->showProgress()) && $this->showProgress()) || (is_array($this->showProgress()) && in_array($status['id'], $this->showProgress()))))

    @include('filament-kanban::livewire.partials.records.footer-progress')

@endif
