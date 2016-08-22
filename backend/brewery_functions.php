<?php
function list_breweries()
{
    try {
        $pdo = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->exec("set names utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM hcb_brewery');
        $stmt->execute();

        echo "<table border='1'>";

        /**
         * header
         */
        echo '<tr>';
        foreach ($GLOBALS['fields_array'] as $field) {
            echo '<td>' . $field . '</td>';
        }
        echo '</tr>';

        while ($data = $stmt->fetch()) {
            echo '<tr>';
            foreach ($GLOBALS['fields_array'] as $field) {
                if (in_array($field, $GLOBALS['url_fields_array'])) {
                    echo '<td><a href="' . $data[$field] . '"/>[link]</a></td>' . "\n";
                } else {
                    echo '<td>' . $data[$field] . '</td>' . "\n";
                }
            }
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="brewery_id" value="' . $data['brewery_id'] . '">';
            echo '<td><input type="submit" name="' . SUBMIT_MODIFY . '" value="' . SUBMIT_MODIFY . '"/></td>';
            echo '<td><input type="submit" name="' . SUBMIT_DELETE . '" value="' . SUBMIT_DELETE . '"/></td>';
            echo '</form>';

            echo '</tr>';
        }

        echo "</table>";

        $pdo = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function add_brewery($POST)
{
    try {
        $pdo = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->exec("set names utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO hcb_brewery (brewery_name, brewery_fb,  brewery_instagram, brewery_twitter, brewery_web, brewery_mail, brewery_phone, brewery_address, brewery_untappd, brewery_ratebeer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(1, $POST[FIELD_BREWERY_NAME], PDO::PARAM_STR);
        $stmt->bindParam(2, $POST[FIELD_BREWERY_FB], PDO::PARAM_STR);
        $stmt->bindParam(3, $POST[FIELD_BREWERY_INSTAGRAM], PDO::PARAM_STR);
        $stmt->bindParam(4, $POST[FIELD_BREWERY_TWITTER], PDO::PARAM_STR);
        $stmt->bindParam(5, $POST[FIELD_BREWERY_WEB], PDO::PARAM_STR);
        $stmt->bindParam(6, $POST[FIELD_BREWERY_MAIL], PDO::PARAM_STR);
        $stmt->bindParam(7, $POST[FIELD_BREWERY_PHONE], PDO::PARAM_STR);
        $stmt->bindParam(8, $POST[FIELD_BREWERY_ADDRESS], PDO::PARAM_STR);
        $stmt->bindParam(9, $POST[FIELD_BREWERY_UNTAPPD], PDO::PARAM_STR);
        $stmt->bindParam(10, $POST[FIELD_BREWERY_RATEBEER], PDO::PARAM_STR);

        $stmt->execute();

        $pdo = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function delete_brewery($brewery_id)
{
    try {
        $pdo = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->exec("set names utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('DELETE FROM hcb_brewery WHERE brewery_id = ?');
        $stmt->bindParam(1, $brewery_id, PDO::PARAM_STR);

        $stmt->execute();

        $pdo = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function new_form()
{
    echo '<form method="post" action=""><table>';
    foreach ($GLOBALS['fields_array'] as $field) {
        echo '<tr><td>' . $field . '</td><td><input type="text" name="' . $field . '" id="' . $field . '"></td></tr>';
    }
    echo '<tr><td><input type="submit" value="' . SUBMIT_DEFAULT . '"></td></tr></table></form>';
}