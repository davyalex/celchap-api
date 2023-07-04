@extends('admin.layout.app')
@section('title','Detail')

@section('content')
<div class="card card-default p-4 ec-card-space">
    <div class="ec-vendor-card mt-m-24px row">
        @foreach ($boutique as $item)
        <div class="col-lg-6 col-xl-4 col-xxl-3">
            <div class="card card-default mt-24px">
                <a href="{{ route('admin.boutique_detail',$item['id']) }}" data-bs-toggle="modal" data-bs-target="#modal-contact"
                        class="view-detail"><i class="mdi mdi-eye-plus-outline"></i>
                </a>
                <div class="vendor-info card-body text-center p-4">
                    <a href="{{ route('admin.boutique_detail',$item['id']) }}" class="text-secondary d-inline-block mb-3">
                        <div class="image mb-3">  
                            <img src="{{ asset($item->getFirstMediaUrl('logo')) }}" class="img-fluid rounded-circle"
                                alt="Avatar Image">
                        </div>

                        <h5 class="card-title text-dark">Emma Smith</h5>

                        <ul class="list-unstyled">
                            <li class="d-flex mb-1">
                                <i class="mdi mdi-cellphone-basic mr-1"></i>
                                <span>+91 963-852-7410</span>
                            </li>
                            <li class="d-flex">
                                <i class="mdi mdi-email mr-1"></i>
                                <span>exmaple@email.com</span>
                            </li>
                        </ul>
                    </a>
                    <div class="row justify-content-center ec-vendor-detail">
                        <div class="col-4">
                            <h6 class="text-uppercase">Items</h6>
                            <h5>180</h5>
                        </div>
                        <div class="col-4">
                            <h6 class="text-uppercase">Sell</h6>
                            <h5>1908</h5>
                        </div>
                        <div class="col-4">
                            <h6 class="text-uppercase">Payout</h6>
                            <h5>$2691</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
       
       
  
     
    </div>
</div>

@endsection