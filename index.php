<?php 
session_start();
require("class/Exchange.php");
require("class/Rates.php"); 
date_default_timezone_set("asia/tokyo");
$message = "";
try {
    // 
    if (false === Rates::isValid()) {
        // 
        Rates::cacheRates();
    }
    // 
    if ("POST" == $_SERVER['REQUEST_METHOD']) {
        // 
        $message = Exchange::compute($_POST);
    }
    // 
} catch (Exception $e) {
    // 
    $_SESSION['message'] = $e->getMessage();
    header("location:index.php?error=on");
}

?>
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
                <div class="column is-one-third is-offset-one-third">
                    <h2 class="is-size-6 has-text-centered">
                        Updated as of : <?php  echo date("Y-m-j h:i" ,filemtime("rates.json")); ?>
                    </h2>
                    <div class="box">
                        <form action="index.php" method="post">
                            <label for="from" class="label">
                                Exchange from
                            </label>
                            <div class="field">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="currency1" id="currency1">
                                            <?php 
                                            foreach (Output::getSupportedRates() as $rateCode => $array) : 
                                                foreach ($array as $symbol => $detail) :
                                            ?>
                                            <option value="<?php echo $rateCode; ?>"<?php echo isset($_POST['currency1']) && $rateCode === $_POST['currency1'] ? "selected" : null; ?>><?php echo "{$symbol} {$detail}"; ?></option>
                                            <?php
                                                endforeach;
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control is-expanded">
                                    <input type="number" class="input" placeholder="Place amount" id="from" name="amount" value="<?php echo isset($_POST['amount']) ? htmlspecialchars($_POST['amount'], ENT_QUOTES) : null; ?>" >
                                </div>
                            </div>
                            <label for="to" class="label">
                                Exchange to
                            </label>
                            <div class="field">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="currency2" id="currency2">
                                            <?php 
                                            foreach (Output::getSupportedRates() as $rateCode => $array) : 
                                                foreach ($array as $symbol => $detail) :
                                            ?>
                                            <option value="<?php echo $rateCode; ?>"<?php echo isset($_POST['currency2']) && $rateCode === $_POST['currency2'] ? "selected" : null; ?>><?php echo "{$symbol} {$detail}"; ?></option>
                                            <?php
                                                endforeach;
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-expanded">
                                <input type="submit" class="button is-fullwidth is-primary">
                            </div>
                        </form>
                    </div>
                    <?php if (isset($_GET['error']) && "on" === $_GET['error']) : ?>
                    <article class="message is-danger">
                        <div class="message-body">
                            <p><?php echo $_SESSION['message']; ?></p>
                        </div>
                    </article>
                    <?php elseif ("" !== $message && "POST" == $_SERVER['REQUEST_METHOD']): ?>
                    <article class="message is-success">
                        <div class="message-body">
                            <p><?php echo $message; ?></p>
                        </div>
                    </article>
                    <?php else : ?>
                    <article class="message">
                        <div class="message-body">
                            <p>Please enter amount</p>
                        </div>
                    </article>
                    <?php endif; ?>
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