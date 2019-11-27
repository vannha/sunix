jQuery(document).ready(function($) {
    "use strict";
    /* magnific-popup */
    $("a.red-popupvideo").magnificPopup({
        type:'inline',
        closeBtnInside: false,
        removalDelay: 300,
        mainClass: 'mfp-fade',
        zoom: {
            enabled: true,
            duration: 500,
            easing: 'ease-in-out', 
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
    $("a.red-popupvideo-iframe").magnificPopup({
        //disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        // Changes iFrame to support Youtube state changes (so we can close the video when it ends)
        iframe: {
            // Converts Youtube links to embeded videos in Magnific popup.
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0&showinfo=0&enablejsapi=1'
                },
                dailymotion: {
                    index: 'dailymotion.com',
                    id: function(url) {        
                        var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);
                            if (m !== null) {
                                if(m[4] !== undefined) {
                                  
                                    return m[4];
                                }
                                return m[2];
                            }
                            return null;
                        },
                    src: 'https://www.dailymotion.com/embed/video/%id%'
                }
            }
        },
        // Tracks Youtube video state changes (so we can close the video when it ends)
        callbacks: {
          open: function() {
            /*new YT.Player('player', {
              events: {
                'onStateChange': onPlayerStateChange
              }
            });*/
          }
        }
    });
    // Closes Magnific Popup when Video Ends
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED) {
          $.magnificPopup.close();
        }
    }
    /**
     * window load event.
     * 
     * Bind an event handler to the "load" JavaScript event.
     * @author CMSSuperHeroes
     */
    $(window).on('load', function() {
        $('.red-video-wrapper').ef5_video();
    });
    /* EF5 Video HTML5 */
    jQuery.fn.extend({
        ef5_video: function(){
            this.each(function(){
                var $this = $(this);
                var video = $this.find('video');
                var content = $this.find('.mejs-overlay');
                
                video.on("ended", function() {
                   content.fadeTo( "slow", 1 );
                   $(this).addClass('video-pause').removeClass('video-play');
                });
                video.on("play", function() {
                   content.fadeTo( "slow", 0 );
                   $(this).addClass('video-play').removeClass('video-pause');
                });
                video.on("pause", function() {
                   content.fadeTo( "slow", 1 );
                   $(this).addClass('video-pause').removeClass('video-play');
                });
                video.on("playing", function() {
                   content.fadeTo( "slow", 0 );
                   $(this).addClass('video-play').removeClass('video-pause');
                });
                $('.play-video',$this).on('click',function(){
                    EF5Html5PlayVideo($this.find(video));
                })
                $('video',$this).on('click',function(){
                    EF5Html5PauseVideo($this.find(video));  
                })
            });
        }
    });
    function EF5Html5PlayVideo(video){
        "use strict";
        if (video.get(0).paused == true) {
            video.get(0).play();
        } else {
            video.get(0).pause();
        }
    }
    function EF5Html5PauseVideo(video){
        "use strict";
        if (video.get(0).paused != true) {
            video.get(0).pause();
        }
    }
});