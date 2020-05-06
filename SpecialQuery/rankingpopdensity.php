<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name = "viewport" content = "width = device-width, initial-scale =0.8"/>
        <link rel="stylesheet" href="../Select/Select_Style.css">
        <link rel="stylesheet" href="../css/insert_style.css">
        <link rel="icon" href="../css/globe.png">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 1300px)" href="../css/../css/small-device.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 1301px)" href="../css/big-device.css" />
        <title>Ranking of Population Density in year 2000</title>
    </head>

    <body style="padding:10px;width:100vw;margin:0 auto;">
        <?php 
            require "../database_linking.php";
        ?>
        <div class="toprow" style="display:flex;flex-direction: row;">
            <button onclick="window.location.href='../Select/Select_Population.php'" style="padding: 15px;">Back</button>
        </div>
        
        <div>
            <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">Ranking of Population Density of All Countries in Year 2000</h1>
        </div>
        
        <form method = "post" action="">
            <div class="outer">
                <fieldset>
                    <legend style="padding:10px;font-size:30px;">Population Density</legend>
                    <label for = "Population">Select Order : </label></br></br>
                    <div>
                    <input type="radio" id="Ascending" name="order" value= "ascending" required>
                    <label for ="ascending"><span style='font-weight:bold'>Ascending</span></label></div>
                    <div>
                    <input type="radio" id="Descending" name="order" value= "descending" required>
                    <label for ="descending"><span style='font-weight:bold'>Descending</span></label></div>
                    <br>
                    <input type = "submit" name = "submit" value = "Submit">
                </fieldset>
            </div>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                if($_POST['order'] == 'ascending')
                {
                    $sql = "SELECT country_name.CountryName,(population.PopulationCountry)/(geographical_information.SurfaceArea) FROM geographical_information INNER JOIN country_name INNER JOIN population ON (country_name.CountryCode=geographical_information.CountryCode) AND (country_name.CountryCode=population.CountryCode) GROUP BY country_name.CountryName ORDER BY (population.PopulationCountry)/(geographical_information.SurfaceArea) ASC";
                }
                else if($_POST['order'] == 'descending')
                {
                    $sql = "SELECT country_name.CountryName,(population.PopulationCountry)/(geographical_information.SurfaceArea) FROM geographical_information INNER JOIN country_name INNER JOIN population ON (country_name.CountryCode=geographical_information.CountryCode) AND (country_name.CountryCode=population.CountryCode) GROUP BY country_name.CountryName ORDER BY (population.PopulationCountry)/(geographical_information.SurfaceArea) DESC";
                }
                else{
                    $sql = "SQL is not set";
                }

                if($conn -> connect_error)
                {
                    die("Connection failed:" .$conn -> connect_error);
                }
                else
                {
                    $data = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($data);
                    $x =1;
                    echo "<table class=container>";
                    echo "<tr><th>No.</th><th>Country Name</th><th>Population Density</th></tr>";
                    echo "<tr><td>";
                        echo $x;
                        echo "</td><td>";
                        echo $result['CountryName'];
                        echo "</td><td>";
                        echo $result['(population.PopulationCountry)/(geographical_information.SurfaceArea)'];
                        echo "</td></tr>";
                        
                    while($result = mysqli_fetch_assoc($data))
                    {
                        echo "<tr><td>";
                        echo ++$x;
                        echo "</td><td>";
                        echo $result['CountryName'];
                        echo "</td><td>";
                        echo $result['(population.PopulationCountry)/(geographical_information.SurfaceArea)'];
                        echo "</td></tr>";
                    }

                    echo "</table>";
                    $conn -> close();
                }
            }
        ?>
    </body>
</html>