@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Destination</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-shadow">
            <div class="card-body">
                <form action="{{ route('destination.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="about">Description</label>
                        <textarea name="description" rows="10"
                            class="d-block w-100 form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" required class="form-control">
                            <option value="Wisata Buatan">Wisata Buatan</option>
                            <option value="Wisata Alam">Wisata Alam</option>
                            <option value="Wisata Air">Wisata Air</option>
                            <option value="Wisata Binatang">Wisata Binatang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" name="time" class="form-control" placeholder="09.00 - 18.00"
                            value="{{ old('time') }}">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" class="form-control" placeholder="0812123123123"
                            value="{{ old('contact') }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Jl Bojongsoang"
                            value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Link Maps</label>
                        <input type="text" name="link_maps" class="form-control" placeholder="link maps"
                            value="{{ old('link_maps') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Simpan
                    </button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
