<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"defer></script>
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>UPDATE EMPLOYEE</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow">
            <h2 class="mb-4 text-center">UPDATE EMPLOYEE</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" name="Firstname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" name="Lastname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Assigned/Job</label>
                    <input type="text" name="job" class="form-control" required>
                </div>
                <button href="../designforSalon/Employee.php" type="submit" class="btn btn-primary">Update</button>
                <a href="../designforSalon/Employee.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>