<x-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 pt-5">
                <form method="POST" action="{{route('reviewer.send')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="titolo" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="titolo">
                    </div>
                    <div class="mb-3">
                        <label for="corpo" class="form-label">Spiegazione richiesta</label>
                        <textarea name="corpo" id="corpo" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-main">Accedi</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>