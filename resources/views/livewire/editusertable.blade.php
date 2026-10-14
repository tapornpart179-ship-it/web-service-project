<div>
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0 fs-3">Form Validation</h1>
                    </div>
                    <div class="col-sm-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Validation</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">


                    <!-- Custom validation -->
                    <div class="col-lg-6">
                        <div class="card card-info card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">การเเก้ไขข้อมูลผู้ใช้</div>
                            </div>
                            <form wire:submit.prevent="updateuser" class="needs-validation" novalidate>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Name</label>
                                            <input type="text" wire:model="name" class="form-control"
                                                id="validationCustom01" value="Mark" required />
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Email</label>
                                            <input type="email" wire:model="email" class="form-control"
                                                id="validationCustom02" value="mark@example.com" required />
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom03" class="form-label">Password</label>
                                            <input type="password" wire:model="password" class="form-control"
                                                id="validationCustom03" value="Mark" required />
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="invalidCheck" required />
                                                <label class="form-check-label" for="invalidCheck">
                                                    Agree to terms and conditions
                                                </label>
                                                <div class="invalid-feedback">You must agree before submitting.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-info" type="submit">Submit form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
</div>
</div>
</div>
</div>
</main>
</div>
