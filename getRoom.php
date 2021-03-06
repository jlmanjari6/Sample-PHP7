<?php
$servername = "localhost";
$username = "root";
$password = "1234567";
$error= "";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (!empty($_POST["no"])) {
    $sql = "INSERT INTO project.room (no, type)
VALUES ('".intval($_POST['no'])."','".$_POST['type']."')";
    if ($conn->query($sql) === TRUE) {
        //echo "New room created successfully";
        $error = '';
    } else {
        $error =  "Error: " . $sql . "<br>" . $conn->error;
    }
}
//echo "Connected successfully";
$sql = "SELECT * FROM project.room";
$result = $conn->query($sql);
?>
  
<?php include 'header.php';?>
<div id="main">
    <div id="header">
        <div id="logo">
            <div id="logo_text">
                <!-- class="logo_colour", allows you to change the colour of the text -->
                <h1>
                    <a href="index.php">Welcome to
                        <span class="logo_colour">Pro</span>
                    </a>
                </h1>
                <h2>Simple way to organize room details</h2>
            </div>
        </div>
        <div id="menubar">
            <ul id="menu">
                <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
                <li >
                    <a href="index.php">Home</a>
                </li>
                <li >
                    <a href="person.php">Person</a>
                </li>
                <li class="selected">
                    <a href="room.php">Room</a>
                </li>
                <li>
                    <a href="key.php">Key</a>
                </li>
            </ul>
        </div>
    </div>
    <div id="site_content">
        <div class="sidebar">
        <h3>Add New Room</h3>
        <form method="post" action="getRoom.php">
            Number:<br>
            <input type="text" name="no" value="12" required>
            <br>
            Type:<br>
            <select name="type" required>
                <option value="single">single</option>
                <option value="double">double</option>
                <option value="delux">delux</option>
                <option value="standard">standard</option>
            </select>
            <br><br>
            <input type="submit" value="Submit">
            </form> 
        </div>
        <div id="content">
        <h3> Rooms List</h3>
        <table>
        <tr>
            <th>Number</th>
            <th>Type</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                echo "<tr><td>" . $row["No"]."</td><td>" . $row["type"]."</td></tr>";
            }
        } else {
            echo "0 results";
        }

        echo $error;
        ?>
        </table>
        </div>
    </div>
    
</div>

<?php include 'footer.php';

$conn->close();
?>