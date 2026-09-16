<?php
/********************************************************************************
* Subs-AutoEmbedVideoClips.php v2.1.5									*
* By Karl Benson													*
*********************************************************************************
This program is distributed in the hope that it is and will be useful, but
WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.
********************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');

function AutoEmbedVideoClips($message)
{
	// Access globals
	global $context, $modSettings;

	// Max auto embedded video clips *per page* to avoid flash overload. It only applies to this mod, and not other video mods.
	// Use -1 for no-limit (not recommended)
	static $autoembedmax = 12;
	
	$video_sites = array(
		// Put the most popular first for speed
		array(
			'name' => 'YouTube',
			'enabled' => 1,
			'pattern' => 'http://(?:video\.google\.(?:com|com\.au|co\.uk|de|es|fr|it|nl|pl|ca|cn)/(?:[^"]*?))?(?:(?:www|au|br|ca|es|fr|de|hk|ie|it|jp|mx|nl|nz|pl|ru|tw|uk)\.)?youtube\.com(?:[^"]*?)?(?:\&|\/|\?|\;|\%3F|\%2F)(?:video_id=|v(?:/|=|\%3D|\%2F))([0-9a-z-_]{11})',
			// Includes parsing of youtube videos on google
			'movie' => 'http://www.youtube.com/v/$1&rel=1',
			'width' => '425',
			'height' => '350',
		),
		array(
			'name' => 'YouTube Playlist',
			'enabled' => 1,
			'pattern' => 'http://(?:(?:www|au|br|ca|es|fr|de|hk|ie|it|jp|mx|nl|nz|pl|ru|tw|uk)\.)?youtube\.com(?:[^"]*?)?(?:\&|\/|\?|\;)(?:id=|p=|p/)([0-9a-f]{16})',
			'movie' => 'http://www.youtube.com/p/$1&rel=1',
			'width' => '425',
			'height' => '355',
		),
		array(
			'name' => 'Google Video',
			'enabled' => 1,
			'pattern' => 'http://video\.google\.(com|com\.au|co\.uk|de|es|fr|it|nl|pl|ca|cn)/(?:videoplay|url|googleplayer\.swf)\?(?:[^"]*?)?docid=([0-9a-z-_]{1,20})',
			'movie' => 'http://video.google.$1/googleplayer.swf?docId=$2',
			'width' => '400',
			'height' => '326',
		),
		array(
			'name' => 'Dailymotion',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?dailymotion\.(?:com|alice\.it)/(?:(?:[^"]*?)?video|swf)/([a-z0-9]{1,8})',
			'movie' => 'http://www.dailymotion.com/swf/$1',
			'width' => '420',
			'height' => '335',
		),
		array(
			'name' => 'Megavideo',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?megavideo\.com/\?(?:[^"]*?)?v=([0-9a-z]{8})',
			'movie' => 'http://www.megavideo.com/v/$1.0.0',
			'width' => '432',
			'height' => '351',
		),
		array(
			'name' => 'MetaCafe',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?metacafe\.com/(?:watch|fplayer)/([0-9]{1,10})/',
			'movie' => 'http://www.metacafe.com/fplayer/$1/metacafe.swf',
			'width' => '400',
			'height' => '345',
		),
		array(
			'name' => '123video.nl',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?123video\.nl/playvideos\.asp\?(?:[^"]*?)?MovieID=([0-9]{1,8})',
			'movie' => 'http://www.123video.nl/123video_share.swf?mediaSrc=$1',
			'width' => '420',
			'height' => '339',
		),
		array(
			'name' => 'Aniboom',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?aniboom\.com/Player.aspx\?(?:[^"]*?)?v=([0-9]{1,8})',
			'movie' => 'http://api.aniboom.com/embedded.swf?videoar=$1',
			'width' => '448',
			'height' => '372',
		),
		array(
			'name' => 'AOL Uncut',
			'enabled' => 1,
			'pattern' => 'http://uncutvideo\.aol\.com/videos/([0-9a-f]{32})',
			'movie' => 'http://uncutvideo.aol.com/v6.220/en-US/uc_videoplayer.swf?aID=1$1&site=http://uncutvideo.aol.com/',
			'width' => '415',
			'height' => '347',
		),
		array(
			'name' => 'AtomFilms',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?atomfilms\.com/film/([0-9a-z_-]{1,40})\.jsp',
			'movie' => 'http://www.atomfilms.com:80/a/autoplayer/shareEmbed.swf?keyword=$1',
			'width' => '426',
			'height' => '350',
		),
		array(
			'name' => 'AtomFilms Uploads',
			'enabled' => 1,
			'pattern' => 'http://uploads\.atomfilms\.com/Clip\.aspx\?(?:[^"]*?)?key=([0-9a-f]{1,16})',
			'movie' => 'http://uploads.atomfilms.com/player.swf?key=$1',
			'width' => '430',
			'height' => '354',
		),
		array(
			'name' => 'Biku',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?biku\.com/opus/(?:player.swf\?(?:[^"]*?)?VideoID=)?([0-9]{1,8})',
			'movie' => 'http://www.biku.com/opus/player.swf?VideoID=$1&embed=true&autoStart=false',
			'width' => '480',
			'height' => '395',
		),
		array(
			'name' => 'BrightCove',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?brightcove\.(tv|com)/title.jsp\?(?:[^"]*?)?title=([0-9]{1,12})',
			'movie' => 'http://www.brightcove.$1/playerswf?allowFullScreen=true&initVideoId=$2&servicesURL=http://www.brightcove.tv'
							.'&viewerSecureGatewayURL=https://www.brightcove.tv&cdnURL=http://admin.brightcove.com&autoStart=false',
			'width' => '486',
			'height' => '412',
		),
		array(
			'name' => 'CellFish',
			'enabled' => 1,
			'pattern' => 'http://cellfish\.cellfish\.com/(?:video|multimedia)/([0-9]{1,8})',
			'movie' => 'http://cellfish.com/static/swf/player.swf?Id=$1',
			'width' => '420',
			'height' => '315',
		),
		array(
			'name' => 'ClipFish.de',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?clipfish\.de/(?:player\.php|videoplayer\.swf)\?(?:[^"]*?)?videoid=([a-z0-9]{1,20})',
			'movie' => 'http://www.clipfish.de/videoplayer.swf?as=0&videoid=$1&r=1&c=0067B3',
			'width' => '464',
			'height' => '380',
		),
		array(
			'name' => 'CollegeHumor',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?collegehumor\.com/video:([0-9]{1,12})',
			'movie' => 'http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=$1',
			'width' => '480',
			'height' => '360',
		),
		array(
			'name' => 'Dave.tv',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?dave\.tv/MediaPlayer.aspx\?(?:[^"]*?)?contentItemId=([0-9]{1,10})',
			'movie' => 'http://dave.tv/dbox/dbox_small.swf?configURI=http://dave.tv/dbox/config.ashx&volume=50&channelContentId=$1',
			'width' => '300',
			'height' => '260',
		),
		array(
			'name' => 'dv.ouou',
			'enabled' => 1,
			'pattern' => 'http://dv\.ouou\.com/(?:play/v_|v/)([a-f0-9]{14})',
			'movie' => 'http://dv.ouou.com/v/$1',
			'width' => '480',
			'height' => '385',
		),
		array(
			'name' => 'ESPN',
			'enabled' => 1,
			'pattern' => 'http://sports\.espn\.go\.com/broadband/video/videopage\?(?:[^"]*?)?videoId=([0-9]{1,10})',
			'movie' => 'http://sports.espn.go.com/broadband/player.swf?mediaId=$1',
			'width' => '440',
			'height' => '361',
		),
		array(
			'name' => 'Gametrailers',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?gametrailers\.com/(?:player/|remote_wrap\.php\?mid=)([0-9]{1,10})',
			'movie' => 'http://www.gametrailers.com/remote_wrap.php?mid=$1',
			'width' => '480',
			'height' => '392',
		),
		array(
			'name' => 'Gametrailers User Movies',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?gametrailers\.com/(?:player/usermovies/|remote_wrap\.php\?umid=)([0-9]{1,10})',
			'movie' => 'http://www.gametrailers.com/remote_wrap.php?umid=$1',
			'width' => '480',
			'height' => '392',
		),
		array(
			'name' => 'Gametube.org',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?gametube\.org/(?:\#/video/|htmlVideo\.jsp\?id=)([0-9a-z]{1,3})/([a-z0-9_-]{26})=',
			'movie' => 'http://www.gametube.org/miniPlayer.swf?vidId=$1/$2',
			'width' => '425',
			'height' => '335',
		),
		array(
			'name' => 'GameVideos',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?gamevideos\.com/(?:video/id/|video/embed\?(?:[^"]*?)?video=)([0-9]{1,8})',
			'movie' => 'http://gamevideos.com:80/swf/gamevideos11.swf?embedded=1&autoplay=0&src=http://gamevideos.com:80/video/videoListXML%3Fid%3D$1%26adPlay%3Dfalse',
			'width' => '420',
			'height' => '405',
		),
		array(
			'name' => 'Glumbert',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?glumbert\.com/media/([a-z0-9_-]{1,30})',
			'movie' => 'http://www.glumbert.com/embed/$1',
			'width' => '425',
			'height' => '335',
		),
		array(
			'name' => 'Godtube',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?godtube\.com/view_video\.php\?(?:[^"]*?)?viewkey=([0-9a-f]{20})',
			'movie' => 'http://godtube.com/flvplayer.swf?viewkey=$1',
			'width' => '330',
			'height' => '270',
		),
		array(
			'name' => 'Gofish Videos',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?gofish\.com/player(?:\.gfp\?|/fwplayer\.swf\?(?:[^"]*?))gfid=([0-9-]{10})',
			'movie' => 'http://www.gofish.com/player/fwplayer.swf?loc=blog&gf=true&ns=false&fs=false&gfid=$1&c=grey&autoPlay=false&getAd=false&wm=false&ct=true&tb=false&svr=www.gofish.com',
			'width' => '448',
			'height' => '336',
		),
		array(
			'name' => 'Gofish Channels', // Channels are different than videos :(
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?gofish\.com/(?:channel\.gfp|player/gfplayer\.swf)(?:\?gfid|(?:[^"]*?)cgfid)=([0-9-]{7})(?:[^"]*?)(?:videogfid|vgfid)=([0-9-]{7})',
			'movie' => 'http://www.gofish.com/player/GFPlayer.swf?cm=false&tb=true&ap=false&co=false&ct=true&gf=true&loc=external&lp=true&sb=true&cgfid=$1&pgfid=&vgfid=$2&ad=false&svr=www.gofish.com',
			'width' => '492',
			'height' => '336',
		),
		array(
			'name' => 'Guba',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?guba\.com/watch/([0-9]{1,12})',
			'movie' => 'http://www.guba.com/f/root.swf?video_url=http://free.guba.com/uploaditem/$1/flash.flv&amp;isEmbeddedPlayer=true',
			'width' => '525',
			'height' => '360',
		),
		array(
			'name' => 'Hulu.com (US Only)',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?hulu\.com/(?:watch/embed/|playerembed\.swf\?(?:[^"]*?)?pid=)?([a-z0-9-_]{1,32})',
			'movie' => 'http://www.hulu.com/embed/$1',
			'width' => '567',
			'height' => '350',
		),
		array(
			'name' => 'IFilm',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?ifilm\.com/video/([0-9]{1,8})',
			'movie' => 'http://www.ifilm.com/efp?flvbaseclip=$1',
			'width' => '448',
			'height' => '365',
		),
		array(
			'name' => 'Imageshack.us',
			'enabled' => 1,
			'pattern' => 'http://img([0-9]{1,5})\.imageshack\.us/(?:my\.php\?image=|img(?:[0-9]{1,5})/(?:[0-9]{1,8})/|flvplayer\.swf\?f=T)([a-z0-9-_]{1,20})\.flv',
			'movie' => 'http://img$1.imageshack.us/flvplayer.swf?f=T$2&autostart=false',
			'width' => '424',
			'height' => '338',
		),
		array(
			'name' => 'Jeux-France.com',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?jeux-france\.com/downloads([0-9]{1,8})_',
			'movie' => 'http://www.jeux-france.com/flash/flvplayer.swf?videoid=$1',
			'width' => '428',
			'height' => '260',
		),
		array(
			'name' => 'Jubii.co.uk',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.|tv\.)?jubii.co\.uk/(?:video/|p/en/)([0-9a-z_-]{10,14})\.html',
			'movie' => 'http://tv.jubii.co.uk/p/en/$1.html',
			'width' => '400',
			'height' => '368',
		),
		array(
			'name' => 'Koreus',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?koreus\.com/video/([0-9a-z-]{1,50})\.html',
			'movie' => 'http://www.koreus.com/video/$1',
			'width' => '400',
			'height' => '300',
		),
		array(
			'name' => 'Libero.it',
			'enabled' => 1,
			'pattern' => 'http://video\.libero\.it/app/play(?:/index.html)?\?(?:[^"]*?)?id=([a-f0-9]{32})',
			'movie' => 'http://video.libero.it/static/swf/eltvplayer.swf?id=$1.flv&ap=0',
			'width' => '400',
			'height' => '333',
		),
		array(
			'name' => 'LiveLeak',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?liveleak\.com/(?:player.swf?autostart=false&token=|view\?(?:[^"]*?)?i=)([0-9a-z]{3})_([a-z0-9]{10})',
			'movie' => 'http://www.liveleak.com/player.swf?autostart=false&token=$1_$2',
			'width' => '450',
			'height' => '370',
		),
		array(
			'name' => 'LiveVideo',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?livevideo\.com/(?:flvplayer/embed/|video/(?:view/)?(?:(?:[^"]*?)?/)?)([0-9a-f]{32})',
			'movie' => 'http://www.livevideo.com/flvplayer/embed/$1',
			'width' => '445',
			'height' => '369',
		),
		array(
			'name' => 'MSN Live/Soapbox Video',
			'enabled' => 1,
			'pattern' => 'http://(?:soapbox|video)\.msn\.com/video\.aspx\?(?:(?:[^"]*?)?vid=|from=msnvideo&showPlaylist=true&playlist=videoByUuids:uuids:)((?:[0-9a-z]{8})(?:(?:-(?:[0-9a-z]{4})){3})-(?:[0-9a-z]{12}))',
			'movie' => 'http://images.video.msn.com/flash/soapbox1_1.swf?c=v&v=$1',
			'width' => '432',
			'height' => '364',
		),
		array(
			'name' => 'Mofile',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.|tv\.)?mofile\.com/([0-9a-z]{8})',
			'movie' => 'http://tv.mofile.com/cn/xplayer.swf?v=$1',
			'width' => '480',
			'height' => '395',
		),
		array(
			'name' => 'M Thai',
			'enabled' => 1,
			'pattern' => 'http://video\.mthai\.com/player\.php\?(?:[^"]*?)?id=([0-9a-z]{14,20})',
			'movie' => 'http://video.mthai.com/Flash_player/player.swf?idMovie=$1',
			'width' => '370',
			'height' => '330',
		),
		array(
			'name' => 'Mtvu',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?mtvu\.com/video/\?id=([0-9]{1,9})(?:[^"]*?)vid=([0-9]{1,9})',
			'movie' => 'http://www.mtvu.com/player/embed/?CONFIG_URL=http://www.mtvu.com/player/embed/configuration.jhtml%3Fid%3D$1%26vid%3D$2$1',
			'width' => '480',
			'height' => '395',
		),
		array(
			'name' => 'MySpaceTv',
			'enabled' => 1,
			'pattern' => 'http://(?:vids\.myspace|myspacetv)\.com/index\.cfm\?(?:[^"]*?)?VideoID=([0-9]{1,10})',
			'movie' => 'http://lads.myspace.com/videos/myspacetv_vplayer0005.swf?m=$1&amp;type=video',
			'width' => '480',
			'height' => '386',
		),
		array(
			'name' => 'MyVideo.de',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?myvideo\.de/(?:watch|movie)/([0-9]{1,8})',
			'movie' => 'http://www.myvideo.de/movie/$1',
			'width' => '470',
			'height' => '406',
		),
		array(
			'name' => 'OnSmash',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.|videos\.)?onsmash\.com/(?:v|e)/([0-9a-z]{16})',
			'movie' => 'http://videos.onsmash.com/e/$1',
			'width' => '448',
			'height' => '374',
		),
		array(
			'name' => 'Photobucket',
			'enabled' => 1,
			'pattern' => 'http://(?:(?:i(?:[0-9]{1,5})\.|www\.)?photobucket\.com/player\.swf\?file=http://vid|s)([0-9]{1,5})\.photobucket\.com/albums/((?:(?:[\%0-9a-z_-]{1,50})/){1,10})(?:\?(?:[^"]*?)current=)?([\%0-9a-z_-]{1,50})\.flv',
			'movie' => 'http://i$1.photobucket.com/player.swf?file=http://vid$1.photobucket.com/albums/$2$3.flv',
			'width' => '448',
			'height' => '361',
		),
		array(
			'name' => 'Revver',
			'enabled' => 1,
			'pattern' => 'http://(?:one\.|www\.)?revver\.com/(?:watch|video)/([0-9]{1,8})(?:/)?',
			'movie' => 'http://flash.revver.com/player/1.0/player.swf?mediaId=$1',
			'width' => '480',
			'height' => '392',
		),
		array(
			'name' => 'Sevenload',
			'enabled' => 1,
			'pattern' => 'http://((?:en|tr|de|www)\.)?sevenload\.com/(?:videos|videolar)/([0-9a-z]{1,8})',
			'movie' => 'http://$1sevenload.com/pl/$2/425x350/swf',
			'width' => '425',
			'height' => '350',
		),
		array(
			'name' => 'Streetfire.net',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.|videos\.)?streetfire\.net/video/((?:[0-9a-z]{8})(?:(?:-(?:[0-9a-z]{4})){3})-(?:[0-9a-z]{12}))\.htm',
			'movie' => 'http://videos.streetfire.net/vidiac.swf?video=$1',
			'width' => '428',
			'height' => '352',
		),
		array(
			'name' => 'Stupidvideos.com',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?stupidvideos\.com/video/(?:[^"]*?)\#([0-9]{1,10})',
			'movie' => 'http://img.purevideo.com/images/player/player.swf?sa=1&sk=5&si=2&i=$1',
			'width' => '451',
			'height' => '433',
		),
		array(
			'name' => 'Tudou',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?tudou\.com/(?:programs/view/|v/)([a-z0-9-]{1,12})',
			'movie' => 'http://www.tudou.com/v/$1',
			'width' => '400',
			'height' => '300',
		),
		array(
			'name' => 'UUME',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?uume\.com/play_([a-z0-9]{12})',
			'movie' => 'http://www.uume.com/v/$1_UUME',
			'width' => '400',
			'height' => '342',
		),
		array(
			'name' => 'Veoh',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?veoh\.com/(?:videos/|videodetails2\.swf\?permalinkId=)([0-9a-z]{14,16})',
			'movie' => 'http://www.veoh.com/videodetails2.swf?permalinkId=$1&id=anonymous&player=videodetailsembedded&videoAutoPlay=0',
			'width' => '540',
			'height' => '438',
		),
		array(
			'name' => 'videotube.de',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?videotube\.de/watch/([0-9]{1,8})',
			'movie' => 'http://www.videotube.de/flash/player.swf?baseURL=http%3A%2F%2Fwww.videotube.de%2Fwatch%2F$1',
			'width' => '480',
			'height' => '400',
		),
		array(
			'name' => 'Vidiac',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?vidiac\.com/video/((?:[0-9a-z]{8})(?:(?:-(?:[0-9a-z]{4})){3})-(?:[0-9a-z]{12}))\.htm',
			'movie' => 'http://www.vidiac.com/vidiac.swf?video=$1',
			'width' => '428',
			'height' => '352',
		),
		array(
			'name' => 'VidMax',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?vidmax\.com/index\.php/videos/view/([0-9]{1,10})',
			'movie' => 'http://vidmax.com/img/vidmax_player.swf?xml=http://vidmax.com/index.php/videos/playlist/&id=$1&autoPlay=true&bg=http://vidmax.com/img/back.jpg',
			'width' => '450',
			'height' => '447',
		),
		array(
			'name' => 'Vimeo',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?vimeo\.com/([0-9]{1,12})',
			'movie' => 'http://vimeo.com/moogaloop.swf?clip_id=$1&amp;server=vimeo.com&amp;fullscreen=1&amp;show_title=1'
							.'&amp;show_byline=1&amp;show_portrait=0&amp;color=01AAEA',
			'width' => '400',
			'height' => '225',
		),
		array(
			'name' => 'VSocial',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?vsocial\.com/video/\?d=([0-9]{1,8})',
			'movie' => 'http://static.vsocial.com/flash/ups.swf?d=$1&a=0',
			'width' => '410',
			'height' => '400',
		),
		array(
			'name' => 'WeGame',
			'enabled' => 1,
			'pattern' => 'http://(?:www\.)?wegame\.com/watch/([0-9a-z_-]*?)/',
			'movie' => 'http://wegame.com/static/flash/player2.swf?tag=$1',
			'width' => '480',
			'height' => '387',
		),
		array(
			'name' => 'Yahoo (Except HK)',
			'enabled' => 1,
			'pattern' => 'http://(?:(?:www|uk|fr|it|es|br|au|mx|de|ca)\.)?video\.yahoo\.com/video/play\?(?:[^"]*?)?vid=([0-9]{1,10})',
			'movie' => 'http://us.i1.yimg.com/cosmos.bcst.yahoo.com/player/media/swf/FLVVideoSolo.swf?id=$1',
			'width' => '425',
			'height' => '350',
		),
		array(
			'name' => 'Yahoo HK Only',
			'enabled' => 1,
			'pattern' => 'http://hk\.video\.yahoo\.com/video/video\.html\?id=([0-9]{1,10})',
			'movie' => 'http://w.video.hk.yahoo.net/video/dplayer.html?vid=$1',
			'width' => '420',
			'height' => '370',
		),
		array(
			'name' => 'Youku',
			'enabled' => 1,
			'pattern' => 'http://(?:v\.youku\.com/v_show/id_(?:[0-9a-z]{4})|player\.youku\.com/player\.php/sid/)([0-9a-z]{6,14})',
			'movie' => 'http://player.youku.com/player.php/sid/$1=/v.swf',
			'width' => '450',
			'height' => '372',
		),
		array(
			'name' => 'You.Video.Sina.com.cn',
			'enabled' => 1,
			'pattern' => 'http://you\.video\.sina\.com\.cn/pg/topicdetail/topicPlay\.php\?(?:[^"]*?)?uid=([0-9]{5,12})(?:[^"]*?)\#([0-9]{5,10})',
			'movie' => 'http://vhead.blog.sina.com.cn/player/outer_player.swf?auto=0&vid=$2&uid=$1',
			'width' => '475',
			'height' => '447',
		),
	);

	// Protect any noembed bbcoded links or <noembed> objects
	if(preg_match_all('~(?:(\[noembed\])(?:.*?)\[/noembed\]|\<noembed\>(?:.*?)\</noembed\>)~im', $message, $noembed, PREG_SET_ORDER))
	{
		foreach ($noembed as $a)
		{
			// Copy it so we can modify a copy
			$a[2] = $a[0];

			// Make any non-active links active
			if(!empty($a[1]) && strtolower($a[1]) == '[noembed]' && !empty($modSettings['autoLinkUrls']))
				// Strip the noembed tags
				$a[2] = StripAndFixNoEmbed($a[2]);

			// Protect links so they don't get caught by our preg, any so much so they are likely to be unique.
			$a[2] = str_replace('<a href=', '#<AEVC href=#', $a[2]);
			$message = str_replace($a[0], $a[2], $message);
		}
		// Tidy up
		unset($a, $noembed);
	}

	// Default params
	$default_params = array(
		'wmode' => 'transparent',
		'quality' => 'high',
		'allowFullScreen' => 'true',
		'allowScriptAccess' => 'never',
		'pluginspage' => 'http://www.macromedia.com/go/getflashplayer',
	);
	
	// Build the params for the object (same for all)
	$object_params = $embed_params = '';

	foreach($default_params as $a => $b)
	{
		// <Embed>
		$embed_params .= ' '.$a.'="'.$b.'"';
		// <Object>?
		if($context['browser']['is_ie'] && !$context['browser']['is_mac_ie'])
			$object_params .= '<param name="'.$a.'" value="'.$b.'" />';
		
	}
	// Tidy up
	unset($a, $b, $default_params);
		
	// Now do the magic, convert those links in messages to automatically embed the videos
	foreach($video_sites as $arr)
	{
		// If the site is disabled, then continue with the next site.
		if(!$arr['enabled'])
			continue;
	
		// Create empty object
		$object = '';
		
		// Build the <object> (Non-Mac IE Only)
		if($context['browser']['is_ie'] && !$context['browser']['is_mac_ie'])
			$object = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" '.
						'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" '.
						'type="application/x-shockwave-flash" width="'.$arr['width'].'px" height="'.$arr['height'].'px">'.
						'<param name="movie" value="'.$arr['movie'].'" />'. $object_params;

		// Build the <embed>
		$object .= '
					<embed type="application/x-shockwave-flash" '.
						'src="'.$arr['movie'].'" width="'.$arr['width'].'px" height="'.$arr['height'].'px"'. $embed_params .' />'.
					'<noembed>#<AEVC href=#"'.$arr['movie'].'" target="_blank">'.$arr['movie'].'</a></noembed>';
		// Note the link inside the <noembed starts #<AEVC href=#  to protect it from being affected, this will be reversed later
		
		// If using <object> remember to close it
		if($context['browser']['is_ie'] && !$context['browser']['is_mac_ie'])
			$object .= '</object>';
			
		// Build the pattern/(re)set the count
		$pattern = '~<a href="'.$arr['pattern'].'(?:[^"]*?)"(?:.*?)</a>~i'.($context['utf8'] ? 'u' : '') ;
		$count = 0;

		// Pre php 5.1.0, No count parameter, so do it the slower, inefficient way
		if (@version_compare(PHP_VERSION, '5.1.0') == -1)
		{
			// Grab all the matches to count the no. of replacements that will be made
			if(preg_match_all($pattern, $message, $out, PREG_PATTERN_ORDER))
			{
				$count = count($out[0]);
				unset($out);
				$message = preg_replace($pattern, $object, $message, $autoembedmax);
			}
		}
		else
			// Fantastic! From 5.1.0 we can use the count parameter
			$message = preg_replace($pattern, $object, $message, $autoembedmax, $count);

		// Reduce remaining replacements allowed
		if($autoembedmax != -1)
			$autoembedmax = $autoembedmax - $count;

		// Tidy up
		unset($object, $pattern, $count);
		
		// If we've reached our max replacements OR there are no links remaining, exit;
		if($autoembedmax == 0 || stripos($message, '<a href="') === false)
			break;
	}

	// Tidy up
	unset($video_sites, $object_params, $embed_params, $pattern, $arr, $count);
	
	// Reverse protection of noembed stuff in one go
	$message = str_replace('#<AEVC href=#', '<a href=', $message);

	// Strip [noembed] bbcode codes
	if(stripos($message, '[noembed]') !== false)
		$message = StripAndFixNoEmbed($message);
		
// Return our message.
return $message;
}

// Strips [noembed] tags out of posts once they've been useful
function StripAndFixNoEmbed($input)
{
	global $context;
	
	// Pre PHP5, there is no str_ireplace
	if (@version_compare(PHP_VERSION, '5.0') == -1)
		$input = preg_replace(array('~\[noembed\]~i', '~\[\/noembed\]~i'), '', $input);
	else
		$input = str_ireplace(array('[noembed]', '[/noembed]'), '', $input);
		
	// Parse any URLs.... have to get rid of the @ problems some things cause... stupid email addresses.
	if (!isset($disabled['url']) && (stripos($input, '://') !== false || stripos($input, 'www.') !== false))
	{
		// Modified from smf code
		// Switch out quotes really quick because they can cause problems
		$input = strtr($input, array('&#039;' => '\'', '&nbsp;' => $context['utf8'] ? "\xC2\xA0" : "\xA0", '&quot;' => '>">', '"' => '<"<', '&lt;' => '<lt<'));
		$input = preg_replace(array('~(?<=[\s>\.(;\'"]|^)((?:http|https|ftp|ftps)://[\w\-_%@:|]+(?:\.[\w\-_%]+)*(?::\d+)?(?:/[\w\-_\~%\.@,\?&;=#+:\'\\\\]*|[\(\{][\w\-_\~%\.@,\?&;=#(){}+:\'\\\\]*)*[/\w\-_\~%@\?;=#}\\\\])~i', '~(?<=[\s>(\'<]|^)(www(?:\.[\w\-_]+)+(?::\d+)?(?:/[\w\-_\~%\.@,\?&;=#+:\'\\\\]*|[\(\{][\w\-_\~%\.@,\?&;=#(){}+:\'\\\\]*)*[/\w\-_\~%@\?;=#}\\\\])~i'), array('<a href="$1">$1</a>', '<a href="http://$1">$1</a>'), $input);
		$input = strtr($input, array('\'' => '&#039;', $context['utf8'] ? "\xC2\xA0" : "\xA0" => '&nbsp;', '>">' => '&quot;', '<"<' => '"', '<lt<' => '&lt;'));
	}
	
	// Return it
	return $input;
}

?>