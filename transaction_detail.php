<?php
include('conn.php');
include("login_check.php");

include('head.php');


function refid($id)
{
    global $conn;
    $cr_acct = "SELECT * FROM ledgers JOIN accounts ON ledgers.account=accounts.ac_id WHERE ledgers.led_id='{$id}'";
    $get_acct = mysqli_query($conn, $cr_acct);
    $acct_row = mysqli_fetch_assoc($get_acct);
    return $acct_row['ac_name'];
}

?>

<table class="table table-hover" id="get_detail">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Narration</th>
            <th>Credit Acct.</th>
            <th>Debit Acct.</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = $_GET['id'];

        //WHERE 1 = empty;
        $query = "SELECT * FROM ledgers JOIN accounts ON ledgers.account=accounts.ac_id WHERE account='{$id}' AND led_date BETWEEN CURDATE() - INTERVAL 2 DAY AND CURDATE() ORDER BY ledgers.led_date DESC";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

        ?>
                <tr>
                    <td><?php echo $row['led_id']; ?></td>
                    <td><?php echo $row['led_date']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <?php
                        echo refid($row['ref_entry']);
                        ?>
                    </td>
                    <td><strong><?php echo $row['ac_name']; ?></strong></td>
                    <td><?php if ($row['type'] == 'D') {
                            echo number_format($row['amount']);
                        } ?></td>
                    <td>
                        <?php if ($row['type'] == 'C') {
                            echo number_format($row['amount']);
                        } ?>
                    </td>
                </tr>
        <?php

            }
        } else {
            echo "0 results";
        }
        mysqli_close($conn);

        ?>
    </tbody>
</table>