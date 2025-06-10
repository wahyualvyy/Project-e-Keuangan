<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-8">
    <div class="card w-100">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Sales Overview</h4>
                    <p class="card-subtitle">
                        Ample admin Vs Pixel admin
                    </p>
                </div>
                <div class="ms-auto">
                    <ul class="list-unstyled mb-0">
                        <li class="list-inline-item text-primary">
                            <span class="round-8 text-bg-primary rounded-circle me-1 d-inline-block"></span>
                            Ample
                        </li>
                        <li class="list-inline-item text-info">
                            <span class="round-8 text-bg-info rounded-circle me-1 d-inline-block"></span>
                            Pixel Admin
                        </li>
                    </ul>
                </div>
            </div>
            <div id="sales-overview" class="mt-4 mx-n6"></div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card overflow-hidden">
        <div class="card-body pb-0">
            <div class="d-flex align-items-start">
                <div>
                    <h4 class="card-title">Weekly Stats</h4>
                    <p class="card-subtitle">Average sales</p>
                </div>
                <div class="ms-auto">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="text-muted" id="year1-dropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-dots fs-7"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="year1-dropdown">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)">Another
                                    action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)">Something
                                    else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-4 pb-3 d-flex align-items-center">
                <span class="btn btn-primary rounded-circle round-48 hstack justify-content-center">
                    <i class="ti ti-shopping-cart fs-6"></i>
                </span>
                <div class="ms-3">
                    <h5 class="mb-0 fw-bolder fs-4">Top Sales</h5>
                    <span class="text-muted fs-3">Johnathan Doe</span>
                </div>
                <div class="ms-auto">
                    <span class="badge bg-secondary-subtle text-muted">+68%</span>
                </div>
            </div>
            <div class="py-3 d-flex align-items-center">
                <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
                    <i class="ti ti-star fs-6"></i>
                </span>
                <div class="ms-3">
                    <h5 class="mb-0 fw-bolder fs-4">Best Seller</h5>
                    <span class="text-muted fs-3">MaterialPro Admin</span>
                </div>
                <div class="ms-auto">
                    <span class="badge bg-secondary-subtle text-muted">+68%</span>
                </div>
            </div>
            <div class="py-3 d-flex align-items-center">
                <span class="btn btn-success rounded-circle round-48 hstack justify-content-center">
                    <i class="ti ti-message-dots fs-6"></i>
                </span>
                <div class="ms-3">
                    <h5 class="mb-0 fw-bolder fs-4">Most Commented</h5>
                    <span class="text-muted fs-3">Ample Admin</span>
                </div>
                <div class="ms-auto">
                    <span class="badge bg-secondary-subtle text-muted">+68%</span>
                </div>
            </div>
            <div class="pt-3 mb-7 d-flex align-items-center">
                <span class="btn btn-secondary rounded-circle round-48 hstack justify-content-center">
                    <i class="ti ti-diamond fs-6"></i>
                </span>
                <div class="ms-3">
                    <h5 class="mb-0 fw-bolder fs-4">Top Budgets</h5>
                    <span class="text-muted fs-3">Sunil Joshi</span>
                </div>
                <div class="ms-auto">
                    <span class="badge bg-secondary-subtle text-muted">+15%</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>