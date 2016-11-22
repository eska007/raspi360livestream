#!/bin/bash

modprobe bcm2835-v4l2 #open /dev/video0
export STREAMER_PATH=$HOME/mjpg-streamer/mjpg-streamer-experimental
export LD_LIBRARY_PATH=$STREAMER_PATH

#$STREAMER_PATH/mjpg_streamer -i "input_raspicam.so -d 200" -o "output_http.so -w $STREAMER_PATH/www"
$STREAMER_PATH/mjpg_streamer -i "input_file.so -f /var/www/html/files -n stream.png" -o "output_http.so -w $STREAMER_PATH/www"
#raspivid -o - -t 0 | tee /var/www/html/vid_files/video1.h264 | avconv -f video4linux2 -i /dev/video0 -vcodec libx264 -f mpegts udp://192.168.0.15:8080
#gst-launch-1.0 videotestsrc is-live=true ! x264enc ! mpegtsmux ! hlssink max-files=5 playlist-root=http://192.168.0.15:8080 location=/var/www/html playlist-location=/var/www/html

echo exec $SHELL
