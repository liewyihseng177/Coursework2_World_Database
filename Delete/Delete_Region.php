<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/Insert_Style_WJ.css">';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/small-device.css" />';
    echo '<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />';
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Delete Region</title>';
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // collect value of input field
        $r_name = $_GET['Region_ID'];
    }
?>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale = 0.8"/>
    </head>
        <body style="padding:10px;width:100vw;margin:0 auto;">
            <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='javascript:window.history.back()'" style="padding: 15px;font-size:20px;">BACK</button>
            </div>
            <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Delete Region</h1>
            </div>
            <form id="DeleteRegionForm" action="Delete_Region.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <?php
                            echo "<div class='outer'>
                            <fieldset>
                            <legend style='padding:20px;font-size:40px;'>Delete Region</legend>
                            <label for='region_name' style='padding:10px;font-size:30px;'>Region Name :</label></br></br></br>";
                            $sql = "SELECT country_region.RegionID,country_region.RegionName FROM `country_region` ORDER BY `RegionID` ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo    "<select id='regionID' form='DeleteRegionForm' name='regionID' required>"	;
                                if ($r_name!=NULL)
                                {
                                    $query="SELECT country_region.RegionID,country_region.RegionName FROM `country_region` where RegionID='$r_name'";
                                    $s_result = $conn->query($query);
                                    $s_row = $s_result->fetch_assoc();
                                    echo    "<option value='". utf8_encode($s_row["RegionID"])."' selected>". utf8_encode($s_row["RegionName"])."</option>"    ;
                                }
                                else
                                echo    "<option value='' disabled selected>Select your option</option>"    ;
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option value=". utf8_encode($row["RegionID"]).">"
                                                            . utf8_encode($row["RegionName"]).
                                            "</option>";
                                }
                                echo "</select></br></br><input type = 'submit' name = 'submit' value = 'Submit'>
                                        </fieldset>
                                    </div>";
                            }
                            ?>
                            
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $r_name = $_POST['regionID'];
                    $sql = "DELETE FROM country_region WHERE country_region.RegionID = $r_name";
                    $conn->query($sql);
                    echo "<div class='outer_insert'>
                                        <fieldset>
                                        <legend style='padding:20px;font-size:40px;'>Notice</legend>
                                        Successfully updated the data.
                                        </fieldset>
                                        </div>";
                }
            ?>
        </div>
    </body>
</html>