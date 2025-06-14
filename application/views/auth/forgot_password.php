<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>Forgot Password</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('message')) : ?>
                            <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/send_reset_link') ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter your email address</label>
                                <input type="email" class="form-control" name="email" required placeholder="your@email.com">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="<?= base_url('auth/login') ?>">Back to login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>