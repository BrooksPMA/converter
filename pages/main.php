<!doctype html>
<html lang="en" style="height: 100%">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Конвертов валют!</title>
</head>

<body style="min-height: 100%" >
    <div class="container h-100" >
        <div class="row h-100" >
            <div class="col-sm-12 my-auto">
                <div class="card mx-auto" style="max-width: 400px;">
                    <form action="" method="get">
                        <div class="card-header">
                            КонвертОр валют
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="from">
                                    <h4>Из: </h4>
                                </label>
                                <select class="form-control" name="from">
                                    <?php foreach ($res as $key => $value) { ?>
                                        <option value="<?= $value ?>" <?= $_GET['from'] == $value ? "selected" : "" ?>><?=  $converter->getCurrencyName($value); ?></option>
                                    <?php } ?>
                                </select> <br>
                                <label for="to">
                                    <h4>В: </h4>
                                </label>
                                <select class="form-control" name="to">
                                    <?php foreach ($res as $key => $value) { ?>
                                        <option value="<?= $value ?>" <?= $_GET['to'] == $value ? "selected" : "" ?>><?= $converter->getCurrencyName($value); ?></option>
                                    <?php } ?>
                                </select> <br>
                                <label for="sum">
                                    <h4>Сумма:</h4>
                                </label>
                                <input class="form-control" id="sum" type="text" name="sum" value='<?= $_GET['sum'] ?>'> <br>
                                <?php if (isset($badMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $badMessage; ?>
                                    </div>
                                <?php } elseif (isset($succesMessage)) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $succesMessage; ?>
                                    </div>
                                <?php } elseif (isset($warningMessage)) { ?>
                                    <div class="alert alert-warning" role="alert">
                                        <?php echo $warningMessage; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer mx-auto text-right">
                            <input class="btn btn-primary" type="submit" value="Отправить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <
</body>

</html>