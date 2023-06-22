<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <x-breadcrumbs title="Perfil del courier" />
    <x-sectioncontent>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg bg-secondary">
                        <h4>upload_logo</h4>
                    </div>
                    <div class="card-body">
                        
                        @livewire('components.profile.upload-option', ['store' => $courier, 'field' => 'logo_profile'], key('logo_profile'))

                    </div>
                </div>
            </div>
        </div>
    </x-sectioncontent>

</div>
