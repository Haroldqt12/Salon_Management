<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col py-1">
                <div class="card p-5 shadow">
                    <div class="col-sm-4 mb-3">
                        <a href="../designforSalon/home.php"><button class="btn btn-sm btn-primary">Add new Employee</button></a>
                        <a href="../designforSalon/home.php"><button class="btn btn-sm btn-secondary">Cancel</button></a>
                    </div>
                    <form action="">
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="Firstname" class="form-label">First name</label>
                                    <input type="text" id="Firstname" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4 offset-sm-1">
                                <div class="form-group">
                                    <label for="Lastname" class="form-label">Last name</label>
                                    <input type="text" id="Lastname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="job" class="form-label">Assigned/Job</label>
                                    <select id="job" class="form-control">
                                        <option value="">Select Job</option>
                                        <option value="developer">Hair Stylist</option>
                                        <option value="designer">Cashier</option>
                                        <option value="manager">Utilities</option>
                                        <option value="manager">Assistant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 offset-sm-1">
                                <div class="form-group">
                                    <label for="number" class="form-label">Contact</label>
                                    <input type="text" id="number" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
