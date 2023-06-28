@extends('admin.layout.app')

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Livraison</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Main Livraison
            </p>
        </div>
        <div class="row">
            {{-- livraison --}}
            <div class="col-xl-10 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <h4>Ajouter une nouvelle zone</h4>
                            <form method="post" action="{{ route('admin.livraison.store') }}"
                              >
                                @csrf
                                <div class="row">
                                    <div class="col-md-5 form-group row">
                                        <label for="text" class="col-12 col-form-label">Lieu</label>
                                        <div class="col-12">
                                            <input id="text" name="lieu" class="form-control here slug-title"
                                                type="text" required>
                                        </div>
                                    </div>
    
                                    <div class="col-md-5 form-group row">
                                        <label for="text" class="col-12 col-form-label">Tarif</label>
                                        <div class="col-12">
                                            <input id="text" name="tarif" class="form-control here slug-title"
                                                type="text" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2 form-group row">
                                        <label for="text" class="col-12 col-form-label"></label>
                                        <div class="col-12">
                                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- end livraison --}}

        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Zone</th>
                                        <th>Tarif</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($livraison as $item)
                                        <tr>
                                            <td>{{ $item['lieu'] }}</td>
                                    
                                            <td>{{ $item['tarif']}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-success">Info</button>
                                                    <button type="button"
                                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" data-display="static">
                                                        <span class="sr-only">Info</span>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="" data-bs-toggle="modal"
                                                            data-bs-target="#editLiv{{ $item['id'] }}"
                                                            data-id="{{ $item['id'] }}">Edit</a>

                                                            <form method="post" action="{{ route('admin.livraison.destroy',$item['id']) }}">
                                                                @csrf
                                                                <div>
                                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDelete{{ $item['id'] }}"
                                                                    data-id="{{ $item['id'] }}">Delete</a>
                                                                </div>
                                                                @include('admin.components.deleteConfirm')
                                                            </form>
                                                       
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- modal update --}}
                                        @include('admin.pages.livraison.edit')
                                        {{-- end modal update --}}
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
@endsection
