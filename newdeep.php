<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, intial-scale=1.0">
     <link rel="stylesheet" href="new.css">
</head>
<body>
<table >
        <?php
        session_start();
        function in()
        {
            $_SESSION['gen'] = mt_rand(0, 100);
            $_SESSION['x'] = null;
            $_SESSION['pg'] = '';
            $_SESSION['tl'] = 0;
        }


        function tl()
        {
            return (5 - $_SESSION['tl']);
        }
        function rt()
        {
            unset($_SESSION['gen']);
            in();
        }
        $play_game = false;
      
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_REQUEST['start'])) {
                in();
                $play_game = true;
      
            } elseif (isset($_REQUEST['res'])) {
                rt();
                $play_game = true;
      
            } elseif (!empty($_REQUEST['check'])) {
                $play_game = true;
                $_SESSION['x'] = $_REQUEST['Inp'];
      
            }
      
        }
        ?><tr>
            <td>
      
            <?php if ($play_game) : ?>
                
                <form method="POST">
                        <h1 style="text-align:center;">Enter any number b/w 0 to 100</h1>
      
                        <input type="number" autoin name="Inp">
      
                        <input type="submit" name="check" value="Check Value">
      
                        <br><br>
                    </td>
      
                </tr>
      
                <tr>
      
                <td>
      
      
                <p><label><b>RESULT:- </b></label></p>
      
            </form>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    echo "<br>";
                    if ($play_game and $_SESSION['x'] != '') {
                        $try_left = tl();
                        if ($try_left != 0 and $try_left > 0) {
                  
                            if ($_SESSION['x'] > $_SESSION['gen']) {
                  
                                echo "<h3>", $_SESSION['pg'] .= "<br>Your guess is too <b>HIGH</b>. Tries Left :- " . $try_left, "</h3>";
                  
                            } elseif (($_SESSION['x'] < $_SESSION['gen']) and ($_SESSION['x'] != null)) {
                  
                                echo "<h3>", $_SESSION['pg'] .= "<br>Your guess is too <b>LOW</b>. Tries Left :- " . $try_left, "</h3>";
                  
                            } elseif ($_SESSION['x'] == $_SESSION['gen']) {
                  
                                echo "<h3>", $_SESSION['pg'] .= "<br>Your guess " . $_SESSION['x'] . " is <b>CORRECT</b>. Tries left :- " . $try_left, "</h3>";
                                in();
                                echo "<br>Restarting...";
                                header("Refresh:5");
                            }
                        } else {
                            $play_game = true;
                            
                            echo "<h1><b>You Lost</b>, The Correct answer Was ", $_SESSION['gen'], "<br></h1>";
                        }
                        $_SESSION['tl']++;
                    }
                ?></td>
        </tr>
    <?php else : ?>
        <form method="POST">
            <input class="str" type="submit" name="start" value="START">
        </form>
    <?php endif; ?>
    <?php ?>
</table>
</body>
</html>
