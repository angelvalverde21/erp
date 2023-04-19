<div>
    {{-- Do your work, then step back. --}}
    <x-sectioncontent>
        <table class="table">


            @foreach ($old_users as $user)
                <tr>
                    <td>{{ $user->NOMBRE }}</td>
                    <td>{{ $user->APELLIDOS }}</td>
                    <td>{{ $user->EMAIL }}</td>
                    <td>{{ $user->FECHA }}</td>
                </tr>
                @php(ob_flush()); flush(); @endphp
            @endforeach

        </table>

    </x-sectioncontent>
</div>
