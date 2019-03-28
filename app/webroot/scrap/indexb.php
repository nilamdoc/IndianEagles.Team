<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__.'/scrapb.php';

if (isset($_POST['submit']))
{
    $data = new Data\Scrap($_REQUEST);
    $scrap = $data->initialize();
    if($scrap)
    {
        echo "CSV created successfully";
    }
    else{
        echo "Error in create CSV";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h2>Modicare</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-data">
                <div class="form-group">
                    <label for="month">Month:</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">SELECT MONTH</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">SELECT YEAR</option>
                        <?php for($i=0; $i < 3; $i++): ?>
                            <?php 
                                $year = date('Y',strtotime(" - ".$i." year"));
                            ?>
                            <option value="<?php echo $year ?>"><?php echo $year ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
            <div id="success-message"></div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#form-data').validate({ // initialize the plugin
                    rules: {
                        month: {
                            required: true
                        },
                        year: {
                            required: true
                        }
                    }
                });

            });
        </script>
    </body>
</html>

