<?= view('layout/header') ?>

<div class="container mt-5">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (empty($customers)): ?>
        <div class="jumbotron text-center p-4">
            <h4>No Customers Found</h4>
            <p>Create some customers to get started!</p>
            <a href="<?= base_url('customers/create') ?>" class="btn btn-primary">Create Customer</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($customers as $customer): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($customer['name']) ?></h5>
                            <p><strong>Phone:</strong> <?= esc($customer['phone']) ?></p>
                            <p><strong>Email:</strong> <?= esc($customer['email']) ?></p>
                            <p><strong>Address:</strong> <?= esc($customer['address']) ?></p>
                            
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('customers/edit/'.$customer['id']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="<?= base_url('customers/delete/'.$customer['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                                <?php if (!empty($customer['representatives'])): ?>
                                    <button class="btn btn-info btn-sm" onclick="toggleRepresentatives(<?= $customer['id'] ?>)">
                                        <i class="bi bi-person-lines-fill"></i> Show Representatives
                                    </button>
                                <?php endif; ?>
                            </div>

                            <div id="representatives-<?= $customer['id'] ?>" class="representatives-list mt-3" style="display: none;">
                                <hr>
                                <h6>Representatives:</h6>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($customer['representatives'] as $representative): ?>
                                            <tr>
                                                <td><?= esc($representative['name']) ?> <?= esc($representative['surname']) ?></td>
                                                <td><?= esc($representative['phone']) ?></td>
                                                <td><?= esc($representative['email']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    function toggleRepresentatives(customerId) {
        $('.representatives-list').hide();
        
        $('.btn-info').html('<i class="bi bi-person-lines-fill"></i> Show Representatives');
        
        var repList = $('#representatives-' + customerId);
        var btn = repList.closest('.card-body').find('.btn-info');
        
        if (repList.is(":visible")) {
            repList.hide();
            btn.html('<i class="bi bi-person-lines-fill"></i> Show Representatives');
        } else {
            repList.show();
            btn.html('<i class="bi bi-person-lines-fill"></i> Hide Representatives');
        }
    }
</script>

<?= view('layout/footer') ?>
