@extends('layout.cms')
@section('content')
    <main class="page-content">

        <div class="card rounded-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <h6 class="mb-0">Order Activity</h6>
                    <div class="fs-5 ms-auto dropdown">
                        <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div id="chart1"></div>
            </div>
        </div>


        <div class="row row-cols-1 row-cols-lg-4">
            <div class="col">
                <div class="card rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0">2.5K</h5>
                                <p class="mb-0">Orders</p>
                            </div>
                            <div class="fs-4">
                                <i class="bi bi-basket3"></i>
                            </div>
                        </div>
                        <div id="chart2"></div>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0">14K</h5>
                                <p class="mb-0">Visits</p>
                            </div>
                            <div class="fs-4">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                        </div>
                        <div id="chart3"></div>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0">$52K</h5>
                                <p class="mb-0">Sales</p>
                            </div>
                            <div class="fs-4">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                        <div id="chart4"></div>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0">8.3K</h5>
                                <p class="mb-0">New Users</p>
                            </div>
                            <div class="fs-4">
                                <i class="bi bi-cup-hot"></i>
                            </div>
                        </div>
                        <div id="chart5"></div>
                    </div>

                </div>
            </div>

        </div><!--end row-->


        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0">Sales Goals</h6>
                            <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                                    data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="chart6"></div>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0">Total Clicks</h6>
                            <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                                    data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="chart7"></div>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0">Visits By Device</h6>
                            <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                                    data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="chart8"></div>
                    </div>
                </div>
            </div>

        </div><!--end row-->


        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0">Social Sales</h6>
                            <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                                    data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="social-leads">
                            <div class="d-flex align-items-center gap-3">
                                <div class="widget-icon bg-facebook text-white">
                                    <i class="bi bi-facebook"></i>
                                </div>
                                <div class="fs-5 flex-grow-1">
                                    <p class="mb-0">Facebook</p>
                                </div>
                                <div class="leads-count">
                                    <p class="mb-0">78 Sales</p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widget-icon bg-twitter text-white">
                                    <i class="bi bi-twitter"></i>
                                </div>
                                <div class="fs-5 flex-grow-1">
                                    <p class="mb-0">Twitter</p>
                                </div>
                                <div class="leads-count">
                                    <p class="mb-0">68 Sales</p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widget-icon bg-linkedin text-white">
                                    <i class="bi bi-linkedin"></i>
                                </div>
                                <div class="fs-5 flex-grow-1">
                                    <p class="mb-0">Linkedin</p>
                                </div>
                                <div class="leads-count">
                                    <p class="mb-0">120 Sales</p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widget-icon bg-danger text-white">
                                    <i class="bi bi-pinterest"></i>
                                </div>
                                <div class="fs-5 flex-grow-1">
                                    <p class="mb-0">Pinterest</p>
                                </div>
                                <div class="leads-count">
                                    <p class="mb-0">752 Sales</p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widget-icon bg-pink text-white">
                                    <i class="bi bi-browser-chrome"></i>
                                </div>
                                <div class="fs-5 flex-grow-1">
                                    <p class="mb-0">Chrome</p>
                                </div>
                                <div class="leads-count">
                                    <p class="mb-0">58 Sales</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0">Traffic Resources</h6>
                            <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                                    data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <tbody>
                                    <tr>
                                        <td>Direct</td>
                                        <td>$4,5627</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>4.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Search</td>
                                        <td>$3,6587</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>3.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Emails</td>
                                        <td>$8,3762</td>
                                        <td><i class="bi bi-arrow-down text-danger"></i></td>
                                        <td>5.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Socials</td>
                                        <td>$2,1842</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>1.4%</td>
                                    </tr>
                                    <tr>
                                        <td>Advertisement</td>
                                        <td>$5,2635</td>
                                        <td><i class="bi bi-arrow-down text-danger"></i></td>
                                        <td>2.8%</td>
                                    </tr>
                                    <tr>
                                        <td>Referrals</td>
                                        <td>$6,3462</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>9.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Website</td>
                                        <td>$7,2453</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>6.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Emails</td>
                                        <td>$8,3762</td>
                                        <td><i class="bi bi-arrow-down text-danger"></i></td>
                                        <td>5.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Referrals</td>
                                        <td>$6,3462</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>9.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Socials</td>
                                        <td>$2,1842</td>
                                        <td><i class="bi bi-arrow-up text-success"></i></td>
                                        <td>1.4%</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end row-->

    </main>
@endsection
