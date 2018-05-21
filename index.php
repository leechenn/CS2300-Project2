<?php
$year_releasedError = $artist_nameError = $add_error=$year_released_add_Error=$artist_name_add_Error=$album_add_Error=$song_add_Error="";
$input_reminder = "You can either fill in one of the blanks or both of them to do a seach";
$success_add="";
$addsong=FALSE;
$hasrecord=FALSE;
$db = new PDO('sqlite:data.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// if the genre side bar is clicked, GET genre and filter it
if (isset($_GET['genre'])) {
  $genre = filter_input(INPUT_GET, 'genre', FILTER_SANITIZE_STRING);

} else {
  $genre = NULL;
}
// if search form is submitted, get information in text field and filter them
if(isset($_POST["submit_search"])){
// remove white blanks in the two sides of input text
  $artist_name = trim($_POST["artist_name"]);
  $year_released = trim($_POST["year_released"]);
// if user do not fill in any one of the blanks, give the user a reminder
  if(empty($artist_name) && empty(  $year_released)){
    $input_reminder="please fill in at least one of the blanks for search";
  }
// if user fill in one of the blanks, filter user input and tell user whether the input is a legal input
  else{
    if (!empty($artist_name) && !filter_var($artist_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[-' $*&a-zA-Z]{1,100}$/")))) {
      $artist_name=NULL;
      $artist_nameError="Please enter a valid artist name";
    }
    if (!empty($year_released)){
      if(!filter_var($year_released, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}$/")))||$year_released>2018)
      {
        $year_released=NULL;
        $year_releasedError="Please enter correct format for year (should earlier than 2018)";
      }
    }
  }
}
else{

  $artist_name = NULL;
  $year_released=NULL;
}
// if show all music is clicked, all music will be showed up
if((empty($artist_name) && empty($year_released)&&empty($genre))||isset($_POST["searchall"])){
  $sql = "SELECT * FROM music";
  $query = $db->prepare($sql);
  if ($query) {
    $query->execute();
    $records = $query->fetchAll();
  }
  if(isset($records) && !empty($records)){
    $input_reminder="All songs in catalog are shown below, please check it!";
  }
}
else{
  if(!empty($genre)){
    $genre=strtolower($genre);
    $sql = "SELECT * FROM music WHERE lower(song_genre) = :genre ";
    $params = array(':genre' => $genre);
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      $records = $query->fetchAll();

    }
  }
  // if user input a artist name that has space between letter, it is also permitted and can return what they are searching
  if(!empty($artist_name) && empty($year_released)){
    $artist_name=strtolower($artist_name);
    $sql = "SELECT * FROM music WHERE lower(replace(song_artist,' ','')) LIKE '%' || replace(:artist_name,' ','') || '%' ";
    $params = array(':artist_name' => $artist_name);
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      $records = $query->fetchAll();

    }
  }
  if(empty($artist_name) && !empty($year_released)){
    $sql = "SELECT * FROM music WHERE song_year = :year_released ";
    $params = array(':year_released' => $year_released);
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      $records = $query->fetchAll();

    }
  }
  if(!empty($artist_name) && !empty($year_released)){
    $artist_name=strtolower($artist_name);
    $sql = "SELECT * FROM music WHERE lower(replace(song_artist,' ','')) LIKE '%' || replace(:artist_name,' ','') || '%' AND song_year = :year_released";
    $params = array(':artist_name' => $artist_name,':year_released' => $year_released);
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      $records = $query->fetchAll();

    }
  }
  if(isset($records) && !empty($records)){
    $input_reminder="Congratulation! search successfully, please check the catalog below for data!";
  }
  else{
    $input_reminder="Oops... No result for your search, please search again";
  }
}
if(isset($_POST["submit_add"])){
  $artist_name_add = trim($_POST["artist_name_add"]);
  $song_add = trim($_POST["song_add"]);
  $album_add = trim($_POST["album_add"]);
  $year_released_add = trim($_POST["year_released_add"]);
  $song_genre = filter_input(INPUT_POST, "song_genre", FILTER_SANITIZE_STRING);
  $song_genre = strtolower($song_genre);
  if ( !in_array($song_genre, array("blues", "classical", "country","electronic","folk","hip-hop","jazz","rock","pop","reggae")) ) {
    $song_genre = NULL;
  }
  if(empty($artist_name_add)||empty($song_add)||empty($album_add)||empty($year_released_add)||empty($song_genre)){
    $add_error="please fill in each blank";
  }
  else{
    if (!filter_var($year_released_add, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}$/")))||$year_released>2018) {
      $year_released_add=NULL;
      $year_released_add_Error="Please enter correct format for year (should earlier than 2018)";
    }
    if (!filter_var($artist_name_add, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[-' $*&a-zA-Z]{1,100}$/")))) {
      $artist_name_add=NULL;
      $artist_name_add_Error="Please enter a valid name for artist";
    }
    if (!filter_var($album_add, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[-' .$*&a-zA-Z\d]{1,100}$/")))) {
      $album_add=NULL;
      $album_add_Error="Please enter a valid name for album";
    }
    if (!filter_var($song_add, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[-' .$*&a-zA-Z\d]{1,100}$/")))) {
      $song_add=NULL;
      $song_add_Error="Please enter a valid name for song";
    }
  }
  // verify whether the song has already in catalog, prevent user from entering duplicate song in catalog
  if(!empty($artist_name_add) && !empty($song_add) && !empty($album_add) && !empty($year_released_add) && !empty($song_genre)){
    $sql_check = "SELECT * FROM music WHERE lower(replace(song_artist,' ','')) = lower(replace(:artist_name_add,' ','')) AND song_year = :year_released_add AND lower(replace(song_name,' ','')) = lower(replace(:song_add,' ',''))";
    $query_check = $db->prepare($sql_check);
    $params_check = array(':artist_name_add' => $artist_name_add,':song_add' => $song_add,':year_released_add' => $year_released_add);
    if ($query_check and $query_check->execute($params_check)) {
      $records_check= $query_check->fetchAll();
    }
    if(!empty($records_check)){
      $add_error="This song is already in your catalog, please change a song to add";
    }
    else{
      $sql = "INSERT INTO music (song_artist,song_name,song_album,song_genre,song_year) VALUES (:artist_name_add,:song_add,:album_add,:song_genre,:year_released_add)";
      $query = $db->prepare($sql);
      $params = array(':artist_name_add' => $artist_name_add,':song_add' => $song_add,':album_add' => $album_add,':song_genre' => $song_genre,':year_released_add' => $year_released_add);
      if ($query) {
        $query->execute($params);
        // $records=$query->fetchAll();
        $addsong=TRUE;
        $success_add="You just added a song to your catalog successfully!";
      }

    }
  }
}
// set up user-defined function that print data in table and escape the output
function print_data_for_each_line($eachline){
  $line="";
  foreach($eachline as $index=>$attr){
    if(is_numeric($index)||$index=="song_id")
    continue;
    $line.="<td>".htmlspecialchars($attr)."</td>";
  }
  return $line;
}
function print_data_for_all($records){
  $all="";
  foreach($records as $index=>$eachline){
    $all.="<tr>".print_data_for_each_line($eachline)."</tr>";
  }
  return $all;
}


?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Music Catalog</title>
  <link href="css/fontawesome-all.css" rel="stylesheet">
  <link href="css/mainpage.css" rel="stylesheet">
  <link href="css/font.css" rel="stylesheet">
  <script src="scripts/mainpage.js"></script>
</head>

<body>
  <?php include("includes/header.php");?>
  <div id="main_container">
    <div id="catalog">
      <h1>Music Catalog</h1>
      <p class="page-description text-center">Review Table For Your Favorite Music Catalog</p>
    </div>
    <div id="table">
      <?php
      if($addsong){
        echo "<p class='success-description'>$success_add</p>";
// if add song successfully, there will be a reminder to user, and the whole songs in catalog will be displayed
        $sql = "SELECT * FROM music";
        $query = $db->prepare($sql);
        if ($query) {
          $query->execute();
          $records = $query->fetchAll();
        }
      }
      if(isset($records) && !empty($records)){
        echo "<table>
        <tr>
        <th>Artist</th>
        <th>Song</th>
        <th>Album</th>
        <th>Genre</th>
        <th>Year</th>
        </tr>".print_data_for_all($records)."</table>";
      }
      else{
        echo "<p class='nodata-description'>Oops... No result for your search, please search again</p>";
      }

      ?>
    </div>



    <div id="add_form">
      <h1>Add Song to Your Catalog</h1>
      <form id="musicAdd_form" method="post" action="index.php#add_form">
        <ul>
          <li class="music_add">
            <label>Artist:</label>
            <input type="text" name="artist_name_add" placeholder="&#xf002; Artist Name" required/>
          </li>
          <li class="music_add">
            <label>Song:</label>
            <input type="text" name="song_add" placeholder="&#xf002; Song Name" required/>
          </li>
          <li class="music_add">
            <label>Album:</label>
            <input type="text" name="album_add" placeholder="&#xf002; Album Name" required/>
          </li>
          <li class="music_add">
            <label>Genre:</label>
            <select name="song_genre" required>
              <option value="" selected disabled>Choose Genre</option>
              <option value="Blues">Blues</option>
              <option value="Classical">Classical</option>
              <option value="Country">Country</option>
              <option value="Electronic">Electronic</option>
              <option value="Pop">Pop</option>
              <option value="Reggae">Reggae</option>
              <option value="Folk">Folk</option>
              <option value="Hip-hop">Hip-hop</option>
              <option value="Jazz">Jazz</option>
              <option value="Rock">Rock</option>
            </select>
          </li>
          <li class="music_add">
            <label>Year:</label>
            <input type="text" name="year_released_add" placeholder="&#xf002; Year Released" required/>
          </li>
        </ul>
        <ul>
          <li class="music_add_bnt">
            <input id="add_button" type="submit" name="submit_add" value="Add to Catalog"/>
          </li>
          <li class="music_add_bnt">
            <input id="clear_button" type="reset" name="reset_add" value="Reset"/>
          </li>
        </ul>
      </form>
      <div id="add_error">
<!-- reminder to user when they submit the add song form -->
        <ul>
          <li><?php echo $artist_name_add_Error?></li>
          <li> <?php echo $song_add_Error?></li>
          <li><?php echo $album_add_Error?></li>
          <li> <?php echo $year_released_add_Error?></li>
          <li><?php echo $add_error?></li>
          <li><?php echo$success_add?></li>
        </ul>
      </div>
    </div>
    <div id="back_top">
      <a href="#head" id="arrow" ><i class="fas fa-arrow-up"></i></a>
    </div>
  </div>

  <?php include("includes/footer.php");?>
</body>
</html>
