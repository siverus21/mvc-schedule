<div class="container">

    <h1><?= $title ?? "" ?></h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="<?= base_url('/register') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="password">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm-password</label>
                    <input class="form-control" type="password" name="confirm-password" id="confirm-password" placeholder="confirm password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>