<?= view('layout/header') ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Add Customer</h2>
    <div class="card shadow-sm p-4">
        <form action="<?= base_url('customers/store') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Customer Name</label>
                    <input type="text" name="name" class="form-control" id="name" required placeholder="Enter company name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" required placeholder="Enter phone number">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required placeholder="Enter email address">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" id="address" placeholder="Enter physical address"></textarea>
                </div>
            </div>

            <h4 class="mt-4">Representatives</h4>
            <div id="representatives" class="row">
                <div class="col-md-12 mb-4 representative-group">
                    <div class="card shadow-sm p-3">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="representative-name" class="form-label">Name</label>
                                <input type="text" name="representatives[0][name]" class="form-control" required placeholder="Enter representative's name">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="representative-surname" class="form-label">Surname</label>
                                <input type="text" name="representatives[0][surname]" class="form-control" required placeholder="Enter representative's surname">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="representative-phone" class="form-label">Phone</label>
                                <input type="text" name="representatives[0][phone]" class="form-control" placeholder="Enter phone (optional)">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="representative-email" class="form-label">Email</label>
                                <input type="email" name="representatives[0][email]" class="form-control" placeholder="Enter email (optional)">
                            </div>
                            <div class="col-md-1 d-flex justify-content-center align-items-center mb-3">
                                <button type="button" class="btn btn-danger btn-sm remove-representative">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-start mb-3">
                <button type="button" id="add-representative" class="btn btn-outline-primary">
                    <i class="bi bi-person-plus"></i> Add Representative
                </button>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4 py-2">Save Customer</button>
                <a href="<?= base_url('customers') ?>" class="btn btn-secondary ms-2 px-4 py-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    $('#add-representative').click(function() {
        const repCount = $('.representative-group').length;
        const newRepGroup = `
            <div class="col-md-12 mb-4 representative-group">
                <div class="card shadow-sm p-3">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="representative-name" class="form-label">Name</label>
                            <input type="text" name="representatives[${repCount}][name]" class="form-control" required placeholder="Enter representative's name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="representative-surname" class="form-label">Surname</label>
                            <input type="text" name="representatives[${repCount}][surname]" class="form-control" required placeholder="Enter representative's surname">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="representative-phone" class="form-label">Phone</label>
                            <input type="text" name="representatives[${repCount}][phone]" class="form-control" placeholder="Enter phone (optional)">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="representative-email" class="form-label">Email</label>
                            <input type="email" name="representatives[${repCount}][email]" class="form-control" placeholder="Enter email (optional)">
                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center mb-3">
                            <!-- Delete Icon at the Very Right -->
                            <button type="button" class="btn btn-danger btn-sm remove-representative">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#representatives').append(newRepGroup);

        $(newRepGroup).find('.remove-representative').click(function() {
            $(newRepGroup).remove();
        });
    });

    $(document).on('click', '.remove-representative', function() {
        const repCount = $('.representative-group').length;
        if (repCount > 1) {
            $(this).closest('.representative-group').remove();
        } else {
            alert("At least one representative is required.");
        }
    });
</script>

<?= view('layout/footer') ?>
