@extends('admin.layout.app')
@section('title','Detail-boutique')

@section('content')
<div class="card bg-white profile-content ec-vendor-profile">
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="profile-content-left profile-left-spacing">
                <div class="ec-disp">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            <img src="{{ asset('admin/assets/img/user/u6.jpg') }}" alt="user image">
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $boutique['name'] }}</h4>
                            <p>{{ $boutique['phone'] }}</p>
                            {{-- <a class="btn btn-primary my-3" href="#">Produits</a> --}}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between ">
                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">1703</h6>
                            <p>Produits</p>
                        </div>

                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">3005</h6>
                            <p>Ventes</p>
                        </div>

                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">1150</h6>
                            <p>Chiffre d'affaire</p>
                        </div>
                    </div>
                </div>
                <hr class="w-100">

                <div class="contact-info pt-4">
                    <h5 class="text-dark">Proprietaire</h5>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Nom</p>
                    <p>{{ $boutique['user']['fullname'] }}</p>
                    <p class="text-dark font-weight-medium pt-24px mb-2">Contact</p>
                    <p>{{ $boutique['user']['phone'] }}</p>
                  
                    {{-- <p class="text-dark font-weight-medium pt-24px mb-2">Social Profile</p>
                    <p class="social-button">
                        <a href="#" class="mb-1 btn btn-outline btn-twitter rounded-circle">
                            <i class="mdi mdi-twitter"></i>
                        </a>

                        <a href="#" class="mb-1 btn btn-outline btn-linkedin rounded-circle">
                            <i class="mdi mdi-linkedin"></i>
                        </a>

                        <a href="#" class="mb-1 btn btn-outline btn-facebook rounded-circle">
                            <i class="mdi mdi-facebook"></i>
                        </a>

                        <a href="#" class="mb-1 btn btn-outline btn-skype rounded-circle">
                            <i class="mdi mdi-skype"></i>
                        </a>
                    </p> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-xl-9">
            <div class="profile-content-right profile-right-spacing py-5">
                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="true">Profile</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                            data-bs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Settings</button>
                    </li> --}}
                </ul>
                <div class="tab-content px-3 px-xl-5" id="myTabContent">

                    <div class="tab-pane fade show active" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <div class="tab-widget mt-5">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle mr-3 bg-primary">
                                            <i class="mdi mdi-account-outline text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">5300</h4>
                                            <p>New Users</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle bg-warning mr-3">
                                            <i class="mdi mdi-cart-outline text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">1953</h4>
                                            <p>Order Placed</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="media widget-media p-3 bg-white border">
                                        <div class="icon rounded-circle mr-3 bg-success">
                                            <i class="mdi mdi-diamond-stone text-white "></i>
                                        </div>

                                        <div class="media-body align-self-center">
                                            <h4 class="text-primary mb-2">1450</h4>
                                            <p>Total Sales</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">

                                    <!-- Notification Table -->
                                    <div class="card card-default mb-24px">
                                        <div class="card-header justify-content-between mb-1">
                                            <h2>Latest Notifications</h2>
                                            <div>
                                                <button class="text-black-50 mr-2 font-size-20"><i
                                                        class="mdi mdi-cached"></i></button>
                                                <div
                                                    class="dropdown show d-inline-block widget-dropdown">
                                                    <a class="dropdown-toggle icon-burger-mini"
                                                        href="#" role="button"
                                                        id="dropdown-notification"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        data-display="static"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdown-notification">
                                                        <li class="dropdown-item"><a
                                                                href="#">Action</a></li>
                                                        <li class="dropdown-item"><a
                                                                href="#">Another action</a></li>
                                                        <li class="dropdown-item"><a
                                                                href="#">Something else here</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body compact-notifications" data-simplebar
                                            style="height: 434px;">
                                            <div
                                                class="media pb-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                    <i
                                                        class="mdi mdi-cart-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3 ">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New Order</a>
                                                    <p>Selena has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                                    <i
                                                        class="mdi mdi-email-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New Enquiry</a>
                                                    <p>Phileine has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 9
                                                    AM</span>
                                            </div>


                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                    <i
                                                        class="mdi mdi-stack-exchange font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">Support Ticket</a>
                                                    <p>Emma has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                    <i
                                                        class="mdi mdi-cart-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New order</a>
                                                    <p>Ryan has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                                    <i
                                                        class="mdi mdi-calendar-blank font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="">Comapny Meetup</a>
                                                    <p>Phileine has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                    <i
                                                        class="mdi mdi-stack-exchange font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">Support Ticket</a>
                                                    <p>Emma has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 10
                                                    AM</span>
                                            </div>

                                            <div
                                                class="media py-3 align-items-center justify-content-between">
                                                <div
                                                    class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                                    <i
                                                        class="mdi mdi-email-outline font-size-20"></i>
                                                </div>
                                                <div class="media-body pr-3">
                                                    <a class="mt-0 mb-1 font-size-15 text-dark"
                                                        href="#">New Enquiry</a>
                                                    <p>Phileine has placed an new order</p>
                                                </div>
                                                <span class=" font-size-12 d-inline-block"><i
                                                        class="mdi mdi-clock-outline"></i> 9
                                                    AM</span>
                                            </div>

                                        </div>
                                        <div class="mt-3"></div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <!-- Recent Order Table -->
                                    <div class="card card-default card-table-border-none ec-tbl"
                                        id="recent-orders">
                                        <div class="card-header justify-content-between">
                                            <h2>Recent Orders</h2>

                                            <div class="date-range-report">
                                                <span></span>
                                            </div>
                                        </div>

                                        <div class="card-body pt-0 pb-0 table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order_ID</th>
                                                        <th>Product_Name</th>
                                                        <th>Units</th>
                                                        <th>Order_Date</th>
                                                        <th>Order_Cost</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>24541</td>
                                                        <td>
                                                            <a class="text-dark" href=""> Coach
                                                                Swagger</a>
                                                        </td>
                                                        <td>1 Unit</td>
                                                        <td>Oct 20, 2018</td>
                                                        <td>$230</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-success">Completed</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div
                                                                class="dropdown show d-inline-block widget-dropdown">
                                                                <a class="dropdown-toggle icon-burger-mini"
                                                                    href="" role="button"
                                                                    id="dropdown-recent-order1"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    data-display="static"></a>

                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdown-recent-order1">
                                                                    <li class="dropdown-item">
                                                                        <a href="#">View</a>
                                                                    </li>

                                                                    <li class="dropdown-item">
                                                                        <a href="#">Remove</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>24541</td>
                                                        <td>
                                                            <a class="text-dark" href=""> Toddler
                                                                Shoes, Gucci Watch</a>
                                                        </td>
                                                        <td>2 Units</td>
                                                        <td>Nov 15, 2018</td>
                                                        <td>$550</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-warning">Delayed</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div
                                                                class="dropdown show d-inline-block widget-dropdown">
                                                                <a class="dropdown-toggle icon-burger-mini"
                                                                    href="#" role="button"
                                                                    id="dropdown-recent-order2"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    data-display="static"></a>

                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdown-recent-order2">
                                                                    <li class="dropdown-item">
                                                                        <a href="#">View</a>
                                                                    </li>

                                                                    <li class="dropdown-item">
                                                                        <a href="#">Remove</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>24541</td>
                                                        <td>
                                                            <a class="text-dark" href=""> Hat Black
                                                                Suits</a>
                                                        </td>
                                                        <td>1 Unit</td>
                                                        <td>Nov 18, 2018</td>
                                                        <td>$325</td>
                                                        <td>
                                                            <span class="badge badge-warning">On
                                                                Hold</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div
                                                                class="dropdown show d-inline-block widget-dropdown">
                                                                <a class="dropdown-toggle icon-burger-mini"
                                                                    href="#" role="button"
                                                                    id="dropdown-recent-order3"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    data-display="static"></a>

                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdown-recent-order3">
                                                                    <li class="dropdown-item">
                                                                        <a href="#">View</a>
                                                                    </li>

                                                                    <li class="dropdown-item">
                                                                        <a href="#">Remove</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>24541</td>
                                                        <td>
                                                            <a class="text-dark" href=""> Backpack
                                                                Gents, Swimming Cap Slin</a>
                                                        </td>
                                                        <td>5 Units</td>
                                                        <td>Dec 13, 2018</td>
                                                        <td>$200</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-success">Completed</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div
                                                                class="dropdown show d-inline-block widget-dropdown">
                                                                <a class="dropdown-toggle icon-burger-mini"
                                                                    href="#" role="button"
                                                                    id="dropdown-recent-order4"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    data-display="static"></a>

                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdown-recent-order4">
                                                                    <li class="dropdown-item">
                                                                        <a href="#">View</a>
                                                                    </li>

                                                                    <li class="dropdown-item">
                                                                        <a href="#">Remove</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>24541</td>
                                                        <td>
                                                            <a class="text-dark" href=""> Speed 500
                                                                Ignite</a>
                                                        </td>
                                                        <td>1 Unit</td>
                                                        <td>Dec 23, 2018</td>
                                                        <td>$150</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-danger">Cancelled</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div
                                                                class="dropdown show d-inline-block widget-dropdown">
                                                                <a class="dropdown-toggle icon-burger-mini"
                                                                    href="#" role="button"
                                                                    id="dropdown-recent-order5"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    data-display="static"></a>
                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdown-recent-order5">
                                                                    <li class="dropdown-item">
                                                                        <a href="#">View</a>
                                                                    </li>

                                                                    <li class="dropdown-item">
                                                                        <a href="#">Remove</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="settings" role="tabpanel"
                        aria-labelledby="settings-tab">
                        <div class="tab-pane-content mt-5">
                            <form>
                                <div class="form-group row mb-6">
                                    <label for="coverImage"
                                        class="col-sm-4 col-lg-2 col-form-label">User Image</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <div class="custom-file mb-1">
                                            <input type="file" class="custom-file-input"
                                                id="coverImage" required>
                                            <label class="custom-file-label" for="coverImage">Choose
                                                file...</label>
                                            <div class="invalid-feedback">Example invalid custom
                                                file feedback</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">First name</label>
                                            <input type="text" class="form-control" id="firstName"
                                                value="First name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Last name</label>
                                            <input type="text" class="form-control" id="lastName"
                                                value="Last name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">User name</label>
                                    <input type="text" class="form-control" id="userName"
                                        value="User name">
                                    <span class="d-block mt-1">Accusamus nobis at omnis consequuntur
                                        culpa tempore saepe animi.</span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        value="ekka.example@gmail.com">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="oldPassword">Old password</label>
                                    <input type="password" class="form-control" id="oldPassword">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="newPassword">New password</label>
                                    <input type="password" class="form-control" id="newPassword">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="conPassword">Confirm password</label>
                                    <input type="password" class="form-control" id="conPassword">
                                </div>

                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit"
                                        class="btn btn-primary mb-2 btn-pill">Update
                                        Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection