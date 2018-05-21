<!-- all pictures in the header are cited from google, I've put citations under each picture when it shows up -->
<!-- users can click the side bar on the right side of the header to choose the genre of music they want to search -->

<header >
  <div id="head" >
    <div class="slide" id="slide">
      <div class="cover" id="cover">
      </div>
      <div class="headtext" id="headtext">
        <div id="search_form">
          <form id="musicSearch_form" method="post" action="index.php">
            <ul>
              <li class="music_search">
                <label>Artist:</label>
                <input type="text" name="artist_name" placeholder="&#xf002;  Artist Name"/>
              </li>
              <li class="music_search">
                <label>Year Released:</label>
                <input type="text" name="year_released" placeholder="&#xf002;  2018"/>
              </li>
              <li class="music_search">
                <input id="search_button" type="submit" name="submit_search" value="Search Music"/>
              </li>
              <li class="music_search">
                <input id="search_clear" type="reset" name="reset_search" value="Clear Form"/>
              </li>
              <li class="music_search">
                <input id="searchall" type="submit" name="searchall" value="Show All Music"/>
              </li>
            </ul>

          </form>
          <div id="search_error">
            <ul>
              <li><?php echo $artist_nameError ?></li>
              <li><?php echo $year_releasedError ?></li>
              <li><?php echo $input_reminder ?></li>
            </ul>
          </div>
        </div>
        <p><span>Music</span> is what life sounds like.<br/><span>Collect</span> your favorite music.<br/><span>Make</span> your life more inspiring.</p>
      </div>
      <div id="genrelist" class="genrelist">
        <ul>
          <li><a href="/index.php?genre=Blues">Blues</a></li>
          <li><a href="/index.php?genre=Classical">Classical</a></li>
          <li><a href="/index.php?genre=Country">Country</a></li>
          <li><a href="/index.php?genre=Electronic">Electronic</a></li>
          <li><a href="/index.php?genre=Pop">Pop</a></li>
          <li><a href="/index.php?genre=Folk">Folk</a></li>
          <li><a href="/index.php?genre=Hip-hop">Hip-hop</a></li>
          <li><a href="/index.php?genre=Jazz">Jazz</a></li>
          <li><a href="/index.php?genre=Rock">Rock</a></li>

        </ul>
      </div>
      <div class="image" id="image">
        <div style="display: block"><img src="/image/adele1.jpg"   alt="adele1.jpg" style="display: block"/> <span class="citation">(This image is cited from Google: <a target="_blank" href="https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/8c/cb/d5/8ccbd5e7-24a6-52d3-7185-7e6340a49e27/source/1200x630sr.jpg">https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/8c/cb/d5/8ccbd5e7-24a6-52d3-7185-7e6340a49e27/source/1200x630sr.jpg</a>)</span></div>
        <div><img src="/image/sia1.jpg" alt="sia1.jpg"/><span class="citation">(This image is cited from Google: <a target="_blank" href="http://www.rockandpop.cl/wp-content/uploads/2018/01/siia-e1517001244815.jpg">http://www.rockandpop.cl/wp-content/uploads/2018/01/siia-e1517001244815.jpg</a>)</span></div>
        <div><img src="/image/aliciakeys2.jpg" alt="aliciakeys2.jpg"/><span class="citation">(This image is cited from Google: <a target="_blank" href="https://is1-ssl.mzstatic.com/image/thumb/Music20/v4/d7/5a/07/d75a0776-adff-a6ff-d677-5be4f8b6a6ba/source/1200x630sr.jpg">https://is1-ssl.mzstatic.com/image/thumb/Music20/v4/d7/5a/07/d75a0776-adff-a6ff-d677-5be4f8b6a6ba/source/1200x630sr.jpg</a>)</span></div>
        <div><img src="/image/taylor1.jpg" alt="taylor1.jpg"/><span class="citation">(This image is cited from Google: <a target="_blank" href="https://www.grammy.com/sites/com/files/styles/image_landscape_hero/public/taylorswift-hero-510837066.jpg">https://www.grammy.com/sites/com/files/styles/image_landscape_hero/public/taylorswift-hero-510837066.jpg</a>)</span></div>
        <div><img src="/image/aliciakeys3.jpg" alt="aliciakeys3.jp"/><span class="citation">(This image is cited from Google: <a target="_blank" href="https://img.cache.vevo.com/thumb/video/USRV81600389/1280x720.jpg">https://img.cache.vevo.com/thumb/video/USRV81600389/1280x720.jpg</a>)</span></div>
        <div><img src="/image/am.jpg"  alt="am.jpg"/><span class="citation">(This image is cited from Google: <a target="_blank" href="https://www.telegraph.co.uk/content/dam/music/2017/08/04/134076867_PA_Eminem-sends-birthday-message-to-50-Cent-xlarge_trans_NvBQzQNjv4BqZgEkZX3M936N5BQK4Va8RTgjU7QtstFrD21mzXAYo54.jpg">https://www.telegraph.co.uk/content/dam/music/2017/08/04/134076867_PA_Eminem-sends-birthday-message-to-50-Cent-xlarge_trans_NvBQzQNjv4BqZgEkZX3M936N5BQK4Va8RTgjU7QtstFrD21mzXAYo54.jpg</a>)</span></div>
        <div><img src="/image/ladygaga1.jpg" alt="ladygaga1.jpg"/><span class="citation">(This image is cited from Google: <a target="_blank" href="https://cdn.noticiaaldia.com/wp-content/uploads/2017/09/lady-gaga-press-shot_wide-96c0ecc6ab77cc732de31fdb37b620e17e12b2c8.jpg">https://cdn.noticiaaldia.com/wp-content/uploads/2017/09/lady-gaga-press-shot_wide-96c0ecc6ab77cc732de31fdb37b620e17e12b2c8.jpg</a>)</span></div>
        <div><img src="/image/mayday1.jpg" alt="mayday1.jpg"/><span class="citation">(This image is cited from Google: <a target="_blank" href="https://gss0.baidu.com/7Po3dSag_xI4khGko9WTAnF6hhy/zhidao/pic/item/d043ad4bd11373f055e256d1af0f4bfbfaed049a.jpg">https://gss0.baidu.com/7Po3dSag_xI4khGko9WTAnF6hhy/zhidao/pic/item/d043ad4bd11373f055e256d1af0f4bfbfaed049a.jpg</a>)</span></div>
      </div>

    </div>
  </div>




</header>
