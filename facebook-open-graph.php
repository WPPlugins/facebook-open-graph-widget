<?php
/*
Plugin Name: Facebook Open Graph Widget
Plugin URI: http://www.BlogsEye.com/
Description: Adds a Facebook Open Graph widget and includes all meta data to the page header
Version: 0.9
Author: Keith P. Graham
Author URI: http://www.BlogsEye.com/

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
function kpg_fb_like_data_fixup() {
	// sets the new meta data
	
	// try it to see what we get
	$fbname=htmlspecialchars(get_bloginfo('name'));
	$fburl=htmlspecialchars(get_bloginfo('url'));
	if (substr($fburl,strlen($fburl)-1,1)!='/') $fburl.='/';
	$fbdesc=htmlspecialchars(get_bloginfo('description'));
	$fbpageurl=kpgcurPageURL();
	$fbtitle="";
	global $post;
	
	if (!empty($post)) {
		$fbtitle=$post->post_title;
	}
	if( is_home() || is_front_page()|| $fbtitle=='' ) {
		$fbpageurl=$fburl;
		$fbtitle=$fbname;
	}
	if (trim($fbtitle)=='') $fbtitle=$fbname;
	
	$opts=get_option('kpg_fb_like_widget');
	if ($opts==null) $opts=array();
	//if ($opts==null) {
		//echo "\r\n<!-- facebook header options not set because settings not found -->\r\n";
	//	return;
	//}
	$fbwtitle="Like";
	$fbimage="";
	$fbadmins="";
	$fbtype="";
	$fblatitude="";
	$fblongitude="";
	$fbstreet_address="";
	$fblocality="";
	$fbregion="";
	$fbpostal_code="";
	$fbcountry_name="";
	$fbemail="";
	$fbphone_number="";
	$fbfax_number="";
	$fbscope="home";
	
	$fblayout="";			
	$fbfaces="true";
	$fbverb="";
	$fbcolors="";
	$fbwidth="200";
	$fbheight="80";
	$fbwunits="px";
	$fbhunits="px";
	$fbfont="";	


	
	if (array_key_exists('fbadmins',$opts)) $fbadmins=$opts['fbadmins'];
	if ($fbadmins=='') {
		//echo "\r\n<!-- facebook header options not set because admin id not found -->\r\n";
		return;
	}
	if (array_key_exists('fbwtitle',$opts)) $fbwtitle=$opts['fbwtitle'];
	if (array_key_exists('fbimage',$opts)) $fbimage=$opts['fbimage'];
	if (array_key_exists('fbtype',$opts)) $fbtype=$opts['fbtype'];
	if (array_key_exists('fblatitude',$opts)) $fblatitude=$opts['fblatitude'];
	if (array_key_exists('fblongitude',$opts)) $fblongitude=$opts['fblongitude'];
	if (array_key_exists('fbstreet_address',$opts)) $fbdstreet_address=$opts['fbstreet_address'];
	if (array_key_exists('fblocality',$opts)) $fblocality=$opts['fblocality'];
	if (array_key_exists('fbregion',$opts)) $fblocality=$opts['fbregion'];
	if (array_key_exists('fbpostal_code',$opts)) $fbpostal_code=$opts['fbpostal_code'];
	if (array_key_exists('fbcountry_name',$opts)) $fbcountry_name=$opts['fbcountry_name'];
	if (array_key_exists('fbemail',$opts)) $fbemail=$opts['fbemail'];
	if (array_key_exists('fbphone_number',$opts)) $fbphone_number=$opts['fbphone_number'];
	if (array_key_exists('fbfax_number',$opts)) $fbfax_number=$opts['fbfax_number'];
	if (array_key_exists('fbscope',$opts)) $fbscope=$opts['fbscope'];
	if (array_key_exists('fblayout',$opts)) $fblayout=$opts['fblayout'];
	if (array_key_exists('fbfaces',$opts)) $fbfaces=$opts['fbfaces'];
	if (array_key_exists('fbverb',$opts)) $fbverb=$opts['fbverb'];
	if (array_key_exists('fbcolors',$opts)) $fbcolors=$opts['fbcolors'];
	if (array_key_exists('fbwidth',$opts)) $fbwidth=$opts['fbwidth'];
	if (array_key_exists('fbheight',$opts)) $fbheight=$opts['fbheight'];
	if (array_key_exists('fbfont',$opts)) $fbfont=$opts['fbfont'];
	if (array_key_exists('fbwunits',$opts)) $fbwunits=$opts['fbwunits'];
	if (array_key_exists('fbhunits',$opts)) $fbhunits=$opts['fbhunits'];

	if ($fbscope=='home') {
		$fbpageurl=$fburl;
		$fbtitle=$fbname;
	}

?>	
<meta property="og:title" content="<?php echo $fbtitle; ?>" />
<meta property="og:type" content="<?php echo $fbtype; ?>" />
<meta property="og:url" content="<?php echo $fbpageurl; ?>"/>
<meta property="og:site_name" content="<?php echo $fbname; ?>" />
<meta property="fb:admins" content="<?php echo $fbadmins; ?>" />
<meta property="og:description" content="<?php echo $fbdesc; ?>" />
<?php
	// optional tags
    if ($fbimage!='') echo "<meta property=\"og:image\" content=\"$fbimage\" />\r\n";
    if ($fblatitude!='') echo "<meta property=\"og:latitude\" content=\"$fblatitude\" />\r\n";
    if ($fblongitude!='') echo "<meta property=\"og:longitude\" content=\"$fblongitude\" />\r\n";
    if ($fbdstreet_address!='') echo "<meta property=\"og:street-address\" content=\"$fbstreet_address\" />\r\n";
    if ($fblocality!='') echo "<meta property=\"og:locality\" content=\"$fblocality\" />\r\n";
    if ($fbregion!='') echo "<meta property=\"og:region\" content=\"$fbregion\" />\r\n";
    if ($fbpostal_code!='') echo "<meta property=\"og:postal-code\" content=\"$fbpostal_code\" />\r\n";
    if ($fbcountry_name!='') echo "<meta property=\"og:country-name\" content=\"$fbcountry_name\" />\r\n";
	
    if ($fbemail!='') echo "<meta property=\"og:email\" content=\"$fbemail\" />\r\n";
    if ($fbphone_number!='') echo "<meta property=\"og:phone_number\" content=\"$fbphone_number\" />\r\n";
    if ($fbfax_number!='') echo "<meta property=\"og:fax_number\" content=\"$fbfax_number\" />\r\n";
	
}
function kpgcurPageURL() {
	// stolen from somewhere a while ago.
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
function kpg_fb_like_data_control()  {
// this is the display of information about the page.
	$fbname=urlencode(get_bloginfo('name'));
	$fburl=urlencode(get_bloginfo('url'));
	$fbdesc=urlencode(get_bloginfo('description'));
?>

<div class="wrap">
<h2>Facebook Open Graph</h2>
<h4>The Facebook Open Graph is installed and working correctly.</h4>

<p>
  Use the Widget controls to configure the widget.

</p>
<p>
In order to add this widget to facebook you must be a member of facebook. The widget will not appear unless you set your 
Facebook ID in the widget options. Your facebook id is the long number that facebook uses to identify you, or you can use your unique username if you have one. If you can't find your user id, try looking in your photos. I found mine in the url to the albumns.
</p>
<p>
The widget will allow a user to either "like" your website home page, or the individual pages in your website. You can select if you want just the main page to be liked. This makes it easier to administer your facebook pages. If you want individaul pages and posts to be liked and treated as separate Facebook pages then select posts and Pages. 
</p>
<p>
You can optionally include your geocode information and your contact information. I would be careful with your email address as it is in plain text for the spambots to harvest. If you need your users to contact you, and you have a good spam filter, you should include this information.
</p>
<p>I now include styling information. You can specify width, height and color scheme. You can use recommend instead of like and change the font. Use the dark color scheme if you have a dark background on your site. If you want a small button select button count and don't display faces. (Note: there are no faces when you use the button count format.)</p>

<p>The CSS styles available are fb_widget_title, fb_widget_li, fb_widget_iframe, 
<p>
Note: At the time that I am writing this, Facebook like buttons seem to be broken everywhere. 
This is a new feature to facebook and I expect the API to work sometimes and not work others. 
I am told that there are frequent timeout issues because the buttons were unexpectedly popular.
</p>
 <hr/>
  <p>This plugin is free and I expect nothing in return. If you would like to support my programming, you can buy my book of short stories.<br/>
    <a target="_blank" href="http://www.amazon.com/gp/product/1456336584?ie=UTF8&tag=thenewjt30page&linkCode=as2&camp=1789&creative=390957&creativeASIN=1456336584">Error Message Eyes: A Programmer's Guide to the Digital Soul</a></p>
  <p>A link on your blog to one of my personal sites would be appreciated.</p>
  <p><a target="_blank" href="http://www.WestNyackHoney.com">West Nyack Honey</a> (I keep bees and sell the honey)<br />
    <a target="_blank" href="http://www.cthreepo.com/blog">Wandering Blog </a> (My personal Blog) <br />
    <a target="_blank"  href="http://www.cthreepo.com">Resources for Science Fiction</a> (Writing Science Fiction) <br />
    <a target="_blank"  href="http://www.jt30.com">The JT30 Page</a> (Amplified Blues Harmonica) <br />
    <a target="_blank"  href="http://www.harpamps.com">Harp Amps</a> (Vacuum Tube Amplifiers for Blues) <br />
    <a target="_blank"  href="http://www.blogseye.com">Blog&apos;s Eye</a> (PHP coding) <br />
    <a target="_blank"  href="http://www.cthreepo.com/bees">Bee Progress Beekeeping Blog</a> (My adventures as a new beekeeper) </p>
</div>


<?php
}
// widget control functions
function kpg_fb_like_data_widget($args) {
	// show the widget
	// need to just put the iframe here
	$opts=get_option('kpg_fb_like_widget');
	if ($opts==null) {
		//echo "Widget Settings not found - configure the widget";
		return;
	}
	$fbadmins="";

	if (array_key_exists('fbadmins',$opts)) $fbadmins=$opts['fbadmins'];
	if ($fbadmins=='') {
		//echo "You have to enter your facebook id";
		return;
	}
	$fbwtitle="Like";
	if (array_key_exists('fbwtitle',$opts)) $fbwtitle=$opts['fbwtitle'];
	//<!-- start Widget -->	
	echo $args['before_widget']; 
	echo $args['before_title'];
	echo "<span class=\"fb_widget_title\">$fbwtitle</span>";
	echo $args['after_title'];
	
	$fburl=get_bloginfo('url');
	if (substr($fburl,strlen($fburl)-1,1)!='/') $fburl.='/';
	$fbpageurl=kpgcurPageURL();
	if( is_home() || is_front_page() ) {
		$fbpageurl=$fburl;
	}
	$fbscope="home";
	if (array_key_exists('fbscope',$opts)) $fbscope=$opts['fbscope'];
	if ($fbscope=='home') {
		$fbpageurl=$fburl;
	}
    $fbpageurl=urlencode($fbpageurl);
	
	$fblayout="standard";			
	$fbfaces="true";
	$fbverb="like";
	$fbcolors="light";
	$fbwidth="200";
	$fbheight="80";
	$fbwunits="px";
	$fbhunits="px";
	$fbfont="";	
	if (array_key_exists('fblayout',$opts)) $fblayout=$opts['fblayout'];
	if (array_key_exists('fbfaces',$opts)) $fbfaces=$opts['fbfaces'];
	if (array_key_exists('fbverb',$opts)) $fbverb=$opts['fbverb'];
	if (array_key_exists('fbcolors',$opts)) $fbcolors=$opts['fbcolors'];
	if (array_key_exists('fbwidth',$opts)) $fbwidth=$opts['fbwidth'];
	if (array_key_exists('fbheight',$opts)) $fbheight=$opts['fbheight'];
	if (array_key_exists('fbfont',$opts)) $fbfont=$opts['fbfont'];
	if (array_key_exists('fbwunits',$opts)) $fbwunits=$opts['fbwunits'];
	if (array_key_exists('fbhunits',$opts)) $fbhunits=$opts['fbhunits'];
	if ($fbfaces!='false') $fbfaces='true';
?>
<iframe class="fb_widget_iframe" src="http://www.facebook.com/plugins/like.php?href=<?php echo $fbpageurl; ?>&amp;layout=<?php echo $fblayout; ?>&amp;show_faces=<?php echo $fbfaces; ?>&amp;width=<?php echo $fbwidth; ?><?php echo $fbwunits; ?>&amp;height=<?php echo $fbheight; ?><?php echo $fbhunits; ?>&amp;action=<?php echo $fbverb; ?>&amp;font=<?php echo $fbfont; ?>&amp;colorscheme=<?php echo $fbcolors; ?>" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:<?php echo $fbwidth; ?><?php echo $fbwunits; ?>; height:<?php echo $fbheight; ?><?php echo $fbhunits; ?>"></iframe>


<?php
/*



<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $fbpageurl; ?>&amp;layout=standard&amp;show_faces=true&amp;width=220&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:220px; background-color:white;"></iframe></li>


*/
?>

<?php
// done with widget

echo $args['after_widget'];

}
function kpg_fb_like_data_widget_control() {
	$fbwtitle="Like";
	$fbimage="";
	$fbadmins="";
	$fbtype="";
	$fblatitude="";
	$fblongitude="";
	$fbstreet_address="";
	$fblocality="";
	$fbregion="";
	$fbpostal_code="";
	$fbcountry_name="";
	$fbemail="";
	$fbphone_number="";
	$fbfax_number="";
	$fbscope="home";
	
	$fblayout="";			
	$fbfaces="true";
	$fbverb="";
	$fbcolors="";
	$fbwidth="200";
	$fbheight="80";
	$fbwunits="px";
	$fbhunits="px";
	$fbfont="";	


	

 	$opts=get_option('kpg_fb_like_widget');
	if ($opts==null) $opts=array();
	if ( $_POST['kpg_fb_like_submit'] ) {
		$opts['fbwtitle'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbwtitle'])));
		$opts['fbimage'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbimage'])));
		$opts['fbadmins'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbadmins'])));
		$opts['fbtype'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbtype'])));
		$opts['fblatitude'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fblatitude'])));
		$opts['fblongitude'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fblongitude'])));
		$opts['fbstreet_address'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbstreet_address'])));
		$opts['fblocality'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fblocality'])));
		$opts['fbregion'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbregion'])));
		$opts['fbpostal_code'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbpostal_code'])));
		$opts['fbcountry_name'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbcountry_name'])));
		$opts['fbemail'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbemail'])));
		$opts['fbphone_number'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbphone_number'])));
		$opts['fbfax_number'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbfax_number'])));
		$opts['fblayout'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fblayout'])));
		$opts['fbfaces'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbfaces'])));
		$opts['fbverb'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbverb'])));
		$opts['fbcolors'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbcolors'])));
		$opts['fbwidth'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbwidth'])));
		$opts['fbheight'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbheight'])));
		$opts['fbfont'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbfont'])));
		$opts['fbwunits'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbwunits'])));
		$opts['fbhunits'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['kpg_fb_like_fbhunits'])));
	
		if (array_key_exists('kpg_fb_like_fbscope',$_POST)) $fbscope=$_POST['kpg_fb_like_fbscope'];
		$opts['fbscope'] = mysql_real_escape_string(strip_tags(stripslashes($fbscope)));
		update_option('kpg_fb_like_widget', $opts);
		echo "<p style=\"color:green;\">Updated options</p>";
	}
	// get the current or default values for the form
	$fbwtitle=$opts['fbwtitle'] ? wp_specialchars(stripslashes($opts['fbwtitle']), true) : 'Like';
	$fbimage=$opts['fbimage'] ? wp_specialchars(stripslashes($opts['fbimage']), true) : 'http://';
	$fbadmins=$opts['fbadmins'] ? wp_specialchars(stripslashes($opts['fbadmins']), true) : 'required admin id';
	$fbtype=$opts['fbtype'] ? wp_specialchars(stripslashes($opts['fbtype']), true) : '';
	$fblatitude=$opts['fblatitude'] ? wp_specialchars(stripslashes($opts['fblatitude']), true) : '';
	$fblongitude=$opts['fblongitude'] ? wp_specialchars(stripslashes($opts['fblongitude']), true) : '';
	$fbstreet_address=$opts['fbstreet_address'] ? wp_specialchars(stripslashes($opts['fbstreet_address']), true) : '';
	$fblocality=$opts['fblocality'] ? wp_specialchars(stripslashes($opts['fblocality']), true) : '';
	$fbregion=$opts['fbregion'] ? wp_specialchars(stripslashes($opts['fbregion']), true) : '';
	$fbpostal_code=$opts['fbpostal_code'] ? wp_specialchars(stripslashes($opts['fbpostal_code']), true) : '';
	$fbcountry_name=$opts['fbcountry_name'] ? wp_specialchars(stripslashes($opts['fbcountry_name']), true) : '';
	$fbemail=$opts['fbemail'] ? wp_specialchars(stripslashes($opts['fbemail']), true) : '';
	$fbphone_number=$opts['fbphone_number'] ? wp_specialchars(stripslashes($opts['fbphone_number']), true) : '';
	$fbfax_number=$opts['fbfax_number'] ? wp_specialchars(stripslashes($opts['fbfax_number']), true) : '';
	$fbscope=$opts['fbscope'] ? wp_specialchars(stripslashes($opts['fbscope']), true) : '';

	$fblayout=$opts['fblayout'] ? wp_specialchars(stripslashes($opts['fblayout']), true) : '';
	$fbfaces=$opts['fbfaces'] ? wp_specialchars(stripslashes($opts['fbfaces']), true) : '';
	$fbverb=$opts['fbverb'] ? wp_specialchars(stripslashes($opts['fbverb']), true) : '';
	$fbcolors=$opts['fbcolors'] ? wp_specialchars(stripslashes($opts['fbcolors']), true) : '';
	$fbwidth=$opts['fbwidth'] ? wp_specialchars(stripslashes($opts['fbwidth']), true) : '';
	$fbheight=$opts['fbheight'] ? wp_specialchars(stripslashes($opts['fbheight']), true) : '';
	$fbfont=$opts['fbfont'] ? wp_specialchars(stripslashes($opts['fbfont']), true) : '';
	$fbwunits=$opts['fbwunits'] ? wp_specialchars(stripslashes($opts['fbwunits']), true) : '';
	$fbhunits=$opts['fbhunits'] ? wp_specialchars(stripslashes($opts['fbhunits']), true) : '';


?>
			<div class="wrap">
			<fieldset style="border:thin black solid;padding:2px;"><legend>Required Entries</legend>
			<label for="kpg_fb_like_fbwtitle" style="line-height:25px;display:block;">
				<?php _e('Widget title:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbwtitle" 
						value="<?php echo $fbwtitle; ?>" /><br/>(displays above widget)
			</label>
			<label for="kpg_fb_like_fbadmins" style="line-height:25px;display:block;">
				<?php _e('Facebook ID:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbadmins" 
						value="<?php echo $fbadmins; ?>" /><br/>(Your Facebook ID)
			</label>
			<label for="kpg_fb_like_fbimage" style="line-height:25px;display:block;">
				<?php _e('Page Image:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbimage" 
						value="<?php echo $fbimage; ?>" /><br/>(Image or icon for your posts)
			<label for="kpg_fb_like_fbtype" style="line-height:25px;display:block;">
				<?php _e('Page type:', 'widgets'); ?> 
					<select style="width:140px;" name="kpg_fb_like_fbtype">
						<option value="blog" <?PHP if ($fbtype=='blog') echo 'selected="1"'; ?>>blog</option>
						<option value="website" <?PHP if ($fbtype=='website'||$fbtype=='') echo 'selected="1"'; ?>>website</option>
						<option value="activity" <?PHP if ($fbtype=='activity') echo 'selected="1"'; ?>>activity</option>
						<option value="sport" <?PHP if ($fbtype=='sport') echo 'selected="1"'; ?>>sport</option>
						<option value="bar" <?PHP if ($fbtype=='bar') echo 'selected="1"'; ?>>bar</option>
						<option value="company" <?PHP if ($fbtype=='company') echo 'selected="1"'; ?>>company</option>
						<option value="cafe" <?PHP if ($fbtype=='cafe') echo 'selected="1"'; ?>>cafe</option>
						<option value="hotel" <?PHP if ($fbtype=='hotel') echo 'selected="1"'; ?>>hotel</option>
						<option value="restaurant" <?PHP if ($fbtype=='restaurant') echo 'selected="1"'; ?>>restaurant</option>
						<option value="cause" <?PHP if ($fbtype=='cause') echo 'selected="1"'; ?>>cause</option>
						<option value="sports_league" <?PHP if ($fbtype=='sports_league') echo 'selected="1"'; ?>>sports_league</option>
						<option value="sports_team" <?PHP if ($fbtype=='sports_team') echo 'selected="1"'; ?>>sports_team</option>
						<option value="band" <?PHP if ($fbtype=='band') echo 'selected="1"'; ?>>band</option>
						<option value="government" <?PHP if ($fbtype=='government') echo 'selected="1"'; ?>>government</option>
						<option value="non_profit" <?PHP if ($fbtype=='non_profit') echo 'selected="1"'; ?>>non_profit</option>
						<option value="school" <?PHP if ($fbtype=='school') echo 'selected="1"'; ?>>school</option>
						<option value="university" <?PHP if ($fbtype=='university') echo 'selected="1"'; ?>>university</option>
						<option value="actor" <?PHP if ($fbtype=='actor') echo 'selected="1"'; ?>>actor</option>
						<option value="athlete" <?PHP if ($fbtype=='athlete') echo 'selected="1"'; ?>>athlete</option>
						<option value="author" <?PHP if ($fbtype=='author') echo 'selected="1"'; ?>>author</option>
						<option value="director" <?PHP if ($fbtype=='director') echo 'selected="1"'; ?>>director</option>
						<option value="musician" <?PHP if ($fbtype=='musician') echo 'selected="1"'; ?>>musician</option>
						<option value="politician" <?PHP if ($fbtype=='politician') echo 'selected="1"'; ?>>politician</option>
						<option value="public_figure" <?PHP if ($fbtype=='public_figure') echo 'selected="1"'; ?>>public_figure</option>
						<option value="city" <?PHP if ($fbtype=='city') echo 'selected="1"'; ?>>city</option>
						<option value="country" <?PHP if ($fbtype=='country') echo 'selected="1"'; ?>>country</option>
						<option value="landmark" <?PHP if ($fbtype=='landmark') echo 'selected="1"'; ?>>landmark</option>
						<option value="state_province" <?PHP if ($fbtype=='state_province') echo 'selected="1"'; ?>>state_province</option>
						<option value="album" <?PHP if ($fbtype=='album') echo 'selected="1"'; ?>>album</option>
						<option value="book" <?PHP if ($fbtype=='book') echo 'selected="1"'; ?>>book</option>
						<option value="drink" <?PHP if ($fbtype=='drink') echo 'selected="1"'; ?>>drink</option>
						<option value="food" <?PHP if ($fbtype=='food') echo 'selected="1"'; ?>>food</option>
						<option value="game" <?PHP if ($fbtype=='game') echo 'selected="1"'; ?>>game</option>
						<option value="product" <?PHP if ($fbtype=='product') echo 'selected="1"'; ?>>product</option>
						<option value="song" <?PHP if ($fbtype=='song') echo 'selected="1"'; ?>>song</option>
						<option value="movie" <?PHP if ($fbtype=='movie') echo 'selected="1"'; ?>>movie</option>
						<option value="tv_show" <?PHP if ($fbtype=='tv_show') echo 'selected="1"'; ?>>tv_show</option>
					</select>
					<br/>(Facebook page type)
			</label>
			<label for="kpg_fb_like_fbscope" style="line-height:25px;display:block;">Widget scope:
						
						
				<select  name="kpg_fb_like_fbscope" >
					<option value="blog"<?PHP if ($fbscope=='blog') echo 'selected="1"'; ?>>Like Pages and Posts</option>
					<option value="home" <?PHP if ($fbscope=='home'||$fbscope=='') echo 'selected="1"'; ?>>Like the blog Home page</option>
				</select><br/>(Select if users will &quot;like&quot; whole blog, or users will &quot;like&quot; individual pages or posts)
			</label>

			</fieldset>
			<fieldset style="border:thin black solid;padding:2px;"><legend>Styling</legend>
			
			<label for="kpg_fb_like_fblayout" style="line-height:25px;display:block;">Layout Style
				<select name="kpg_fb_like_fblayout">
					<option value="standard" <?PHP if ($fblayout=='standard'||$fblayout=='') echo 'selected="1"'; ?>>standard</option>
					<option value="button_count" <?PHP if ($fblayout=='button_count') echo 'selected="1"'; ?>>button_count</option>
				</select>
			</label> 
			
			<label for="kpg_fb_like_fbfaces" style="line-height:25px;display:block;">Show faces
				<select  name="kpg_fb_like_fbfaces" >
					<option value="true"<?PHP if ($fbfaces=='true') echo 'selected="1"'; ?>>Show Faces</option>
					<option value="false" <?PHP if ($fbfaces=='false'||$fbfaces=='') echo 'selected="1"'; ?>>No Faces</option>
				</select>
			</label> 
			
			<label for="kpg_fb_like_fbverb" style="line-height:25px;display:block;">Verb to display
				<select  name="kpg_fb_like_fbverb">
					<option value="like" <?PHP if ($fbverb=='like'||$fbverb=='') echo 'selected="1"'; ?>>like</option>
					<option value="recommend" <?PHP if ($fbverb=='recommend') echo 'selected="1"'; ?>>recommend</option>
				</select>
			</label> 
			
			<label for="kpg_fb_like_fbcolors" style="line-height:25px;display:block;">Color Scheme
				<select  name="kpg_fb_like_fbcolors" >
					<option value="light"<?PHP if ($fbcolors=='light'||$fbcolors=='') echo 'selected="1"'; ?>>light</option>
					<option value="dark" <?PHP if ($fbcolors=='dark') echo 'selected="1"'; ?>>dark</option>
					<option value="evil" <?PHP if ($fbcolors=='evil') echo 'selected="1"'; ?>>evil</option>
				</select>
			</label> 
			
			<label for="kpg_fb_like_fbwidth" style="line-height:25px;display:block;">Width
				<input  name="kpg_fb_like_fbwidth" size="7" value="<?PHP echo $fbwidth; ?>" type="text">
				&nbsp;<select  name="kpg_fb_like_fbwunits" >
				<option value="px"<?PHP if ($fbwunits=='px'||$fbwunits=='') echo 'selected="1"'; ?>>PX</option>
				<option value="%"<?PHP if ($fbwunits=='%') echo 'selected="1"'; ?>>%</option>
				<option value="em"<?PHP if ($fbwunits=='em') echo 'selected="1"'; ?>>em</option>
				</select>
			</label> 
			<label for="kpg_fb_like_fbheight" style="line-height:25px;display:block;">Height
				<input  name="kpg_fb_like_fbheight" size="7" value="<?PHP echo $fbheight; ?>" type="text">
				&nbsp;<select  name="kpg_fb_like_fbhunits" >
				<option value="px"<?PHP if ($fbhunits=='px'||$fbhunits=='') echo 'selected="1"'; ?>>PX</option>
				<option value="%"<?PHP if ($fbhunits=='%') echo 'selected="1"'; ?>>%</option>
				<option value="em"<?PHP if ($fbhunits=='em') echo 'selected="1"'; ?>>em</option>
				</select>
			</label> 
			
			<label for="kpg_fb_like_fbfont" style="line-height:25px;display:block;">Font
				<select  name="kpg_fb_like_fbfont">
					<option value="" <?PHP if ($fbfont=='') echo 'selected="1"'; ?>>default</option>
					<option value="arial" <?PHP if ($fbfont=='arial') echo 'selected="1"'; ?>>arial</option>
					<option value="lucida grande" <?PHP if ($fbfont=='lucida grande') echo 'selected="1"'; ?>>lucida grande</option>
					<option value="segoe ui" <?PHP if ($fbfont=='segoe ui') echo 'selected="1"'; ?>>segoe ui</option>
					<option value="tahoma" <?PHP if ($fbfont=='tahoma') echo 'selected="1"'; ?>>tahoma</option>
					<option value="trebuchet ms" <?PHP if ($fbfont=='trebuchet ms') echo 'selected="1"'; ?>>trebuchet ms</option>
					<option value="verdana" <?PHP if ($fbfont=='verdana') echo 'selected="1"'; ?>>verdana</option>
				</select>
			</label> 
			
			</fieldset>

			<fieldset style="border:thin black solid;padding:2px;"><legend>Geocodes (optional)</legend>
			<label for="kpg_fb_like_fblatitude" style="line-height:25px;display:block;">
				<?php _e('Latitude:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fblatitude" 
						value="<?php echo $fblatitude; ?>" /> 
			</label>
			<label for="kpg_fb_like_fblongitude" style="line-height:25px;display:block;">
				<?php _e('Longitude:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fblongitude" 
						value="<?php echo $fblongitude; ?>" /> 
			</label>
			<label for="kpg_fb_like_fbstreet_address" style="line-height:25px;display:block;">
				<?php _e('Street Address:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbstreet_address" 
						value="<?php echo $fbstreet_address; ?>" /> 
			</label>
			<label for="kpg_fb_like_fblocality" style="line-height:25px;display:block;">
				<?php _e('Locality/city:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fblocality" 
						value="<?php echo $fblocality; ?>" /> 
			</label>
			<label for="kpg_fb_like_fbregion" style="line-height:25px;display:block;">
				<?php _e('Region/State:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbregion" 
						value="<?php echo $fbregion; ?>" /> 
			</label>
			<label for="kpg_fb_like_fbpostal_code" style="line-height:25px;display:block;">
				<?php _e('Postal Code/Zip:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbpostal_code" 
						value="<?php echo $fbpostal_code; ?>" /> 
			</label>
			<label for="kpg_fb_like_fbcountry_name" style="line-height:25px;display:block;">
				<?php _e('Country Code:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbcountry_name" 
						value="<?php echo $fbcountry_name; ?>" /> 
			</label>
			</fieldset>
			<fieldset  style="border:thin black solid;padding:2px;"><legend>Contact Info (optional)</legend>
			 Warning: spambots can see this information
			<label for="kpg_fb_like_fbemail" style="line-height:25px;display:block;">
				<?php _e('Email:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbemail" 
						value="<?php echo $fbemail; ?>" />
			</label>
			<label for="kpg_fb_like_fbphone_number" style="line-height:25px;display:block;">
				<?php _e('Phone Number:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbphone_number" 
						value="<?php echo $fbphone_number; ?>" />
			</label>
			<label for="kpg_fb_like_fbfax_number" style="line-height:25px;display:block;">
				<?php _e('Fax Number:', 'widgets'); ?> 
					<input style="width:140px;" type="text" name="kpg_fb_like_fbfax_number" 
						value="<?php echo $fbfax_number; ?>" />
			</label>
			
			</fieldset>
			
			<input type="hidden" name="kpg_fb_like_submit" value="1" />
			</div>
<?php

}



function kpg_fb_like_data_init() {
   add_options_page('Facebook Open Graph Widget', 'Facebook Open Graph Widget', 'manage_options',__FILE__,'kpg_fb_like_data_control');
   if ( function_exists('register_uninstall_hook') ) {
	register_uninstall_hook(__FILE__, 'kpg_fb_like_data_uninstall');
	}

}
  // Plugin added to Wordpress plugin architecture
  // we are not registering the admin menu items - we'll include it all in the the widget control for now.
// register the widget
function kpg_fb_like_data_widget_init() {
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;
	
	register_sidebar_widget(array('Facebook Open Graph Widget', 'widgets'), 'kpg_fb_like_data_widget');
	register_widget_control(array('Facebook Open Graph Widget', 'widgets'), 'kpg_fb_like_data_widget_control');
}
// uninstall routines

function kpg_fb_like_data_uninstall() {
	if(!current_user_can('manage_options')) {
		die('Access Denied');
	}
	delete_option('kpg_fb_like_widget'); 
	return;
}
	add_action('widgets_init', 'kpg_fb_like_data_widget_init');
	add_action('admin_menu', 'kpg_fb_like_data_init');	
	add_action( 'wp_head', 'kpg_fb_like_data_fixup',99 );


?>