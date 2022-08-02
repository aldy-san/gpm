<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Test Table</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <!--<div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>-->
        </div>
    </div>
    <section class="section mt-4">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('/tes/create'); ?>" class="btn btn-success">Add item</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <td><?= $u->email; ?></td>
                            <td><?= $u->username; ?></td>
                            <td>
                                <a href="<?= base_url('/tes/edit/'.$u->id); ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('/tes/delete/'.$u->id); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>