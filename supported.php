<?php require("class/Output.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require("include/head.html"); ?>
</head>
<body>
    <header>
        <?php require("include/header.php"); ?>
    </header>
    <body>
        <?php require("include/banner.html"); ?>
        <section class="section">
            <div class="container">
                <div class="column is-offset-one-third is-one-third">
                    <h2 class="is-size-6 has-text-centered">
                        Updated as of : <?php  echo date("Y-m-j h:i" ,filemtime("rates.json")); ?>
                    </h2>
                    <div class="box">
                        <table class="table is-bordered is-fullwidth">
                            <tr>
                                <th>Currency</th>
                                <th>Rate</th>
                            </tr>
                            <?php 
                            foreach (Output::getSupportedRates() as $rate => $array) : 
                                foreach ($array as $symbol => $detail) :
                            ?>
                            <tr>
                                <td><?php echo "({$rate}) {$detail}"; ?></td>
                                <td><?php echo $symbol . Output::fetchRate($rate); ?></td>
                            </tr>
                            <?php 
                                endforeach;
                            endforeach; 
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <footer class="footer">
        <div class="container">
            <?php require_once("include/footer.html"); ?>
        </div>
    </footer>
</body>
</html>