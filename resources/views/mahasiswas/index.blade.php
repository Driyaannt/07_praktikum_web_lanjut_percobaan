@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
        </div>
    </div>
    <form class="row mb-3 mt-5" action="{{ route('cari') }}" method="POST">
        @csrf
        <div class="col-md-6">
            <div class="d-flex flex-row">
                <input type="text" value="{{ (request()->cari) ? request()->cari : '' }}" name="cari" class="form-control" placeholder="cari mahasiswa">
                <button type="submit" class="btn btn-primary ml-3">Cari</button>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-row justify-content-end">
            <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
        </div>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nim</th>
            <th>Nama</th>
{{--            <th>Email</th>--}}
            <th>Kelas</th>
            <th>Jurusan</th>
{{--            <th>No_Handphone</th>--}}
{{--            <th>Tanggal Lahir</th>--}}
            <th width="280px">Action</th>
        </tr>
        @php
            $i=1;
        @endphp
        @foreach ($paginate as $mahasiswa)
            <tr>
                <td>{{ $i++}}</td>
                <td>{{ $mahasiswa->Nim }}</td>
                <td>{{ $mahasiswa->Nama }}</td>
{{--                <td>{{ $mahasiswa->Email }}</td>--}}
                <td>{{ $mahasiswa->Kelas->nama_kelas }}</td>
                <td>{{ $mahasiswa->Jurusan }}</td>
{{--                <td>{{ $mahasiswa->No_Handphone }}</td>--}}
{{--                <td>{{ $mahasiswa->tanggal_lahir }}</td>--}}
                <td>
                    <form action="{{ route('mahasiswa.destroy',$mahasiswa->Nim) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('mahasiswa.show',$mahasiswa->Nim) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mahasiswa->Nim) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-md-12">
            {{$paginate->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="d-flex justify-content-between">
            <p>Showing {{ $paginate->firstItem() }} to {{ $paginate->lastItem() }} of {{ $paginate->total() }} items</p>
            <p>Page {{ $paginate->currentPage() }} of {{ $paginate->lastPage() }}</p>
        </div>
    </div>

@endsection
