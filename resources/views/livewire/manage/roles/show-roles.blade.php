<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    
    @foreach ($selectedRoles as $selectedRole)
        <div class="form-check form-switch">

            @if ($selectedRole['has_role'])
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault-{{ $selectedRole['name'] }}" wire:click="removeAdd('{{ $selectedRole['name'] }}')" checked>
            @else
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault-{{ $selectedRole['name'] }}" wire:click="removeAdd('{{ $selectedRole['name'] }}')">
            @endif

            <label class="form-check-label" for="flexSwitchCheckDefault-{{ $selectedRole['name'] }}">{{ $selectedRole['name'] }}</label>

        </div>
    @endforeach

    {{-- @foreach ($userRoles as $userRole)
    <div class="form-check form-switch">

        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
        <label class="form-check-label" for="flexSwitchCheckDefault">{{ $userRole['name'] }}</label>

    </div>
@endforeach --}}

</div>
