<?php
Include("Cdb.php");
$searchCriteria = "";
$res=@$_POST['research'];
if($res!="")
{
    $searchCriteria="WHERE jobTitle LIKE '%$res%'";
}
$researchShoeName = "SELECT rating, compagnyName, jobTitle, salaryCHF, location, image, salary FROM t_informations $searchCriteria ORDER BY salaryCHF DESC LIMIT 200";

?>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INDI LIST</title>
</head>
<div><form method="post" action="">
        Research <input type="text" name="research">
        <input type="submit">
    </form></div>
    <?php
//attendre 2 secondes
    sleep(2);
    $result = $db->query($researchShoeName)->fetch_all(MYSQLI_BOTH);
    ?><table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Rating</th>
        <th scope="col">Compagny Name</th>
        <th scope="col">Job Title</th>
        <th scope="col">Salary</th>
        <th scope="col">location</th>
        <th scope="col">Image</th>
        <th scope="col">Morning</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">
    <?php
    foreach ($result as $row) {
        ?>
        <tr>
            <th scope="row"><?php echo $row[0]; ?></th>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]." CHF" ." (".$row[6]." ₹".")"; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td class="size-24" >
                <img src="images/<?php echo $row[5]?>" alt="Affiche"/></td>
            <td>☕</td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
</html>
