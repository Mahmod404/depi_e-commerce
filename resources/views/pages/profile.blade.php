@extends('main')

@section('content')
    <div class="container">
        <div class="row justify-content-around mt-5">
            <div class="col-11 font-mono p-4 border-2 rounded-3 shadow-lg position-relative mb-3">
                <h4 class="">Basic Information</h4>
                <div class="position-absolute top-0 end-0 me-4 mt-4">
                    <a class="btn py-1" href="{{ route('user.edit') }}"> <i class="fa-solid fa-user-pen"></i></a>
                </div>
                <div class="row justify-content-around mt-4">
                    <div class="col-3">
                        <h6>Username:</h6>
                        <h6>Email:</h6>
                        <h6>Phone:</h6>
                    </div>
                    <div class="col-6">
                        <h6>{{ Auth::user()->name }}</h6>
                        <h6>{{ Auth::user()->email }}</h6>
                        <h6>{{ Auth::user()->phone }}</h6>
                    </div>
                </div>
            </div>

            <div class="col-11 font-mono p-4 border-2 rounded-3 shadow-lg position-relative mt-4">
                <h4 class="">Adresses</h4>
                <div class="position-absolute top-0 end-0 me-4 mt-4">
                    <a class="btn py-1" href="{{ route('address.create') }}"> <i class="fa-solid fa-plus"></i></a>
                </div>
                @foreach (Auth::user()->addresses as $address)
                    <div class="row justify-content-around mt-4 border-bottom border-primary position-relative">

                        <div class="col-3">
                            <h6>Address:</h6>
                            <h6>City:</h6>
                            <h6>Updated_at:</h6>
                        </div>
                        <div class="col-6">
                            <h6>{{ $address->address }}</h6>
                            <h6>{{ $address->city }}</h6>
                            <h6>{{ $address->updated_at }}</h6>
                        </div>
                        <div class="col-3">
                            <a class="btn py-1 mt-1" href="{{ route('address.edit', $address->id) }}"> <i
                                    class="fa-solid fa-user-pen"></i></a>
                            <a class="btn py-1 mt-1" href="{{ route('address.destroy', $address->id) }}"> <i
                                    class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
