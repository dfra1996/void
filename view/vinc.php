

<?php 

/*<form method="POST">

<form method="POST">
    <p>
        <input type="text" name="latitude" placeholder="Enter latitude">
    </p>
 
    <p>
        <input type="text" name="longitude" placeholder="Enter longitude">
    </p>
 
    <input type="submit" name="submit_coordinates">
</form>

<?php
    if (isset($_POST["submit_coordinates"]))
    {
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        ?>
 
        <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>
 
        <?php
    }
?>*/
	require_once 'controlador/cinc.php';
	insdatos($idinc, $pg, $arc);
	mosdatos($conp, $nreg, $pg, $arc, $filtro, $bo);
?>