@if(Session::has('msg'))
    <div class="alert alert-{{Session::get('type')}} d-flex justify-content-between align-items-center" role="alert">
        <div>
            {{Session::get('msg')}}
        </div>
        @if(Session::get('type') === 'danger')
            <div>
                <form action="{{route('contacts.restore', Session::get('id'))}}" method="post" class="float-left ml-3">
                    @csrf
                    <button class="btn btn-danger">Restore</button>
                </form>
            </div>
        @endif
    </div>
@endif
