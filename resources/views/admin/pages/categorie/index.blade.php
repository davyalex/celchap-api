@extends('admin.layout.app')

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Catégories-Sous catégories</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Main Category
            </p>
        </div>
        <div class="row">
            {{-- categorie --}}
            <div class="col-xl-5 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <h4>Ajouter une nouvelle catégorie</h4>
                            <form method="post" action="{{ route('admin.categorie.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Name</label>
                                    <div class="col-12">
                                        <input id="text" name="name" class="form-control here slug-title"
                                            type="text" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-12 col-form-label">Image de la categorie</label>
                                    <div class="col-12">
                                        <input id="slug" name="image" class="form-control here set-slug"
                                            type="file">
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                <label class="col-12 col-form-label">Product Tags <span>( Type and
                                        make comma to separate tags )</span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="group_tag" name="group_tag" value="" placeholder="" data-role="tagsinput">
                                </div>
                            </div> --}}

                                <div class="row">
                                    <div class="col-12">
                                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- end categorie --}}


            {{-- souscategorie --}}
            <div class="col-xl-7 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <h4>Ajouter une sous catégorie</h4>

                            <form method="POST" action="{{ route('admin.sous_categorie.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                        <label for="text" class="col-12 col-form-label">Name</label>
                                        <div class="col-12">
                                            <input id="text" name="name" class="form-control here slug-title"
                                                type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="parent-category" class="col-12 col-form-label">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Catégorie Parentale</font>
                                            </font>
                                        </label>
                                        <div class="col-12">
                                            <select id="parent-category" name="category_id" class="custom-select">
                                                <option disabled value selected>Selectionner</option>
                                                @foreach ($categorie as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{ $item['name'] }}
                                                            </font>
                                                        </font>
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-12 col-form-label">Image de la sous-categorie</label>
                                    <div class="col-12">
                                        <input type="file" id="slug" name="image"
                                            class="form-control here set-slug" type="file">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- end souscategorie --}}

        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Sub Categories</th>
                                        <th>Product</th>
                                        {{-- <th>Total Sell</th> --}}
                                        {{-- <th>Status</th> --}}
                                        {{-- <th>Trending</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categorie as $item)
                                        <tr>
                                            <td><img class="cat-thumb" src="{{ asset($item->getFirstMediaUrl('image')) }}"
                                                    alt="Product Image" /></td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>
                                                <span class="ec-sub-cat-list">
                                                    <span class="ec-sub-cat-count"
                                                        title="Total Sub Categories">{{ $item->sous_categories()->count() }}</span>
                                                    @foreach ($item['sous_categories'] as $sous_cat)
                                                        <p>
                                                            <span><img class="cat-thumb"
                                                                    src="{{ asset($sous_cat->getFirstMediaUrl('image')) }}"
                                                                    alt="Product Image" /></span>
                                                            <span class="ec-sub-cat-tag">{{ $sous_cat['name'] }}</span>
                                                            <span>
                                                                <a class="bg-success text-white" href=""
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editSousCat{{ $sous_cat['id'] }}"
                                                                    data-id="{{ $sous_cat['id'] }}"><i
                                                                        class="mdi mdi-pencil"></i></a>
                                                            </span>
                                                            <span>
                                                                <a href="" class="bg-danger text-white"
                                                                    data-id="{{ $sous_cat->id }}" data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDelete{{ $sous_cat->id }}"><i
                                                                        class="mdi mdi-delete"></i></a>
                                                                @include('admin.components.deleteConfirmSousCat')
                                                            </span>
                                                        </p>

                                                        @include('admin.pages.categorie.edit_souscategorie')
                                                    @endforeach
                                                </span>
                                            </td>
                                            <td>{{ $item->produits()->count() }}</td>
                                            {{-- <td>2161</td> --}}
                                            {{-- <td>ACTIVE</td> --}}
                                            {{-- <td><span class="badge badge-success">Top</span></td> --}}
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
                                                            data-bs-target="#editCat{{ $item['id'] }}"
                                                            data-id="{{ $item['id'] }}">Edit</a>

                                                        <a href="" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#confirmDeleteCat{{ $item['id'] }}"
                                                            data-id="{{ $item['id'] }}">Delete</a>
                                                    </div>
                                                    @include('admin.components.deleteConfirmCat')
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- modal update --}}
                                        @include('admin.pages.categorie.edit_categorie')
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
